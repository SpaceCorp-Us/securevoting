<?php

// Usage: formatCaption($str)
function formatCaption($str,$lower=false){
   $var = trim($str);
   $var = str_replace('-','- ',$var);
   $var = str_replace('_',' ',$var);
   $var = ucwords($var);
   $var = str_replace('- ','',$var);
   if($lower){
      $var = strtolower($var);
   }
   return $var;
}

// Usage: getDirs($path)
function getDirs($path){
   $ary = array();
   $x = 0;
   if( $handle=opendir($path) ){
      while( ($file=readdir($handle))!==FALSE ){
         if( $file!='.' && $file!='..' ){
            if( is_dir($path.$file) ){
               $ary[$x]=trim($file);
               $x++;
            }
         }
      }
      closedir($handle);
      clearstatcache();
      return $ary;
   } else {
      return FALSE;
   }
}

// Usage: getFiles($path)
function getFiles($path){
   $ary = array();
   $x = 0;
   if( $handle=opendir($path) ){
      while( ($file=readdir($handle))!==FALSE ){
         if( $file!='.' && $file!='..' ){
            if( !is_dir($path.$file) ){
               $ary[$x]['id']=substr($file,0,-4);
               $ary[$x]['filename']=trim($file);
               $ary[$x]['pathFile']=trim($path.$file);
               $x++;
            }
         }
      }
      closedir($handle);
      clearstatcache();
      return $ary;
   } else {
      return FALSE;
   }
}

// Usage: getFilesR($ary,$path,'.xml')
function getFilesR(&$ary,$path,$filter='.json'){
   global $x;
   if( $handle=opendir($path) ){
      $x = count($ary);
      while( ($file = readdir($handle))!== FALSE ){
         if( $file!='.' && $file!='..' ){
            //=========================================================
            $tempDir = $path.$file;
            if( stristr($file,$filter)!==FALSE && is_file($tempDir) ){
               $pathParts = explode('/',substr(trim($path),0,-1));
               $ary[end($pathParts)][$x]['fileName']=trim($file);
               $ary[end($pathParts)][$x]['filePath']=trim($path);
               $ary[end($pathParts)][$x]['pathFile']=trim($tempDir);
               $x++;
            } else if( is_dir($tempDir) ){
               $this->getFilesR($ary,$tempDir.'/',$filter);
            }
            //=========================================================
         }
      }
      closedir($handle);
      clearstatcache();
      //sort($ary, SORT_REGULAR);
   } else {
      return FALSE;
   }
}

function outputArray($ary){
   echo '<pre style="float:left; background:rgba(50,50,50,0.75); text-align:left; margin:5px 5px;
      padding:8px 10px; color:#CF0; border-radius:6px;">';
   //echo '<div style="clear:both;">Diagnostic Output - '.$this->getVarName($ary).'</div>';
   //echo '<hr>';
   print_r($ary);
   echo '</pre>';
}


// EoF !
