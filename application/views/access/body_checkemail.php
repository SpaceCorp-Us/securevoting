<?php 

echo '<div id="backdrop"></div>';

$this->load->view('rowA/rowA');

$this->load->view('rowB/rowB');

$data = array(
	'page' => 'check_email'
);
$this->load->view('access/rowC',$data);//

$this->load->view('rowD/rowD');

$this->load->view('rowE/rowE');

$this->load->view('logo');

echo '
<script type="text/javascript">
$(document).ready(function(){
	//$("#UserName").focus();
});
</script>
';

//
