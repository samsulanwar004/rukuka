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
            <li v-for="category in categories" :class="{'' : true, 'uk-open' : categoryFilter.includes(category.name)}">
                <span href="#" :class="{'uk-accordion-title' : true, 'cat-disabled' : !categoryFilter.includes(category.name)}">{{ category.name }}</span>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                    <li v-if="categoryFilter.includes(category.name)">
                        <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'uk-text-bold': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all+' '+category.name }}
                            </span>
                        </a>
                    </li>
                    <li v-else>
                        <span class="cat-disabled">
                            {{ trans.all }}
                        </span>
                    </li>
                    <div>
                        <li v-for="cat in category.child" v-if="cat.menu == parent || cat.menu == null">
                            <div v-if="categoryArr.includes(cat.name)">
                                <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
                                  <span :class="{'uk-text-bold': slug == cat.slug}">
                                      {{ cat.name }}
                                  </span>
                                </a>
                            </div>
                            <div v-else>
                                <span class="cat-disabled">
                                    {{ cat.name }}
                                </span>
                            </div>
                        </li>
                    </div>

                </ul>
                </div>
            </li>
        </ul>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        props: ['api', 'parent', 'category_slug', 'slug', 'sale','locale', 'designer_slug','category_array'],
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
                designerSlug: {},
                categoryArr: JSON.parse(this.category_array,true),
            }
        },

        computed: {
            sales: function () {
                return this.sale != 'sale' ? '' : '/'+this.sale;
            },
            categoryFilter: function () {
                var catArr = this.categoryArr;
                var parent = [];

                if(catArr){
                    $.each(this.categories, function( index, parentArr ) {
                        var child = [];

                        $.each(parentArr.child, function( index, value ) {
                            if(catArr.indexOf(value.name) != -1 ){
                                child.push(value.name);
                            }
                        });

                        if (child.length){
                            parent.push(parentArr.name);
                        }

                    });
                }else{

                    $.each(this.categories, function( index, parentArr ) {
                        parent.push(parentArr.name);
                    });
                }


                return parent;


            }
        }

    }
</script>
