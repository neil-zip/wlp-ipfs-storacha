#!/usr/bin/env php
<?php
require_once('lib/uploadToIpfsStoracha.php');
require_once('lib/php-getFileSHA256.php');

// Check if a file path is provided as an argument
if ($argc > 1) {
    // $argv[0] is the script name
    // $argv[1] is the first argument (the file path)
    $filePath = $argv[1];
    //echo "x: $filePath";
    $obj = getFileSHA256($filePath);
    echo "Checksum-Sha256: " . getFileSHA256($filePath) . PHP_EOL;
    $obj = uploadToIpfsStoracha($filePath);
    echo "Repository: " . $obj['url'] . PHP_EOL;
} else {
    echo "Usage: php wis2.php <file_path>" . PHP_EOL;
}

