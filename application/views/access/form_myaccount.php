<?php

echo '<div id="rowCcolB" class="colB" style="overflow:auto;">';
//=====================================================================================
echo '<div class="fadeIn" style="position:relative; width:100%; height:100%; display:none; overflow:auto;">';

$fields = $this->config->item('userFields');
$file = md5(trim($this->session->userdata('UserName'))).'.json';
$path = $this->config->item('usersDir');
$pathFile = trim($path.$file);
$json = trim(file_get_contents($pathFile));
$record = json_decode($json, true);

//position:absolute; border:1px solid #9CCC5E; top:5%; left:5%; padding:5px; max-width:100%; background:rgba(20,20,20,0.5); border-radius:10px; font-family:Arial;
$attributes = array(
	'id' => 'form_myaccount',
	'name' => 'form_myaccount',
	'style' => '',
	'class' => 'mainForm'
);
echo form_open('access/update_account', $attributes);
//=============================
echo '<div class="formHead" style="">My Account';
$this->shared_model->getRank($record['status'],'float:right;');
echo '</div>';
echo '<div style="overflow:auto; padding:0px 5px;">';

echo '<input name="pathFile" type="hidden" value="'.$pathFile.'"/>';
echo '<input name="preusername" type="hidden" value="'.$record['username'].'"/>';
echo '<input name="prepassword" type="hidden" value="'.trim($_SESSION['PassWord']).'"/>';

for( $x=0; $x<count($fields); $x++ ){
	echo '<div class="fields">';
	echo $this->shared_model->formatName($fields[$x]);
	echo '&nbsp;<input id="'.$fields[$x].'" name="'.$fields[$x].'"';
	switch( strtolower(trim($fields[$x])) ){
		case 'id':
			echo ' class="field-readonly"';
			echo ' style="width:110px;"';
			echo ' type="text"';
			echo ' value="'.trim( (string) $record[$fields[$x]] ).'"';
			echo ' readonly="readonly"';
			break;
		case 'username':
			echo ' class="field"';
			//echo ' class="field-readonly"';
			echo ' type="text"';
			echo ' value="'.trim( $this->session->userdata('UserName') ).'"';
			//echo ' readonly="readonly"';
			break;
		case 'password':
			echo ' class="field"';
			//echo ' class="field-readonly"';
			echo ' type="password"';//password
			echo ' value="'.trim( $_SESSION['PassWord'] ).'"';
			//echo ' readonly="readonly"';
			break;
		case 'email_address':
			if( isset($record[$fields[$x]]) && trim($fields[$x])!='' ){
				echo ' class="field"';
				echo ' style=""';
				echo ' type="text"';
				echo ' value="'.$this->encrypt->decode(trim( $record[$fields[$x]] ),md5(trim($_SESSION['PassWord']))).'"';
			} else {
				echo ' class="field"';
				echo ' style=""';
				echo ' type="text"';
				echo ' value="'.'"';
			}
			break;
		case 'status':
			echo ' class="field-readonly"';
			echo ' style="width:105px;"';
			echo ' type="text"';
			echo ' value="'.trim( $record[$fields[$x]] ).'"';
			echo ' readonly="readonly"';
			break;
		default:
			if( isset($record[$fields[$x]]) && trim($fields[$x])!='' ){
				echo ' class="field"';
				echo ' style=""';
				echo ' type="text"';
				echo ' value="'.trim( $record[$fields[$x]] ).'"';
			} else {
				echo ' class="field"';
				echo ' style=""';
				echo ' type="text"';
				echo ' value="'.'"';
			}
	}
	echo '/>';
	echo '</div>';
}


// echo '<pre style="float:left; background:rgba(50,50,50,0.75); text-align:left; margin:5px;
// 	padding:5px 10px; color:#CF0; border-radius:6px;">';
//print_r( $this->session->all_userdata() );
//print_r( session_status() );
//echo session_id();
//print_r( $_COOKIE['mylinks_session'] );
//echo '</pre>';


echo '</div>';
echo '<div class="formFoot" style="">';
if( isset($validation) ){
	echo '<div class="" style="float:left; color:#F00; text-align:left; font-size:14pt;">'.$validation.'</div>';
} else {
	echo '<div style="float:left; color:#F7F76F; text-align:left;">';
	echo 'Changing certain information may require a re-login.';
	echo '</div>';
}
echo '<input class="button" style="float:right;" type="submit" value="Update"/>';
echo '</div>';
//=============================
echo form_close();




echo '</div>';
//=====================================================================================
echo '</div>';


echo '<script type="text/javascript">
var setFocus = function() {
	$("#username").focus();
};
</script>';


//
