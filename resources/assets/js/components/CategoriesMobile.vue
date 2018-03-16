<template>
    <div v-if="parent == 'designers'">
        <ul class="uk-accordion">
            <li>
                <h5 class="uk-link-reset uk-text-uppercase">
                    <a :href="'/shop?menu=designers&category=all'">
                        {{ trans.all }}
                    </a>
                </h5>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li >
                <h5 href="#" class="uk-accordion-title">{{ parent.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li v-for="category in categories" :class="{'uk-text-bold': slug == category.slug}">
                            <a :href="'/shop?menu'+parent+'&category='+ category.slug ">{{ category.name }}</a>
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
                    <a :href="'/shop?menu='+parent+'&parent=all'">
                        {{ trans.all }}
                    </a>
                </h5>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li v-for="category in categories">
                <h5 href="#" class="uk-accordion-title">{{ category.name.toUpperCase() }}</h5>
                <div class="uk-accordion-content">
                <ul class="uk-nav uk-filter-nav">
                    <li v-for="cat in category.child" :class="{'uk-text-bold': slug == cat.slug}">
                      <a :href="'/shop?menu='+parent+'&parent'+ category.name.toLowerCase() +'&category='+ cat.slug + sales">{{ cat.name }}</a>
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
