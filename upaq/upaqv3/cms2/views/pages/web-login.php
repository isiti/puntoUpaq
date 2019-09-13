<?php

//FORM
if(isset($_POST['submit'])) {
    $email_user = $_POST['email'];

    $users = array();
    $users = get_records_db("users", "email='$email_user'");

    if($users[0]['type'] == 'admin')
    {
        $datos = [
            "users",
            "email",
            "password",
            "en_US"
        ];

        $login = new login();
        $login = $login->start_login($datos);
    }
}
?>

<section class="row login-container" id="login">
    <div class="col-lg-4 col-md-4 col-xs-12 offset-lg-4 offset-md-4 login-box animated fadeInDown">
        <div class="login-body">
            <div class="row title-login">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <h5>Bienvenidos a UPAQ</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6 logo_inicio">
                    <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" alt="logo-login">
                </div>
            </div>

            <div style="color:#fff;"><?php if($login) {foreach ($login as $values) { echo "<li>$values</li>"; } } ?>
            </div>

            <form action="" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <input name="email" class="form-control" type="text" value="<?=$_POST['email']?>"
                            placeholder="email" required="required" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <input name="password" class="form-control" type="password" value="<?=$_POST['pw']?>"
                            placeholder="password" required="required" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 btn-login">
                        <button class="btn" type="submit" name="submit" value="Enviar">Entrar</button>
                    </div>

                    <div class="row subtitle-login" style="margin-top: 2em;">
                        <div class="col-lg-6 col-md-6 col-xs-12" style="float:left;">
                            <a href="recovery" class="btn btn-link btn-block" style="font-size:0.8em;">¿No recuerda su
                                contraseña??</a>
                        </div>

                        <div class="col-lg-6 col-md-6 col-xs-12" style="float:right;">
                            <div class="logo_login">
                                <a href="https://www.nexosmart.com.ar/">
                                    <img src="<?="//$url_web/"?>assets/images/logos/logo-nexo-h.png"
                                        alt="logo-nexosmart">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>