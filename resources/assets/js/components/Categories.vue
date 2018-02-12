<template>
    <div v-if="parent == 'designers'">
        <ul class="uk-accordion">
            <li class="uk-open">
                <h4 :href="'/shop/'+parent+'/all'">{{ trans.all }}</h4>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open">
                <h5 href="#" class="uk-accordion-title">{{ parent.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-footer-nav">
                        <li v-for="category in categories" :class="{'uk-text-bold': slug == category.slug}">
                            <a :href="'/shop/'+parent+'/'+ category.slug ">{{ category.name }}</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div v-else>
        <ul class="uk-accordion">
            <li>
                <h4 class="uk-link-reset uk-text-uppercase">
                    <a :href="'/shop/'+parent+'/all'">
                        {{ trans.all }}
                    </a>
                </h4>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open" v-for="category in categories">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                <ul class="uk-nav uk-footer-nav">
                    <li v-for="cat in category.child" :class="{'uk-text-bold': slug == cat.slug}">
                      <a :href="'/shop/'+parent+'/'+ category.name.toLowerCase() +'/'+ cat.slug + sales">{{ cat.name }}</a>
                    </li>
                </ul>
                </div>
            </li>
        </ul>
    </div>

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
                self.categories = categories.data.sort(sort_by('id', false, function(result){
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
