<?php
function djb($str) {
  $h = 5381;
  $strlen = mb_strlen($str);
  for($i = 0; $i < $strlen; $i++ ) {
    $h += ($h << 5);
    $h += ord($str[$i]);
    $h &= 0xFFFFFFFF;
  }
  return $h;
}

function loopDuplicates($duplicates, $times = 10)
{
  $keys = array();
  $origDuplicates = array('Ez','FY');
  $times--;
  foreach($duplicates as $dup)
  {
    foreach($origDuplicates as $origDup)
    {
      $keys[] = $dup.$origDup;
    }
  }
  return ($times > 0) ? loopDuplicates($keys,$times) : $keys;
}
