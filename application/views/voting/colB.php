<?php

echo '<div id="rowCcolB" class="colB">';
//======================================================
if( isset($_SESSION['Logged_In']) && $_SESSION['Logged_In']==1 ){
echo '<div class="centerCenterColumn" style="position:relative; width:100%; height:100%;">';

// get ballot fields


echo '<form class="formBase" style="" method="post" action="">';
echo '<div class="formHead" style="">OFFICIAL VOTING BALLOT</div>';
echo '';// Hidden Items ?
echo '<div class="formContent" style="">';

echo '</div>';
echo '<div class="formFoot" style="">';
echo '<input class="button formButton" style="" type="submit" value="SUBMIT"/>';
echo '</div>';
echo '</form>';

//$this->shared_model->outputArray($_SESSION);
echo '</div>';
} else {
   redirect('access/login');
}
//======================================================
echo '</div>';

//
