<?php
require 'vendor/autoload.php';

$config = [
  'host'    => 'localhost',
  'driver'  => 'mysql',
  'database'  => 'test',
  'username'  => 'root',
  'password'  => 'root',
  'charset' => 'utf8',
  'collation' => 'utf8_general_ci',
  'prefix'   => ''
];

$db = new \Buki\Pdox($config);

if (!function_exists('dd')) {
  function dd($data, $var_dump = false) {
    echo "<pre>";
    if ($var_dump) {
      var_dump($data);
    } else {
      print_r($data);
    }
    echo "</pre>";
    die;
  }
}

if (!function_exists('dump')) {
  function dump($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }
}
