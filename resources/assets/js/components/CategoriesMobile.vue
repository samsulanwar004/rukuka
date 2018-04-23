<template>

    <div>
        <ul class="uk-accordion">
            <li>
                <h5 class="uk-link-reset uk-text-uppercase">
                    <a v-if="sales" :href="'/shop?menu='+parent+designerSlug+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+designerSlug+'&parent=all'">
                        <span :class="{'text-underline': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </h5>
            </li>
        </ul>
        <div v-if="designerSlug">
            <ul class="uk-accordion" uk-accordion="multiple: false" >
            <li v-for="category in categories" :class="{'uk-open': categorySlug == category.name.toLowerCase()}" v-if="categoryFilter.includes(category.name)">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
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
                        <span class="uk-text-muted uk-disabled">
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
                                <span class="uk-text-muted uk-disabled">
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
        <div v-else>
            <ul class="uk-accordion" uk-accordion="multiple: true" >
                <li v-for="category in categories" class="uk-open" v-if="category.name.toLowerCase() == category_slug ">
                    <span href="#" class="uk-accordion-title">{{ category.name }}</span>
                    <div class="uk-accordion-content">
                        <ul class="uk-nav uk-filter-nav">
                            <li v-if="categoryFilter && categoryFilter.includes(category.name)">
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
                                    <div v-if="categoryFilter && categoryArr.includes(cat.name)">
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
    </div>

</template>

<script>
    export default {
        props: ['parent', 'category_slug', 'slug', 'sale','locale','designer_slug','category_array'],
        created() {
            var self = this;
            self.parent = this.parent;

            Event.listen('categories', function (response) {
                self.categories = response;
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
