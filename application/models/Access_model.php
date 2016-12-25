<?php

class Access_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

// 	function update_password($id,$new_password){
// 		$data = array(
// 			'PassWord' => $new_password
// 		);
// 		$this->db->where('user_ID', $id);
// 		$update = $this->db->update('users', $data);
// 		if( $update ){
// 			return true;
// 		} else {
// 			return false;
// 		}
// 	}

	// Usage: $this->access_model->makePassword($text)
	public function makePassword($text){
		$options = $this->config->item('pwCost');
		return password_hash( trim($text), PASSWORD_BCRYPT, $options );
	}

	// Usage: $this->access_model->
	public function can_login(){
		$path = $this->config->item('usersDir');
		$file = md5($this->input->post('UserName')).'.json';
		$record = array();
		$pathFile = trim($path.$file);
		if( file_exists($pathFile) ){
			$json = trim(file_get_contents($pathFile));
			$record = json_decode($json, true);
		} else {
			return FALSE;
		}
		if( password_verify(trim($this->input->post('PassWord')), $record['password']) && trim($record['status'])!='Disabled' ){
			$data = array(
				'Status' => trim($record['status'])
			);
			$this->session->set_userdata($data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function add_temp_user($key){
		$data = array(
			'ID' => trim(date('ymdHis'))
			,'User_Name' => $this->input->post('UserName')
			,'eMail_Address' => $this->encrypt->encode($this->input->post('Email'))
			,'Password'	=> md5($this->input->post('PassWord'))
			,'Status'	=> 'Visitor'
			,'Expires'	=> 'Never'
			,'Key'		=> $key
		);
		if( $this->createTempUser($data) ){
			return true;
		} else {
			return false;
		}
	}

	public function createTempUser($data) {
		$fileName = md5(str_replace(' ','_',trim($data['User_Name'])));
		$pathFile = $this->config->item('tempusersPath').$fileName.'.xml';
		if( !file_exists($pathFile) ){
			$xml_fields = $this->config->item('xml_member_fields');
			$xml_fields[] = 'Key';
			$main_keys = $this->config->item('xml_member_keys');
			//=============== Create XML File ==================
			$doc = new DOMDocument('1.0');
			$doc->formatOutput = true;
			$root = $doc->createElement($main_keys[0]);
				$doc->appendChild($root);
			$element = $doc->createElement($main_keys[1]);
				$root->appendChild($element);
			for( $x=0; $x<count($xml_fields); $x++ ){
				$item = $doc->createElement( $xml_fields[$x], stripslashes(trim($data[ $xml_fields[$x] ])) );
					$element->appendChild($item);
			}
			$doc->save($pathFile);
			chmod($pathFile, 0775);
			return true;
		} else {
			return false;
		}
	}

	public function is_key_valid($userName,$key){
		$fileName = trim($userName).'.xml';
		$pathFile = $this->config->item('tempusersPath').$fileName;
		if( file_exists($pathFile) ){
			$xml = simplexml_load_file($pathFile);
			$ary = $this->shared_model->obj_to_ary($xml);
			// check key in xml file
			if( trim($ary['Member']['Key'])==trim($key) ){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function add_user($userName){
		$fileName = trim($userName).'.xml';
		$pathFile = $this->config->item('tempusersPath').$fileName;
		$xml = simplexml_load_file($pathFile);
			$ary = $this->shared_model->obj_to_ary($xml);
		$newPathFile = trim($this->config->item('profilesPath').$fileName);
		if( !copy($pathFile,$newPathFile) ){
			return false;
		} else {
			unlink( $pathFile );
			// create dir for user
			mkdir($this->config->item('dataPath').md5(trim($ary['Member']['ID'])),0777);
			mkdir($this->config->item('dataPath').md5(trim($ary['Member']['ID'])).'/shared',0777);
			return true;
		}
		//
	}

// 	public function get_user($userName){
// 		$this->db->where('UserName', $userName);
// 		$query = $this->db->get('users');
// 		if( $query ){
// 			$row = $query->row();
// 			return $row;
// 		} else {
// 			return false;
// 		}
// 	}

	// Usage: $this->
	public function findUser($userName){
		$path = $this->config->item('usersDir');
		if( file_exists($path.md5($userName)) ){
			return TRUE;
		} else {
			return FALSE;
		}
	}

// 	// Update Query
// 	public function update_user($id,$data){
// 		$this->db->where('user_ID', $id);
// 		$this->db->update('users', $data);
// 	}

// 	public function getFieldNames($table){
// 		return $this->db->list_fields($table);
// 	}

	//====================================================================

// 	function getValue($field,$table,$where,$equalto){
// 		$this->db->select($field);
// 		$this->db->where($where, $equalto);
// 		$query = $this->db->get($table);
// 		foreach( $query->result() as $row ){
// 			return trim($row->$field);
// 		}
// 	}

// 	public function getSelectRecord($table,$where,$id){
// 		$query = $this->db->get_where($table, array($where=>$id));
// 		if( $query->num_rows() > 0 ){
// 			$data = $query->result_array();
// 			return $data[0];
// 		} else {
// 			return FALSE;
// 		}
// 	}

	public function makeTableLine($table,$preItems,$fields,$sizes){
		$str = '';
		$keys = array_keys($fields);
		$str .= '<table id="Table'.$table.'" class="" style="float:left; width:99%; margin:2px 5px;';
		$str .= ' text-align:left; background:rgba(255,255,255,0.75);">';
		$str .= '<tr valign="top" style="">';
		for($p=0;$p<count($preItems);$p++){
			$str .= $preItems[$p];
		}
		for($x=0;$x<count($fields);$x++){
			switch( $keys[$x] ){
				case 'Description':
					$str .= '<td class="cell" width="'.$sizes[$x].'" style="overflow:auto;">';
					$str .= '<b>'.$keys[$x].':</b> <br/>';
					$str .= $fields[$keys[$x]];
					$str .= '</td>';
					break;
				case 'XXX':
					// do something;
					break;
				default:
					$str .= '<td class="cell" width="'.$sizes[$x].'" style="">';
					$str .= '<b>'.$keys[$x].':</b> ';
					$str .= $fields[$keys[$x]];
					$str .= '</td>';
			}
		}
		$str .= '</tr>';
		$str .= '</table>';
		return $str;
	}

// 	public function getRecords($table,$where=''){
// 		if( $where!=='' ){
// 			$this->db->where($where);
// 		}
// 		$query = $this->db->get($table);
// 		if( $query->num_rows() > 0 ){
// 			$data = $query->result_array();
// 			return $data;
// 		} else {
// 			return FALSE;
// 		}
// 	}

	//==============================================================================

	public function outputArray($ary){
		echo '<pre style="float:left; background:rgba(50,50,50,0.75); text-align:left; margin:5px;
			padding:5px 10px; color:#CF0; border-radius:6px;">';
		print_r($ary);
		echo '</pre>';
	}

	//

}
