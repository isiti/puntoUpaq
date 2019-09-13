<section id="sec-tarifas">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12 info-tarifas">
            <h2>Tarifas Actuales:</h2>
            <ul id="list-tarifas"></ul>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 input-tarifas">
            <h2>Modificar tarifas:</h2>
            <form method="post" id="form-tarifas">
                <div class="form-group flex">
                    <label for="tdelivery-">Delivery</label>
                    <input type="int" name="delivery" class="form-control" id="tdelivery" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tmudenza-">Mudanza</label>
                    <input type="int" name="mudanza" class="form-control" id="tmudenza" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tbultog-">Bulto grande</label>
                    <input type="int" name="bultog" class="form-control" id="tbultog" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tbultopm-">Pequeño/mediano bulto</label>
                    <input type="int" name="bultopm" class="form-control" id="tbultopm" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tpaqueteg-">Paquete grande</label>
                    <input type="int" name="paqueteg" class="form-control" id="tpaqueteg" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tpaquetepm-">Pequeño/mediano paquete</label>
                    <input type="int" name="paquetemp" class="form-control" id="tpaquetepm" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="ttramite-">Trámite</label>
                    <input type="int" name="tramite" class="form-control" id="ttramite" placeholder="$">                    
                </div>

                <div class="form-group flex">
                    <label for="tsobre-">Sobre</label>
                    <input type="int" name="sobre" class="form-control" id="tsobre" placeholder="$">                    
                </div>
          
                <button type="button" id ="modificar" class="btn btn-primary">Modificar</button>
            </form>
        </div>
    </div>
</section>