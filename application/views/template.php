<?php

echo '<!DOCTYPE html>';
if( isset($variables) ){
	$this->load->view($variables);
}
echo '<html lang="en"><head>';
if( isset($head) ){
	$this->load->view($head);
}
if( isset($css) ){
	$this->load->view($css);
}
echo '</head>';
if( isset($processing) ){
	$this->load->view($processing);
}
echo '<body id="body-main">';

echo '<div id="backdrop" class=""></div>'; //============= FOR BACKDROP !
if( isset($body) ){
	$this->load->view($body);
}
if( isset($scripts) ){
	$this->load->view($scripts);
}

echo '</body>';
echo '</html>';

// EoF !
