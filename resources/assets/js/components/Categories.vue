<template>
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true" v-if="parent == 'designers'">
        <li class="uk-active">
          <a :href="'/shop/'+parent+'/all'">ALL</a>
        </li>
        <li :class="{'uk-parent':true, 'uk-parent uk-open uk-active': slug != 'all'}">
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
          <a :href="'/shop/'+parent+'/all'">ALL</a>
        </li>
        <li :class="{'uk-parent':true, 'uk-parent uk-open uk-active': category_slug == category.name.toLowerCase() }" v-for="category in categories">
            <a href="#">{{ category.name.toUpperCase() }}</a>
            <ul class="uk-nav-sub">
                <li v-for="cat in category.child" :class="{'uk-text-bold': slug == cat.slug}">
                  <a :href="'/shop/'+parent+'/'+ category.name.toLowerCase() +'/'+ cat.slug + sales">{{ cat.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
    
</template>

<script>
    export default {
        props: ['api', 'parent', 'category_slug', 'slug', 'sale','locale'],
        created() {
            var self = this;
            var api = this.api;
            var sort_by = function(field, reverse, primer){

                var key = primer ?
                    function(x) {return primer(x[field])} :
                    function(x) {return x[field]};

                reverse = !reverse ? 1 : -1;

                return function (a, b) {
                    return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                }
            };
            self.parent = this.parent;
            $.get(api, function(categories) {
              if (typeof categories.data !== 'undefined') {
                self.categories = categories.data.sort(sort_by('name', false, function(result){
                    return result;
                }));
              }
            });
        },


        data() {
            return {
                categories: {},
                trans: JSON.parse(this.locale,true)
            }
        },

        computed: {
            sales: function () {
                return this.sale != 'sale' ? '' : '/'+this.sale;
            }
        }


    }
</script>
