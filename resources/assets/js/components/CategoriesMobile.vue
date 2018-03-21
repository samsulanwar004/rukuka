<template>
    <div v-if="parent == 'designers'">
        <ul class="uk-accordion">
            <li>
                <h5 class="uk-link-reset uk-text-uppercase">
                    <a :href="'/shop?menu=designers&category=all'">
                       <span :class="{'text-underline': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </h5>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li :class="{'uk-open': categorySlug != 'all'}">
                <h5 href="#" class="uk-accordion-title">{{ parent.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li v-for="category in categories">
                            <a :href="'/shop?menu='+parent+'&category='+ category.slug ">
                                <span :class="{'text-underline': slug == category.slug}">
                                    {{ category.name }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div v-else-if="parent == 'home'">
        <ul class="uk-accordion">
            <li>
                <h5 class="uk-link-reset uk-text-uppercase">
                    <a v-if="sales" :href="'/shop?menu='+parent+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+'&parent=all'">
                        <span :class="{'text-underline': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </h5>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: false" >
            <li v-for="category in categories" v-if="category.name.toLowerCase() == 'homeware'" :class="{'uk-open': categorySlug == category.name.toLowerCase()}">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li>
                            <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'text-underline': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                            </a>
                        </li>
                        <li v-for="cat in category.child" >
                            <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
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

    <div v-else>
        <ul class="uk-accordion">
            <li>
                <h5 class="uk-link-reset uk-text-uppercase">
                    <a v-if="sales" :href="'/shop?menu='+parent+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+'&parent=all'">
                        <span :class="{'text-underline': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </h5>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: false" >
            <li v-for="category in categories" v-if="category.name.toLowerCase() != 'homeware'" :class="{'uk-open': categorySlug == category.name.toLowerCase()}">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li>
                            <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'text-underline': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                            </a>
                        </li>
                        <li v-for="cat in category.child" v-if="cat.menu == parent || cat.menu == null">
                            <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
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
        props: ['parent', 'category_slug', 'slug', 'sale','locale'],
        created() {
            var self = this;
            self.parent = this.parent;

            Event.listen('categories', function (response) {
                self.categories = response;
            });
        },


        data() {
            return {
                categories: {},
                categorySlug: this.category_slug,
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
