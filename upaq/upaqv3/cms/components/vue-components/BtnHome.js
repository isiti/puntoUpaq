'use strict'

const btnhome = Vue.component('button_home', {
    template: //html
    `
    <div class="btn-home">
        <h5 class="btn-home-title">{{title}}</h5>
        <p class="btn-home-total" :id="total"></p>
    </div>
    `,
    props:[
        'title',
        'total'
    ]
});