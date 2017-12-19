<?php
require 'vendor/autoload.php';

$day = date('j');
$found = false;
while (!$found && $day > 0) {
    $folder = 'src/Day' . $day . '/';
    if (file_exists($folder . 'Main.php')) {
        $found = true;
    } else {
        $day--;
    }
}
$part = isset($argv[1]) ? (int)$argv[1] : 1;

echo 'Running day ' . $day . ' part ' . $part . PHP_EOL;
$class = '\Liquorvicar\AdventOfCode\Day' . $day . '\Main';

$input = file($folder . 'input.txt');

//$input = array_map('trim', $input);

/** @var \Liquorvicar\AdventOfCode\IMain $counter */
$counter = new $class;

if ($part == 1) {
    echo $counter->runPartOne($input);
} else {
    echo $counter->runPartTwo($input);
}
