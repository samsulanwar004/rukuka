<template>
    <div>
        <ul class="uk-accordion">
            <li>
                <span class="uk-link-reset">
                    <a v-if="sales" :href="'/shop?menu='+parent+designerSlug+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+designerSlug+'&parent=all'">
                        <span :class="{'uk-text-bold': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </span>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open" v-for="category in categories">
                <span href="#" class="uk-accordion-title">{{ category.name }}</span>
                <div class="uk-accordion-content">
                <ul class="uk-nav uk-filter-nav">
                    <li>
                        <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'uk-text-bold': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                        </a>
                    </li>
                    <li v-for="cat in category.child" v-if="cat.menu == parent || cat.menu == null">
                      <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
                          <span :class="{'uk-text-bold': slug == cat.slug}">
                              {{ cat.name }}
                          </span>
                      </a>
                    </li>
                </ul>
                </div>
            </li>
        </ul>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        props: ['api', 'parent', 'category_slug', 'slug', 'sale','locale', 'designer_slug'],
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
            axios.get(api)
            .then(function (response) {

                if (typeof response.data.data !== 'undefined') {
                    self.categories = response.data.data.sort(sort_by('slug', false, function(result){
                        return result;
                    }));

                    Event.fire('categories', self.categories);
                  }
            })
            .catch(function (error) {
                console.log(error);
            });

            self.designerSlug = this.designer_slug ? '&designer='+this.designer_slug : '';
        },


        data() {
            return {
                categories: {},
                categorySlug: this.category_slug,
                trans: JSON.parse(this.locale,true),
                designerSlug: {}
            }
        },

        computed: {
            sales: function () {
                return this.sale != 'sale' ? '' : '/'+this.sale;
            }
        }

    }
</script>
