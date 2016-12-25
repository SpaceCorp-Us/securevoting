<?php

echo '<div id="rowC" class="rowC">';
//==============================================

$this->load->view('rowC/colA');

if( isset($page) && $page!='' ){
	$this->load->view('access/'.$page);
} else {
	$this->load->view('rowC/colB');
}

$this->load->view('rowC/colC');

//==============================================
echo '</div>';

//
