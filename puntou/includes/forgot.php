<?php
	session_start();
	require('config.php');

	if(isset($_SESSION['email'])) redireccionar("/home");



	if(!isset($_SESSION['recovery'][1]) && !is_numeric($_SESSION['recovery'][1])) {
		$_SESSION['recovery'][1] = mt_rand(0,10);
	}

	if(!isset($_SESSION['recovery'][2]) && !is_numeric($_SESSION['recovery'][2])) {
		$_SESSION['recovery'][2] = mt_rand(0,10);
	}

	$num1 = is_numeric($_SESSION['recovery'][1])?$_SESSION['recovery'][1]:0;
	$num2 = is_numeric($_SESSION['recovery'][2])?$_SESSION['recovery'][2]:0;



	//paso 0: limpio y aseguro todo
	$email = secure_input($_POST['email']);		

	//paso1: verifico que el mail exista

	$db_email = get_records_db("users","email='$email'",1);
	
	$db_email = $db_email[0];		

	//paso 2: genero el hash

	if($db_email['email']!="") {
		$hash = substr(md5(uniqid(rand())),0,32);
		$hash .= substr(md5(uniqid(rand())),0,32);
	}

	//paso 3: inserto en la DB el hash y hago el claimed

	if(isset($hash)) {
		//$query  = "INSERT INTO `recover` (`id_users`,`hash`,`claimed`) VALUES ('$db_email[id]','$hash','0')";
        //$result = mysqli_query($dbConn, $query);
        //var_dump($result);
        $datos = [['value'=>'id_user','required'=>1,'custom'=>""],['value'=>'hash','required'=>1,'custom'=>""],['value'=>'claimed','custom'=>""]];
        $_POST['id_user'] = (int)$db_email['id'];
        $_POST['hash'] = $hash;
        $_POST['claimed'] = 0;
        $_POST['submit'] = 'submit';
        $error = get_form_cp($datos,"recover","");
 	}		

	//paso 4: envío mail con un link de recovery

	if($error == NULL) {
		//echo 'entre3';
		$array_mail = [
			"//$url_web/img/logo.png",
			"//$url_web/recovery?code=$hash",
			"Para recuperar su contraseña, por favor visite el siguiente enlace",
			"Recovery password <span>process</span>",
			"",
			"Si necesita mas ayuda, contactenos en <br/><span>support@matchat.com</span>"
		];			

		$sending_mail = send_mail("$db_email[email]","Recovery password link",$array_mail,$html="");
	}		

	//paso 5: limpio los numeros de verificación
	if(isset($sending_mail)) {
		//echo 'entre4';
		$_SESSION['recovery'][1] = "";
		$_SESSION['recovery'][2] = "";
		unset($_SESSION['recovery']);
		$email_sent = true;
	}
?>
