<template>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true" v-if="parent == 'designers'">
        <li class="uk-active">
          <a :href="'/shop/'+parent+'/all'">All</a>
        </li>
        <li class="uk-parent">
            <a href="#">{{ parent.toUpperCase() }}</a>
            <ul class="uk-nav-sub">
                <li v-for="category in categories">
                  <a :href="'/shop/'+parent+'/'+ category.slug ">{{ category.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true" v-else>
        <li class="uk-active">
          <a :href="'/shop/'+parent+'/all'">All</a>
        </li>
        <li class="uk-parent" v-for="category in categories">
            <a href="#">{{ category.name.toUpperCase() }}</a>
            <ul class="uk-nav-sub">
                <li v-for="cat in category.child">
                  <a :href="'/shop/'+parent+'/'+ category.name.toLowerCase() +'/'+ cat.slug ">{{ cat.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['api', 'parent'],
        created() {
            var self = this;
            var api = this.api;
            self.parent = this.parent;
            $.get(api, function(categories) {
              if (typeof categories.data !== 'undefined') {
                self.categories = categories.data;
              }
            });
        },

        data() {
            return {
                categories: {}
            }
        }
    }
</script>
