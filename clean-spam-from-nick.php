<?php
if(count($argv) != 3) {
  echo "Usage: php clean-spam.php 2018-08-01 \"nick\"\n";
  die();
}

$inputdate = $argv[1];
$nick = $argv[2];

$channels = glob('*/*');
print_r($channels);

foreach($channels as $channel) {

  $date = new DateTime($inputdate);
  $filename = $channel.'/'.$date->format('Y/m/d').'.txt';

  if(!file_exists($filename)) {
    echo "Could not find file for date ".$date->format('Y-m-d')."\n";
    continue;
  }

  echo "Removing spam from #$channel ".$date->format('Y-m-d')." from nick '$nick'\n";

  $new = fopen('tmp.txt', 'w');
  $fp = fopen($filename, 'r');

  while($line = fgets($fp)) {
    if(trim($line)) {
      list($date, $time, $json) = explode(' ', $line, 3);
      $data = json_decode($json, true);
      $phrase = $nick.' said: ';
      if($data['author']['nickname'] == $nick
        || $data['author']['nickname'] == 'Loqi' && strpos($data['content'], $phrase) !== false) {
        echo "$channel Deleting line from ".$data['author']['nickname']."\n";
      } else {
        fwrite($new, $line);
      }
    }
  }

  fclose($new);
  fclose($fp);

  rename('tmp.txt', $filename);

}
