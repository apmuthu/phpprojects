<?php
file_fix_directory(dirname(__FILE__));

function file_fix_directory($dir, $nomask = array('.', '..')) {
  if (is_dir($dir)) {
     // Try to make each directory world readable and executable, server writable as well.
     if (@chmod($dir, 0755)) {
       echo "<p>Made writable: " . $dir . "</p>";
     }
  }
  if (is_dir($dir) && $handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
      if (!in_array($file, $nomask) && $file[0] != '.') {
        if (is_dir("$dir/$file")) {
          // Recurse into subdirectories
          file_fix_directory("$dir/$file", $nomask);
        }
        else {
          $filename = "$dir/$file";
            // Try to make each file world readable, server writeable as well.
            if (@chmod($filename, 0644)) {
              echo "<p>Made readable: " . $filename . "</p>";
            }
        }
      }
    }

    closedir($handle);
  }

}
