<?php

class Shared_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// Usage: $this->shared_model->getRank($status,$style='')
	function getRank($status,$style=''){
		$black = 0;
		$gold = 0;
		$shape = 'rounded';
		switch( $status ){
		   case 'ADMIRAL':
		      $gold = 4;
				$shape = 'square';
		      break;
		   case 'CAPTAIN':
		      $gold = 4;
		      break;
			case 'ADMIN':
		      $gold = 3;
		      break;
			case 'LT.COMMANDER':
				$black = 1;
		      $gold = 2;
		      break;
			case 'TRUSTEE':
		      $gold = 2;
		      break;
			case 'LT.JUNIOR.GRADE':
				$black = 1;
		      $gold = 1;
		      break;
			case 'USER':
		      $gold = 1;
		      break;
			case 'PETTY.OFFICER':
		      $black = 1;
		      break;
			default:
		      return '';
		}
		if( $shape=='square' ){
			echo '<div class="pipGroupS" style="'.$style.'" title="'.$status.'">';
		} else {
			echo '<div class="pipGroupR" style="'.$style.'" title="'.$status.'">';
		}
		for($b=0;$b<$black;$b++){
			echo '<div class="pipBlack"></div>';
		}
		for($g=0;$g<$gold;$g++){
			echo '<div class="pipGold"></div>';
		}
		echo '</div>';
	}

	// Usage: $this->shared_model->formatName($str)
	function formatName($str){
		$var = ucwords(str_replace('_',' ',trim($str)));
		return $var;
	}

	// Usage: $this->shared_model->formatCaption($str)
	function formatCaption($str,$lower=false){
		$var = trim($str);
		$var = str_replace('-','- ',$var);
		$var = str_replace('_',' ',$var);
		$var = ucwords($var);
		$var = str_replace('- ','',$var);
		if($lower){
			$var = strtolower($var);
		}
		return $var;
	}

	// USAGE: $this->shared_model->selectBackdrop($theme)
	function selectBackdrop($theme){
		$images = array();
		$imagesPath = 'css/'.$theme.'/backdrops/';
		$images = $this->pathFiles2Array($imagesPath);
		shuffle($images);
		$image = trim($images[0]);
		return $imagesPath.$image;
	}

	// Usage: $this->shared_model->pathFiles2Array($path)
	function pathFiles2Array($path,$type=null) {
		$result = array();
		if( $handle = opendir($path) ){
			$x = 0;
			while( ($file = readdir($handle))!==FALSE ){
				if( $file!='.' && $file!='..' && !is_dir($path.$file) ) {
					if( $type ){
						if( strstr($file,$type)!=FALSE ){
							$result[$x] = trim($file);
							$x++;
						}
					} else {
						$result[$x] = trim($file);
						$x++;
					}
				}
			}
			closedir($handle);
			clearstatcache();
		}
		return $result;
	}

	//==============================================================================

	// Usage: $this->shared_model->outputArray($ary)
	public function outputArray($ary){
		echo '<pre style="float:left; background:rgba(50,50,50,0.75); text-align:left; margin:5px;
			padding:5px 10px; color:#CF0; border-radius:6px;">';
		print_r($ary);
		echo '</pre>';
	}

	//

}

//
