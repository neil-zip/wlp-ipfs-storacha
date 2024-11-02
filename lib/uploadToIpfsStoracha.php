<?php

function uploadToIpfsStoracha($path) {
    // Start output buffering
    ob_start();

    // Command to execute, redirecting output to /dev/null
    $command = 'w3 up '.escapeshellarg($path);

    // Execute the command and capture the output
    exec($command . ' 2>&1', $output, $returnVar); // Capture any error output

    // Check if the command executed successfully
    if ($returnVar !== 0) {
        // Flush the output buffer and print error message
        ob_end_flush(); // End buffering and flush any output
        echo json_encode(['error' => "Error executing command: " . implode("\n", $output)]);
        return; // Return early on error
    }

    // Assuming the last line of output is the relevant one
    $lastOutput = end($output);

    // Extracting the URL
    if (preg_match('/(https?:\/\/[^\s]+)/', $lastOutput, $urlMatch)) {
        $url = $urlMatch[0];

        // Extracting the CID from the URL (everything after the last '/')
        $cid = basename($url); // Gets the last part of the URL

        // Prepare the result as an associative array
        $result = [
            'url' => $url,
            'cid' => $cid
        ];

        // End output buffering, flush, and return JSON-encoded result
        ob_end_flush(); // End buffering and flush any output
        return ($result);
    } else {
        // Flush the output buffer and print error message
        ob_end_flush(); // End buffering and flush any output
        echo json_encode(['error' => "URL not found in output."]);
        return; // Return early on error
    }
}

// Test Run the function to upload the file and print the result
//$result = uploadFile();
//if ($result) {
//    echo $result; // Only print the result if it's valid
//}

