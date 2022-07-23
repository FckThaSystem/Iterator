<?php

include __DIR__ ."/../vendor/autoload.php";

$src = __DIR__ . '/../src/doc.txt';
$iterator = new \Iterator\Components\MyIterator($src);
var_dump($iterator->readNeedle(100));