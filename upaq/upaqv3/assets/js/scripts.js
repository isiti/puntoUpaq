$.widget( 'app.selectmenu', $.ui.selectmenu, {
  _drawButton: function() {
    this._super();
    var placeholder = this.options.placeholder;
    /*var selected = this.element
    .find( '[selected]' )
    .length,
        placeholder = this.options.placeholder;

    if (!selected && placeholder) {*/
      this.buttonItem.text( placeholder );
    //}
  }
});
$( function() {
    $( document ).ready( function(){
    	$( "select.select-f" ).selectmenu({ width: '100%', height: '40px', placeholder: 'Seleccione el tipo de envío' });
    	$( "select.select-n" ).selectmenu({ width: '100%', height: '40px', placeholder: 'Localidad' });
    	$(".flexnav").flexNav();
    });
} );