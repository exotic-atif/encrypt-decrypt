<?php
$dir = ".";  // Current directory
$files = scandir($dir);  // Scan the directory

echo "<center><h1>Directory Listing</h1>";
echo "<h2>";

foreach ($files as $file) {
    // Exclude the current and parent directory references
    if ($file != "." && $file != ".." && $file != "index.php") {
        echo "<hr width='50%' color='black'><a href='" . $file . "'>" . $file . "</a><br><hr width='50%' color='black'><br>";
    }
}

echo "</h2></center>";
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
 a{
   color: #007ffc;
   text-decoration: none;
}
</style>
