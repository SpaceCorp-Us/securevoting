<?php 

echo '<div id="rowC" class="rowC">';

$this->load->view('rowC/colA');

$data = array(
	'rec' => $rec
);
$this->load->view('edit/edit',$data);

$data2 = array(
	'basePath' => $basePath
);
$this->load->view('rowC/colC',$data2);

echo '</div>';

//
