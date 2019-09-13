// INFO: INSTANCIA DE VUE (SE INCLUYE EL STORE DE VUEX)

'use strict'

const cms = new Vue({
    el: '#cms', 
    store: store,   
    data: {
        origen: '',
        depto_origen: '',
        destino: '',
        depto_destino: '',
        selected: '',
        tipo: '',
        destinatario: '',
        descripcion: '',        
    },    
    methods: {

    },
    computed: {        

    }
})
