<?php

echo '<div id="rowAcolC" class="colC">';
//=======================================================================


if( $this->session->userdata('Status') ){
	echo '<div style="padding:5px;">';
		echo 'Welcome'; echo '&nbsp;'; echo '<b>'.$this->session->userdata('UserName').'</b>,';
	echo '</div>';
	echo '<div style="padding:7px;">';
		$attribs = array(	'class' => 'button','title' => 'Click to Logout' );
		echo anchor('access/logout', 'Logout', $attribs);
	echo '</div>';
	echo '<div style="padding:7px;">';
		$attribs = array( 'class' => 'button','title' => 'View My Account' );
		echo anchor('access/myaccount', 'My Account', $attribs);
	echo '</div>';
} else {
	echo '<div style="padding:5px;">';
		echo 'Welcome Visitor,';
	echo '</div>';
	echo '<div style="padding:7px;">';
		$attribs = array(	'class' => 'button','title' => 'Click for Login Page'	);
		echo anchor('access/login', 'Login', $attribs);
	echo '</div>';
	echo '<div style="padding:7px;">';
		$attribs = array(	'class' => 'button','title' => 'Click for SignUp Page' );
		//echo anchor('access/signup', 'Create Account', $attribs);
	echo '</div>';
}



//=======================================================================
echo '</div>';

//
