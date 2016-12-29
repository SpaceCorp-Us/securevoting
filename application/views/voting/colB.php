<?php

echo '<div id="rowCcolB" class="colB">';
//======================================================
if( isset($_SESSION['Logged_In']) && $_SESSION['Logged_In']==1 ){
echo '<div class="centerTopColumn" style="position:relative; width:100%; height:100%; overflow:auto;">';

// get ballot fields
$dataPath = '.ballots/';
$filesAry = array();
$this->shared_model->getFilesR($filesAry,$dataPath.$topic.'/','.php');

//$this->shared_model->outputArray($filesAry); // FOR TESTING !

echo '<form class="formBaseV" style="overflow:auto;" method="post" action="'.$basePath.'voting/vote">';
echo '<div class="formHeadV" style="">OFFICIAL VOTING BALLOT - '.$topic.'</div>';
echo '<input id="voterid" name="voterid" type="hidden" value="'.'">';// Hidden Items ?
if( file_exists($dataPath.$topic.'/header.txt') ){
   include $dataPath.$topic.'/header.txt';
}
echo '<div class="formContentV" style="">';

$keys = array_keys($filesAry);
for($x=0;$x<count($filesAry);$x++){
   sort($filesAry[$keys[$x]]);
   echo '<div class="sectionHead2">'.str_replace('_',' ',$keys[$x]).'</div>';
   for($y=0;$y<count($filesAry[$keys[$x]]);$y++){
      include $filesAry[$keys[$x]][$y]['pathFile'];
   }
}

//$this->shared_model->outputArray($filesAry); // FOR TESTING !

echo '</div>';
echo '<div id="formFooter" class="formFootV" style="">';
echo '<div id="total" style="float:left; margin:3px;"></div>';
echo '<input class="button formButton" style="" type="submit" value="SUBMIT"/>';
echo '<button id="legend" class="button formButton" type="button">Legend</button>';
echo '</div>';
echo '</form>';

//$this->shared_model->outputArray($_SESSION); // FOR TESTING !
echo '</div>';
} else {
   redirect('access/login');
}
//======================================================
echo '</div>';


echo '<script type="text/javascript">
var $numItems = $(".section").length;
var $total = 0;
var $fields = [];
$(document).ready( function() {

   $(".field").change( function() {
      var $curName = $(this).attr("name");
      if( $fields[$curName] != "set" ){
         var $n = $(this).val();
         $fields[$(this).attr("name")] = ["set"];
         getTotal($n);
      }
   });

   $("#legend").click(function(){
      $("#rowCcolC").empty();
      $("#rowCcolC").load("'.$basePath.'.data/legend.html");
   });

});

var getTotal = function($n) {
   if( $n!="" ){
      $total += 1;
      $("#total").empty();
      $("#total").append( "Answered: (" + $total + ") OF (" + $numItems + ")" );
      if( $total>=$numItems ){
         $("#total").css("color","darkgreen");
         $("#total").css("font-size","14pt");
         $("#total").css("font-weight","bold");
      } else {
         $("#total").css("color","darkred");
      }
   }
}

</script>';


//
