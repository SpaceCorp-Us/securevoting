<?php

echo '<div id="rowCcolB" class="colB" style="overflow:auto;">';
//=====================================================================================
echo '<div class="fadeIn" style="position:relative; width:100%; height:100%; display:none; overflow:auto;">';

//echo validation_errors();

$attributes = array(
	'id'=>'form_login',
	'name'=>'form_login',
	'style'=>'position:absolute; border:1px solid #9CCC5E; top:5%; left:5%; padding:5px; max-width:100%;
		background:rgba(100,100,100,0.5); border-radius:10px; font-family:Arial;'
);
echo form_open('access/login_validation', $attributes);
//=============================

echo '<div class="formHead" style="font-size:20pt;">Login Form</div>';

echo '<div style="overflow:hidden; padding:0px 5px;">';

echo '<div class="fields" style="">
	Username <input id="UserName" name="UserName" class="field clearSides"
	type="text" value=""></div>';
echo '<div class="fields" style="">
	Password <input id="PassWord" name="PassWord" class="field clearSides"
	type="password" value=""></div>';

echo '</div>';

echo '<div class="formFoot" style="">';
if( isset($validation) ){
	echo '<div style="float:left; color:#F7F76F; text-align:left;">'.$validation.'</div>';
}
echo '<input class="button" style="float:right;" type="submit" value="Login"/>';
echo '</div>';

//=============================
echo form_close();

//$this->shared_model->outputArray($data); // FOR TESTING !

echo '</div>';
//=====================================================================================
echo '</div>';


echo '<script type="text/javascript">
var setFocus = function() {
	$("#UserName").focus();
};
</script>';


//
