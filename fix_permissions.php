<?php
// fix_permissions.php
// Place this file in your 'htdocs' folder and visit http://your-site.com/fix_permissions.php

echo "<h1>Attempting to Fix Permissions...</h1>";

$dirs = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache'
];

foreach ($dirs as $dir) {
    $path = __DIR__ . '/' . $dir;
    
    if (!file_exists($path)) {
        echo "<p style='color:orange'>[MISSING] $dir does not exist. Attempting to create...</p>";
        @mkdir($path, 0777, true);
    }

    if (is_writable($path)) {
        echo "<p style='color:green'>[OK] $dir is already writable.</p>";
    } else {
        if (@chmod($path, 0777)) {
            echo "<p style='color:green'>[FIXED] Changed permissions for $dir to 0777.</p>";
        } else {
            echo "<p style='color:red'>[FAILED] Could not change permissions for $dir. You MUST use FileZilla (FTP).</p>";
        }
    }
}

echo "<hr><p>Done. <a href='/'>Go to Homepage</a></p>";
echo "<p><strong>Security Warning:</strong> Please delete this file after use!</p>";
?>
