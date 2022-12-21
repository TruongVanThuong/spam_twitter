<?php
 $f_contents = file("name.txt"); 
    echo $line = $f_contents[rand(0, count($f_contents) - 1)];
	?>