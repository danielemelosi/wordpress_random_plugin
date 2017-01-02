<?php
/* 
Plugin Name: Random
Plugin URI: http://www.melosi.it/scripts/
Description: Shows random images (based all images in your wp-content/images directory) or random notes (based on a file) in your wordpress web sites
Version: 0.0.1
Author: Daniele Melosi
Author URI: http://www.melosi.it/

Copyright 2016 Daniele Melosi (d@melo.si)
*/

function dmelosi_random_image() {
	$FOTO_RANDOM_PATH = dirname( __FILE__ ) . "/foto";
	$FOTO_PATH = "/wp-content/plugins/random";
	$i = 0;
	if ( $handle = @opendir ( $FOTO_RANDOM_PATH ) ) {
		while ( false !== ( $file = readdir ( $handle ) ) ) {
			if ( $file != "." && $file != ".." ) {
				$IMAGE[$i] = "$file";
				$i++;
			}
		}                                
		closedir($handle);
	}
       	echo "<br/>";
	echo "<center>";
	if ( $i > 0 ) {
		echo "<img border='0' src='$FOTO_PATH/foto/".$IMAGE[rand ( 0 , sizeof ( $IMAGE ) - 1 )]."' alt='Foto random Daniele Melosi'/>";
        } else {
        	echo "<img border='0' src='$FOTO_PATH/default.jpg' alt='Foto default Daniele Melosi'/>";
        }
	echo "</center>";
}

add_shortcode('random_image', 'dmelosi_random_image');

function dmelosi_random_note() {
	// Inserisce un detto random (preso dal file $FILENAME)
        // Se non trova trova il file inserisce "La curiosit&agrave; uccise il gatto"
	$FILENAME = dirname( __FILE__ ) . "/detti.txt";
	echo "<center>";
	if ( file_exists ( $FILENAME ) ) {
		srand ( ( double ) microtime() * 1000000 );
		$arry_txt = preg_split ( "/--NEXT--/" , join ( '' , file ( $FILENAME ) ) );
		echo $arry_txt[rand ( 0 , sizeof ( $arry_txt ) - 1 )];
	} else {
		echo "la curiosit&agrave; uccise il gatto!!!";
	}
	echo "</center>";
}
add_shortcode('random_note', 'dmelosi_random_note'); 

?>
