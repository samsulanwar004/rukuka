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
        <ul class="uk-accordion" uk-accordion="multiple: false" >
            <li v-for="category in categories" :class="{'uk-open': categorySlug == category.name.toLowerCase()}">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li>
                            <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'text-underline': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                            </a>
                        </li>
                        <li v-for="cat in category.child" v-if="cat.menu == parent || cat.menu == null">
                            <a :href="'/shop?menu='+parent+designerSlug+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
                          <span :class="{'text-underline': slug == cat.slug}">
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
    export default {
        props: ['parent', 'category_slug', 'slug', 'sale','locale','designer_slug'],
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
