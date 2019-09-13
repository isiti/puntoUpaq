googleAPI = 'AIzaSyD-r6h1sqaeJCQDeDzD5t4m5nuFKM8NGBc'; // As many as 25k request per day

function geocode(lat,long,destino) {
    var coords ={};
    latitude= parseFloat(lat).toFixed(7);
    latitude1 = parseFloat(latitude);
    var length = parseFloat(long).toFixed(7);
    var length1= parseFloat(length);
    coords.location = {lat:latitude1, lon:length1};
    //var locat = new google.maps.LatLng(latitude1, length1);
    var array_n = new Array(latitude1,length1);
    //var latlng = {lat: lat, lng: long};
    axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
        params: {
            latlng: latitude1+","+length1,
            key: googleAPI
        }
    }).then(function (response) {
        if (response.data.results[0] != undefined)
        {
            var fa = response.data.results[0]['formatted_address'];
            var arr = fa.split(',');
            var calle = arr[0];
            
            //return calle;
            $("#"+destino).val(calle);
            $("#"+destino+"-r").val(calle);
            $("#"+destino+"-flota").val(calle);
            $("#"+destino+"-r-flota").val(calle);
            $("#"+destino+"-esp").val(calle);

        }
        else
        {
            //return 'na';
            //Do something
        }
        //console.log(response);
    }).catch(function (error) {
        console.log(error);
    });
}