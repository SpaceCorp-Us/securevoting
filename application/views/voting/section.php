<?php

echo '<div class="section">';
   echo '<div class="sectionHead">'.$this->shared_model->formatCaption($runningFor).'</div>';
   echo '<div class="sectionContent">';

for($x=0;$x<count($candidates);$x++){
   $jsonFile = trim($this->config->item('dataDir').'candidates/'.$candidates[$x].'.json');
   if( file_exists($jsonFile) ){
      $json = file_get_contents( $jsonFile );
      $record = json_decode($json, true);
      echo '<input id="'.$runningFor.$x.'" class="field" type="radio" name="'.$runningFor.'" value="';
      echo $record['name'];
      echo '">';
      echo '<label for="'.$runningFor.$x.'">';
      echo $record['name'].' ('.$record['party'].') '.$record['comment'];
      echo '</label>';
      echo '<br>';
   }
}

   echo '</div>';
echo '</div>';


//  EoF !
