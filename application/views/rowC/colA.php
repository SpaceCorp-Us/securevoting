<?php

echo '<div id="rowCcolA" class="rowC colA" style="">';
//=====================================================================================

//echo '<div style="width:auto;">MENULEFT</div>';
$items = array();
$dataPath = '.config/menus/';
$items = $this->shared_model->pathFiles2Array($dataPath,'left');
sort($items);

for($x=0;$x<count($items);$x++){
   $item = json_decode(trim(file_get_contents($dataPath.$items[$x])),true);
   echo '<button class="squareButton" type="button"';
   echo ' onClick="window.open(\''.$basePath.$item['link'].'\',\''.$item['target'].'\');return false;"';
   echo '>'.$item['caption'].'</button>';
}

//$this->shared_model->outputArray($items);

//=====================================================================================
echo '</div>';

//
