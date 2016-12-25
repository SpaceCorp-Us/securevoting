<?php 

echo '<div id="rowCcolB" class="colB" style="overflow:auto;">';
//=====================================================================================
echo '<div class="fadeIn" style="position:relative; width:100%; height:100%; display:none; overflow:auto;">';


$attributes = array(
	'id'=>'form_signup'
	,'name'=>'form_signup'
//	,'class'=>'form_signup'
);
echo form_open('access/signup_process', $attributes);
//=============================

echo '<div class="formHead" style="font-size:20pt;">Sign Up Form</div>';

echo '<div style="overflow:hidden; padding:0px 5px;">';


echo '<div class="fields" style="">';
echo 'Username ';
$data = array(
	'id'          => 'UserName'
	,'name'        => 'UserName'
	,'class'	=> 'field'
);
echo form_input($data, $this->input->post('UserName'));
echo '</div>';

echo '<div class="fields" style="">';
echo 'Email Address ';
$data = array(
	'id'          => 'Email'
	,'name'        => 'Email'
	,'class'	=> 'field'
);
echo form_input($data, $this->input->post('Email'));
echo '</div>';

echo '<div class="fields" style="">';
echo 'Password ';
$data = array(
	'id'        => 'PassWord'
	,'name'      => 'PassWord'
	,'class'	=> 'field'
);
echo form_password($data);
echo '</div>';

echo '<div class="fields" style="">';
echo 'Confirm Password ';
$data = array(
	'id'        => 'cPassWord'
	,'name'      => 'cPassWord'
	,'class'	=> 'field'
);
echo form_password($data);
echo '</div>';


echo '</div>';

echo '<div class="formFoot" style="">';
if( isset($validation) ){
	echo '<div style="float:left; color:#F7F76F; text-align:left;">'.$validation.'</div>';
} else {
	echo '<div style="float:left; color:#CCC; text-align:left;">* We will send you an eMail activation request.</div>';
}
echo '<input class="button" style="float:right;" type="submit" value="Join"/>';
echo '</div>';

//=============================
echo form_close();



echo '</div>';
//=====================================================================================
echo '</div>';

//
