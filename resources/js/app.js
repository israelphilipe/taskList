import Vue from 'vue';
import router from './router';
import App from './components/App'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrashAlt, faCheckCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTrashAlt)
library.add(faCheckCircle)

Vue.component('font-awesome-icon', FontAwesomeIcon)

require('./bootstrap');


const app = new Vue({
    el: '#app',
    components:{
        App
    },
    router
});


