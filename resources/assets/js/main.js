import Vue from 'vue';
import VueResource from 'vue-resource-2';

import Men from './components/Men.vue';
import Women from './components/Women.vue';
import Kid from './components/Kid.vue';
import Designer from './components/Designer.vue';
import Popular from './components/Popular.vue';
import Related from './components/Related.vue';

Vue.config.devtools = true
Vue.config.debug = true
Vue.config.silent = true

Vue.use(VueResource);

Vue.component('men', Men);
Vue.component('women', Women);
Vue.component('kid', Kid);
Vue.component('designer', Designer);

new Vue({
    el: '#menu'
});

Vue.component('popular', Popular);
Vue.component('related', Related);

new Vue({
    el: '#content'
});