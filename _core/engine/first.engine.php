<?php
/*
  20181027 : by devkim
*/



function safeInputs(&$c) {
  
  if(!$c || !is_array($c)) return;

  static $lv = 0;

  foreach($c as &$v) {
  
    if(is_array($v)) {
    
      $lv++;
    
      safeInputs($v);
      
      continue;
      
    }
  
    $v = escapeFnc($v);
    
   if($lv < 2) setGBValues($k,$v);
  
  }
  
  if($lv > 0) $lv--;

}

function escapeFnc($c) {

  return htmlspecialchars($c);

}

function setGBValues($k,$v) {
  
  $GLOBALS[$k] = $v;

}

safeInputs($_REQUEST);

  
?>
