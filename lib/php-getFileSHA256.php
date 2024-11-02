<?php

/**
 * Get the SHA-256 hash of a file.
 *
 * @param string $filePath The path to the file.
 * @return string|false The SHA-256 hash or false on failure.
 */
function getFileSHA256($filePath) {
    // Check if the file exists
    if (!file_exists($filePath)) {
        return false; // File does not exist
    }
    
    // Open the file for reading
    $file = fopen($filePath, 'rb');
    if (!$file) {
        return false; // Failed to open the file
    }

    // Initialize the hash context
    $hash = hash_init('sha256');

    // Read the file in chunks to avoid memory issues with large files
    while (!feof($file)) {
        $chunk = fread($file, 8192); // Read 8KB chunks
        hash_update($hash, $chunk);
    }

    // Close the file
    fclose($file);

    // Return the hex representation of the hash
    return hash_final($hash);
}

/*
// Example usage
$filePath = '/home/neil/ywall999png.png';
$hash = getFileSHA256($filePath);
if ($hash !== false) {
    echo "SHA-256 Hash: $hash\n";
} else {
    echo "Error reading file.\n";
}
//*/