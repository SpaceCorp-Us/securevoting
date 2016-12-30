<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
echo '<title>Political Comparison</title>';
echo '<link rel="stylesheet" type="text/css" href="default.css"/>';
?>
</head>

<body>
<?php
$parties = getDirs('./parties/');
$partyCount = count($parties);
sort($parties);

$issues = getFiles('./issues/');
$issueCount = count($issues);
sort($issues, SORT_REGULAR);

echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';

echo '<tr align="center" valign="middle">';
echo '<td style="font-size:20pt; padding:5px 10px;" colspan="'.($partyCount+1).'">Modern political party Comparisons</td>';
echo '</tr>';

echo '<tr align="center" valign="middle" class="lightShade" style="">';
echo '<td style="">Issues</td>';
// columns go here font-weight:bold;
for($x=0;$x<$partyCount;$x++){
   echo '<td class="parties">';
   //echo '<div style="float:left;">'.$x.'</div>';
   echo formatCaption($parties[$x]).'</td>';
}
echo '</tr>';

//outputArray($issues); // FOR TESTING !

// output issues
for($i=0;$i<$issueCount;$i++){
   echo '<tr align="center" valign="middle" class="" style="">';
   echo '<td class="issues" title="'.$i.'">';
   //echo '<div style="float:left;">'.$i.'</div>';
   echo file_get_contents($issues[$i]['pathFile']).'</td>';
   for($p=0;$p<$partyCount;$p++){
      if( file_exists('parties/'.$parties[$p].'/'.$i.'.txt') ){
         $val = trim(file_get_contents('parties/'.$parties[$p].'/'.$i.'.txt'));
         if( $val=='YES' ){
            echo '<td class="greenBG">'.$val.'</td>';
         } elseif( $val=='NO' ){
            echo '<td class="redBG">'.$val.'</td>';
         } else {
            echo '<td class="">'.$val.'</td>';
         }
      } else {
         echo '<td class="">~</td>';
      }
   }
   echo '</tr>';
}

//

echo '<tr align="center" valign="middle">';
echo '<td style="padding:5px 10px;" colspan="'.($partyCount+1).'">&nbsp;</td>';
echo '</tr>';

echo '</table>';


?>
</body>
</html>
