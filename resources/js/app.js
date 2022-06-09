import { createApp } from 'vue';

require('./bootstrap');

let app = createApp({});

app.component('widgeteer', require('./components/Widgeteer.vue').default);

app.mount('#app');
