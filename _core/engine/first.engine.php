<?php
/*
  20181027 : by devkim
*/



function safeInputs(&$c) {

  static $lv = 0;

  foreach($c as &$v) {
  
    if(is_array($v)) {
    
      $lv++;
    
      safeInputs($v);
      
      continue;
      
    }
  
    $v = escapeFnc($v);
    
   if($lv === 0) setGBValues($k,$v);
  
  }
  
  if($lv > 0) $lv--;

}

function escapeFnc($c) {

  return htmlspecialchars($c);

}

function setGBValues($k,$v) {

  global $INPUTS;
  
  $INPUTS[$k] = $v;

}

  
?>
