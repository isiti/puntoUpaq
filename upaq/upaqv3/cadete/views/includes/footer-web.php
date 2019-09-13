<?php if( isset($_SESSION['id']) ) { }
    
    include("../pages/footer-bottom.php");
?>  
        </div> 
        <!-- end->cms -->
        
    </body>
    <!-- audio-flies -->
    <audio 
        id="audio-alert" 
        src="<?="//$url_web/"?>assets/audio/alert.mp3" 
        preload="auto"
    ></audio>
    <audio 
        id="audio-fail" 
        src="<?="//$url_web/"?>assets/audio/fail.mp3" 
        preload="auto"
    ></audio>


    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jquery-ui -->
    <script src="<?="//$url_web/"?>js/plugins/jquery-ui/jquery-ui.min.js"></script>


    <!-- bootstrap -->    
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" 
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" 
        crossorigin="anonymous"
    ></script>
    <script 
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" 
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" 
        crossorigin="anonymous"
    ></script>


    <!-- moment-js -->
    <script src="<?="//$url_web/"?>js/plugins/moment-js/moment.js"></script>


    <!-- slick-carousel -->
    <script src="<?="//$url_web/"?>js/plugins/slick/slick/slick.js"></script>

    <!-- notie-master -->
    <script src="<?="//$url_web/"?>js/plugins/notie-master/dist/notie.min.js"></script>


    <!-- jscolor -->
    <script src="<?="//$url_web/"?>js/plugins/jscolor/jscolor.js"></script>
    

    <!-- quilljs -->  
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    
    <!-- simplebar -->
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.js"></script>

    <!-- leafletjs -->
    <script 
        src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""
    ></script>

    <!-- leaflet - routing machine -->
    <script src="<?="//$url_web/"?>js/plugins/routing-machine/leaflet-routing-machine.js"></script>
    <!-- leaflet geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
       

    <!-- vuejs -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js">// development version </script> 
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue"> // production version </script> -->
    <!-- vuex -->
    <script src="<?="//$url_web/"?>js/plugins/vuex/vuex.js"></script>
    <script src="<?="//$url_web/"?>components/vue-components/vuex/store.js"></script>
    <!-- vue-components -->
    <script src="<?="//$url_web/"?>components/vue-components/vue-basic-components.js"></script>
    <script src="<?="//$url_web/"?>components/vue-components/EditorTexto.js"></script>
    <script src="<?="//$url_web/"?>components/vue-components/ColorPicker.js"></script>
    <script src="<?="//$url_web/"?>components/vue-components/Carousel.js"></script>
    <script src="<?="//$url_web/"?>components/vue-components/TableScroll.js"></script>


    <!-- vue-functions -->
    <script src="<?="//$url_web/"?>js/vue/vue-functions.js"></script>

    <!-- java-script files -->
    <!-- <script src="<?="//$url_web/"?>js/app.js"></script> -->
    <script src="<?="//$url_web/"?>js/functions.js"></script>

<?php //}//está logeado?? ?>
</html>


