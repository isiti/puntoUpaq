<?php
    if (isset($_GET['code']))
    {
        //Paso 1 - Traigo el hash
        $hash = $_GET['code'];

        //Paso 2 - Compruebo que exista el codigo como valido en la base de datos.
        $record = get_records_db('recover',"hash = '$hash' AND claimed = 0",1);
        if (empty($record))
        {
            //Paso 2b - Si no hay record, por alguna razon el hash es invalido, y devuelvo al home reloadeando
            redireccionar("?error=bad-rec");
        }        
        //Paso 3 - Si el record es correcto, sigo con el pedido del nuevo password (guardo el id, que ya traje, en sesion)

        $_SESSION['id'] = $record['id_user'];
        $_SESSION['id_recover'] = $record['id'];
    }
?>
<div class="show-content" data-section="new-pass">       
<div class="container">
		<div class="title">
			Nueva Contraseña
		</div>
		<div class="content">
            <div class="fill-in">
                <form action="" method="post" id="datos">
                    <div class="field">
                        <input type="password" name="password" id="password" placeholder="Nueva Contraseña" required="required" />
                    </div>
                    <div class="register">
                        <button type="submit" id="submit_new_pass" name="submit" value="submit">Cambiar Contraseña</button>
                    </div>                    
                    <div class="ing">
                        <span>¿Ya tenés una cuenta? </span><a href="<?=$url_web?>">Ingresá</a>
                    </div>
                </form>
            </div>            
		</div>		
	</div>    
</div>