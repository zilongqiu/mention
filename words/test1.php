<?php

function readWords($file) {
    $data = file_get_contents($file);
    preg_match_all('#[^ \n]+#', $data, $m);
    return $m[0];
}

$validWords = readWords($argv[1]);
$inputWords = readWords($argv[2]);

$valid = array_intersect($inputWords, $validWords);
$invalid = array_map(function ($word) { return '<' . $word . '>'; }, array_diff($inputWords, $validWords));

echo implode(PHP_EOL, array_replace($inputWords, $invalid, $valid)) . PHP_EOL;
