		<?php
			
        
			$fullname = $_POST['fullname'];
			$gender = $_POST['gender'];
			$id_province = $_POST['id_province'];
			$id_city = $_POST['id_city'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			echo "<div>".$fullname."</div>";
			echo "<div>".$gender."</div>";
			echo "<div>".$id_province."</div>";
			//echo "<div>".$id_city."</div>";
			echo "<div>".$email."</div>";
			echo "<div>".$password."</div>";
						   
			//$password = $login->encrypt_password($_POST['password']);
						 
			//$sql = "UPDATE users SET fullname = '$fullname',  gender='$gender', id_province='$id_province', id_city='$id_city', email='$email', password='$password' WHERE id='$_SESSION[id]'" ;
			//$retval = mysqli_query($sql, $dbConn);
					 
			?>