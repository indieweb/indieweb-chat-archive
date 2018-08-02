<?php
if(count($argv) != 3) {
  echo "Usage: php clean-spam.php 2018-08-01 \"phrase to match\"\n";
  die();
}

$date = $argv[1];
$phrase = $argv[2];

$channels = glob('*/*');
print_r($channels);

foreach($channels as $channel) {

  $date = new DateTime($date);
  $filename = $channel.'/'.$date->format('Y/m/d').'.txt';

  if(!file_exists($filename)) {
    echo "Could not find file for date ".$date->format('Y-m-d')."\n";
    die();
  }

  echo "Removing spam from #$channel ".$date->format('Y-m-d')." that matches '$phrase'\n";

  $new = fopen('tmp.txt', 'w');
  $fp = fopen($filename, 'r');

  while($line = fgets($fp)) {
    if(trim($line)) {
      list($date, $time, $json) = explode(' ', $line, 3);
      $data = json_decode($json, true);
      if(strpos($data['content'], $phrase) !== false) {
        echo "$channel Ignoring line from ".$data['author']['nickname']."\n";
      } else {
        fwrite($new, $line);
      }
    }
  }

  fclose($new);
  fclose($fp);

  rename('tmp.txt', $filename);

}
