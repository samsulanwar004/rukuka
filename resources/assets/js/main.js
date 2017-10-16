import Vue from 'vue';
import VueResource from 'vue-resource-2';

import UserPanel from './components/UserPanel.vue';
import Navigation from './components/Navigation.vue';
import Popular from './components/Popular.vue';
import Related from './components/Related.vue';
import Categories from './components/Categories.vue';

Vue.config.devtools = true
Vue.config.debug = true
Vue.config.silent = true

Vue.use(VueResource);

Vue.component('user-panel', UserPanel);
Vue.component('navigation', Navigation);

new Vue({
    el: '#menu'
});

Vue.component('popular', Popular);
Vue.component('related', Related);
Vue.component('categories', Categories);

new Vue({
    el: '#content'
});