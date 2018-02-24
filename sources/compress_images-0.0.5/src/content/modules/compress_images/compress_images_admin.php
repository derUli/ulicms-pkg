<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "image_compression" ) );
define ( MODULE_ADMIN_REQUIRED_PERMISSION, "compress_images" );

include_once getModulePath ( "compress_images", true ) . "compress_images_lib.php";
include_once "../lib/formatter.php";

if (isset ( $_POST ["submit"] )) {
	// Max Execution Time auf Endlos
	@set_time_limit ( 0 );
	@ini_set ( 'max_execution_time', 0 );
	
	$quality = getconfig ( "image_quality" );
	if (! $quality) {
		$quality = 70;
	}
	
	$image_dir = "../content";
	
	if (is_dir ( $image_dir )) {
		$files = find_all_files ( $image_dir );
		for($i = 0; $i < count ( $files ); $i ++) {
			$f = $files [$i];
			$ext = pathinfo ( $f, PATHINFO_EXTENSION );
			$ext = strtolower ( $ext );
			if ($ext === "jpg" or $ext === "jpeg" or $ext === "png" or $ext === "gif") {
				
				$fCompressedFile = str_replace ( "\\", "/", dirname ( $f ) ) . "/." . basename ( $f ) . "-compressed";
				
				if (! file_exists ( $fCompressedFile )) {
					echo "<p style=\"width:100%;\">";
					echo "Komprimiere " . basename ( $f ) . "... ";
					fcflush ();
					
					clearstatcache ();
					$filesize_old = filesize ( $f );
					compress_image ( $f, $f, $quality );
					clearstatcache ();
					$filesize_new = filesize ( $f );
					@$handle = fopen ( $fCompressedFile, "w" );
					@fwrite ( $handle, get_translation("old_size", array(
					"%size%" =>formatSizeUnits ( $filesize_old ) )));
					@fwrite ( $handle, "\r\n" );
					@fwrite ( $handle, "Neue Größe: " . formatSizeUnits ( $filesize_new ) );
					@fwrite ( $handle, get_translation("new_size", array(
					"%size%" =>formatSizeUnits ( $filesize_new ) )));
					@fwrite ( $handle, "\r\n" );
					
					$ratio = round ( $filesize_new / ($filesize_old / 100), 2 );
					$ratio_str = get_translation ( "ratio", array (
							"%ratio1%" => $ratio,
							"%ratio2%" => formatSizeUnits ( $filesize_old - $filesize_new ) 
					) );
					
					echo $ratio_str;
					
					fcflush ();
					
					@fwrite ( $handle, $ratio_str );
					
					@fclose ( $handle );
					
					echo "<span style='float:right; color:green'>[" . get_translation ( "finished" ) . "]</span>";
					fcflush ();
					echo "</p>";
				}
			}
		}
	}
}

// Konfiguration checken
$send_comments_via_email = getconfig ( "blog_send_comments_via_email" ) == "yes";
function compress_images_admin() {
	?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
	
	csrf_token_html ();
	?>
<input type="submit" name="submit"
		value="<?php translate("do_compression");?>" />
</form>
<?php
}

?>
