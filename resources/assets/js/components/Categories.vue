<template>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true" v-if="parent == 'designers'">
        <li class="uk-active">
          <a :href="'/shop/'+parent+'/all'">All</a>
        </li>
        <li :class="{'uk-parent':true, 'uk-parent uk-open': slug != 'all'}">
            <a href="#">{{ parent.toUpperCase() }}</a>
            <ul class="uk-nav-sub ">
                <li v-for="category in categories" :class="{'uk-text-bold': slug == category.slug}">
                  <a :href="'/shop/'+parent+'/'+ category.slug ">{{ category.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true" v-else>
        <li class="uk-active">
          <a :href="'/shop/'+parent+'/all'">All</a>
        </li>
        <li :class="{'uk-parent':true, 'uk-parent uk-open': category_slug == category.name.toLowerCase() }" v-for="category in categories">
            <a href="#">{{ category.name.toUpperCase() }}</a>
            <ul class="uk-nav-sub">
                <li v-for="cat in category.child" :class="{'uk-text-bold': slug == cat.slug}">
                  <a :href="'/shop/'+parent+'/'+ category.name.toLowerCase() +'/'+ cat.slug ">{{ cat.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['api', 'parent', 'category_slug', 'slug'],
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
