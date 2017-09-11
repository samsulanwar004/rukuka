import Vue from 'vue';
import VueResource from 'vue-resource-2';

import Men from './components/Men.vue';
import Women from './components/Women.vue';
import Kid from './components/Kid.vue';
import Designer from './components/Designer.vue';
import Popular from './components/Popular.vue';

Vue.use(VueResource);

Vue.component('men', Men);
Vue.component('women', Women);
Vue.component('kid', Kid);
Vue.component('designer', Designer);
Vue.component('popular', Popular);

new Vue({
    el: '#menu'
});

Vue.component('popular', Popular);

new Vue({
    el: '#content'
});