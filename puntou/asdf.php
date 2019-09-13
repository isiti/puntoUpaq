<!DOCTYPE html>

<html>

     <head>
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
     </head>

     <body>
          <p>Address: <div id="address"></div></p>
     </body>

     <script type="text/javascript" charset="utf-8">

     $(document).ready(function() {
        var x = document.getElementById("address");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        }

        getLocation();
    });

    </script>

</html>