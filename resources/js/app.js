require('./bootstrap');

window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('contact-form', require('./components/ContactForm.vue').default);
Vue.component('manage-view', require('./components/ManageView.vue').default);

const app = new Vue({
    el: '#app',
});
