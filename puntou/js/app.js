'use strict'

  var wrapper = document.getElementById("signature-pad");
  var clearButton = wrapper.querySelector("[data-action=clear]");
  // var changeColorButton = wrapper.querySelector("[data-action=change-color]");
  // var undoButton = wrapper.querySelector("[data-action=undo]");
  // var savePNGButton = wrapper.querySelector("[data-action=save-png]");
  // var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
  // var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
  var canvas = wrapper.querySelector("canvas");
  var signaturePad = new SignaturePad(canvas, {
    // It's Necessary to use an opaque color when saving image as JPEG;
    // this option can be omitted if only saving as PNG or SVG
    backgroundColor: 'rgb(255, 255, 255)'
  });

  // Adjust canvas coordinate space taking into account pixel ratio,
  // to make it look crisp on mobile devices.
  // This also causes canvas to be cleared.
  function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);

    // This part causes the canvas to be cleared
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);

    // This library does not listen for canvas changes, so after the canvas is automatically
    // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
    // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
    // that the state of this library is consistent with visual state of the canvas, you
    // have to clear it manually.
    signaturePad.clear();
  }

  // On mobile devices it might make more sense to listen to orientation change,
  // rather than window resize events.
  window.onresize = resizeCanvas;
  resizeCanvas();

  function download(dataURL, filename) {
    if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
      window.open(dataURL);
    } else {
      var blob = dataURLToBlob(dataURL);
      var url = window.URL.createObjectURL(blob);

      var a = document.createElement("a");
      a.style = "display: none";
      a.href = url;
      a.download = filename;

      document.body.appendChild(a);
      a.click();

      window.URL.revokeObjectURL(url);
    }
  }

  // One could simply use Canvas#toBlob method instead, but it's just to show
  // that it can be done using result of SignaturePad#toDataURL.
  function dataURLToBlob(dataURL) {
    // Code taken from https://github.com/ebidel/filer.js
    var parts = dataURL.split(';base64,');
    var contentType = parts[0].split(":")[1];
    var raw = window.atob(parts[1]);
    var rawLength = raw.length;
    var uInt8Array = new Uint8Array(rawLength);

    for (var i = 0; i < rawLength; ++i) {
      uInt8Array[i] = raw.charCodeAt(i);
    }

    return new Blob([uInt8Array], { type: contentType });
  }

  clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
  });

  // undoButton.addEventListener("click", function (event) {
  //   var data = signaturePad.toData();
  //
  //   if (data) {
  //     data.pop(); // remove the last dot or line
  //     signaturePad.fromData(data);
  //   }
  // });

  // changeColorButton.addEventListener("click", function (event) {
  //   var r = Math.round(Math.random() * 255);
  //   var g = Math.round(Math.random() * 255);
  //   var b = Math.round(Math.random() * 255);
  //   var color = "rgb(" + r + "," + g + "," + b +")";
  //
  //   signaturePad.penColor = color;
  // });

  signaturePad.penColor = "#1a57a2";



  // savePNGButton.addEventListener("click", function (event) {
  //   if (signaturePad.isEmpty()) {
  //     alert("Please provide a signature first.");
  //   } else {
  //     var dataURL = signaturePad.toDataURL();
  //     download(dataURL, "signature.png");
  //   }
  // });

  // saveJPGButton.addEventListener("click", function (event) {
  //   if (signaturePad.isEmpty()) {
  //     alert("Please provide a signature first.");
  //   } else {
  //     var dataURL = signaturePad.toDataURL("image/jpeg");
  //     download(dataURL, "signature.jpg");
  //   }
  // });

  // saveSVGButton.addEventListener("click", function (event) {
  //   if (signaturePad.isEmpty()) {
  //     alert("Please provide a signature first.");
  //   } else {
  //     var dataURL = signaturePad.toDataURL('image/svg+xml');
  //     download(dataURL, "signature.svg");
  //   }
  // });

  $("#rate_type").on('change', function(){
    var f_amount = $("#f_amount").val();
    var rate_type = $(this).val();
    var result = f_amount * rate_type;
    console.log(result);
    var truncateDecimals = function (number, digits) {
      var multiplier = Math.pow(10, digits),
        adjustedNum = number * multiplier,
        truncatedNum = Math[adjustedNum < 0 ? 'ceil' : 'floor'](adjustedNum);
    
      return truncatedNum / multiplier;
    };
    var tf_amount = truncateDecimals(result, 2);
    console.log(tf_amount);
    $("#tf_amount").val(tf_amount);
  });

  $("#btn_send_firma").on('click',function(){
    $("#loader-pedir").show();
    if (signaturePad.isEmpty()) {

      console.log("Please provide a signature first.");
      $("#firma_description").html("<span class='noFirmo'>Es necesaria su firma</span>");

    } else {

      var miCanvas = document.querySelector("#canvasFirma");
      var miCanvasWidth = miCanvas.width;
      var miCanvasHeight = miCanvas.height;

      var newCanvas = document.createElement('canvas'); // creo nuevo canvas
      newCanvas.width = miCanvasWidth;
      newCanvas.height = miCanvasHeight;

      var ctx = newCanvas.getContext('2d'); // false: si el navegadorno lo soporta.

      //draw image to canvas. scale to target dimensions
      ctx.drawImage(miCanvas, 0, 0, newCanvas.width, newCanvas.height);

      var dataURI = newCanvas.toDataURL('img/png');

      var travel_id = $("#viaje_id").val();
      var f_amount = $("#f_amount").val();
      var tf_amount = $("#tf_amount").val();

      step_firma_to = setInterval(function(){
        $.ajax({
          url: 'ajax/firmas.php',
          type: 'POST',
          dataType: 'json',
          data: {travel_id, dataURI, f_amount, tf_amount},
          beforeSend: function(){
          },
          error: function(){
            console.log("error con ajax -> firmas");
          },
          success: function(respuesta){
            console.log("desdePHP: "+respuesta[1]);
            console.log("url_web: "+respuesta[2]);
            var dir_firma = respuesta[3];
            $.ajax({
              url: 'ajax/send_mail.php',
              type: 'POST',
              dataType: 'json',
              data: {travel_id, dir_firma},
              success: function(data){
                clearInterval(step_firma_to);
                if (data.status == "mail enviado") {
                  $("#loader-pedir").hide();
                  change_section("home");
                  console.log('mail enviado correctamente');
                } else {
                  console.log('el mail no se envio');
                }
                
              },
              error: function(){
                console.log("error con ajax -> send_firma.php");
              },
            });
            // change_section("home");
            // change_section("viaje_calificar");
          }
        });
      },5000);
    }    
  });

  $("#btn_send_vale").on('click',function(){
    console.log("safdjlkfljksdafkljfsdad");
    $("#loader-pedir").show();
    

      var miCanvas = document.querySelector("#canvasVale");
      var miCanvasWidth = miCanvas.width;
      var miCanvasHeight = miCanvas.height;

      var newCanvas = document.createElement('canvas'); // creo nuevo canvas
      newCanvas.width = miCanvasWidth;
      newCanvas.height = miCanvasHeight;

      var ctx = newCanvas.getContext('2d'); // false: si el navegadorno lo soporta.

      //draw image to canvas. scale to target dimensions
      ctx.drawImage(miCanvas, 0, 0, newCanvas.width, newCanvas.height);

      var dataURI = newCanvas.toDataURL('img/png');

      var travel_id = $("#viaje_id").val();
      var f_amount = $("#f_amount").val();
      var tf_amount = $("#tf_amount").val();

      step_firma_to = setInterval(function(){
        $.ajax({
          url: 'ajax/firmas.php',
          type: 'POST',
          dataType: 'json',
          data: {travel_id, dataURI, f_amount, tf_amount},
          beforeSend: function(){
          },
          error: function(){
            console.log("error con ajax -> firmas -> vale");
          },
          success: function(respuesta){
            console.log("desdePHP: "+respuesta[1]);
            console.log("url_web: "+respuesta[2]);
            var dir_firma = respuesta[3];
            $.ajax({
              url: 'ajax/send_mail.php',
              type: 'POST',
              dataType: 'json',
              data: {travel_id, dir_firma},
              success: function(data){
                clearInterval(step_firma_to);
                if (data.status == "mail enviado") {
                  $("#loader-pedir").hide();
                  change_section("home");
                  console.log('mail enviado correctamente -> vale');
                } else {
                  console.log('el mail no se envio -> vale');
                }
                
              },
              error: function(){
                console.log("error con ajax -> send_firma.php -> vale");
              },
            });
            // change_section("home");
            // change_section("viaje_calificar");
          }
        });
      },5000);    
  });