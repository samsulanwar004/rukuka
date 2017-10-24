import Vue from 'vue';
import VueResource from 'vue-resource-2';
import VeeValidate from 'vee-validate';

import UserPanel from './components/UserPanel.vue';
import Navigation from './components/Navigation.vue';

import Popular from './components/Popular.vue';
import Related from './components/Related.vue';
import Categories from './components/Categories.vue';

import Subcriber from './components/Subcriber.vue';

Vue.config.devtools = true
Vue.config.debug = true
Vue.config.silent = true

Vue.use(VueResource);
Vue.use(VeeValidate);

Vue.component('user-panel', UserPanel);
Vue.component('navigation', Navigation);

new Vue({
    el: '#vue-menu'
});

Vue.component('popular', Popular);
Vue.component('related', Related);
Vue.component('categories', Categories);

new Vue({
    el: '#vue-content'
});

Vue.component('subcriber', Subcriber);

new Vue({
    el: '#vue-footer'
});