import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import 'vuetify/styles' // Global CSS has to be imported
import { createApp } from "vue";
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/lib/components'
import * as directives from 'vuetify/lib/directives'

//oruga
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/oruga-next/dist/oruga.css';
import '@oruga-ui/oruga-next/dist/oruga-full.css';

//material design
import '@mdi/font/css/materialdesignicons.min.css'

import axios from 'axios';

import App from "./App.vue";
import router from './router';

const app = createApp(App).use(Oruga).use(router);

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        themes: {
            light: {
                colors: {

                },
                dark: false,
                variables: {},
            },
        },
    },
});

app.use(vuetify)
app.component('Datepicker', Datepicker);

app.config.globalProperties.$axios = axios;
window.axios = axios;

app.mount("#app")