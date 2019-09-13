<?php			
    session_start();
	if ($_FILES["file"]["error"] > 0) {
	    echo "Error: " . $_FILES["file"]["error"] . "<br />";
	} else {
		$fname = ''.mt_rand(0,500000000)."_".$_SESSION['id'].'.jpg';

	    move_uploaded_file($_FILES["file"]["tmp_name"],__DIR__."/../img/" . $fname);

	    // Get fileURL path and show success alert
	    global $fileURL;
	    $fileURL = "/../img/" . $fname;

	    echo $fileURL;

	}
					 
?>