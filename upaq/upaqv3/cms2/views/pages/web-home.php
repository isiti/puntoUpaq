<?php
	if(!isset($_SESSION['id'])) redireccionar('/');
?>

<section id="ejemplos-cms">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <!-- Page Content  -->
            <div id="content">
                <div id="content-orders">
                    <?php include 'orders.php'?>
                </div>

                <div id="content-users">
                    <?php include 'users.php'?>
                </div>

                <div id="content-cadets">
                    <?php include 'cadets.php'?>
                </div>

                <div id="content-tarifas">
                    <?php include 'tarifas.php'?>
                </div>
            </div>
        </div>
    </div>
</section>