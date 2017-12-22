<script>
    export default {
        props: ['api','keyword','category','subcategory','productcategory'],
        created() {
            var self = this;
            var api = this.api;
            self.productsCategory = this.productcategory ? JSON.parse(this.productcategory) : {};
            var sort_by = function(field, reverse, primer){

                var key = primer ?
                    function(x) {return primer(x[field])} :
                    function(x) {return x[field]};

                reverse = !reverse ? 1 : -1;

                return function (a, b) {
                    return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                }
            }

            $.get(api, function(navigations) {
                if (typeof navigations.data !== 'undefined') {
                    if (typeof navigations.data.mens !== 'undefined') {
                        self.menCounts = navigations.data.mens;
                    }

                    if (typeof navigations.data.womens !== 'undefined') {
                        self.womenCounts = navigations.data.womens;
                    }

                    if (typeof navigations.data.kids !== 'undefined') {
                        self.kidCounts = navigations.data.kids;
                    }

                    if (typeof navigations.data.designers !== 'undefined') {
                        self.designers = navigations.data.designers.sort(sort_by('created_at', true, function(result){
                            return result;
                        }));
                    }
                }
            });

            Event.listen('navigation', function (response) {

                if (typeof response.mens !== 'undefined') {
                    self.menCloths = response.mens;
                }
                if (typeof response.womens !== 'undefined') {
                    self.womenCloths = response.womens;
                }
                if (typeof response.kids !== 'undefined') {
                    self.kidCloths = response.kids;
                }

            });
        },
        data() {
            return {
                menCloths: {},
                womenCloths: {},
                kidCloths: {},
                menCounts: {},
                womenCounts: {},
                kidCounts: {},
                designers: {},
                productsCategory: {},
                category: {},
                subcategory: {},
            }
        }
    }
</script>

<template>
        <ul class="uk-nav uk-nav-small uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
            <li class="uk-parent">
                <a>DESIGNERS ({{designers.length}})</a>
                <ul class="uk-nav-sub">
                    <li class="uk-parent" v-for="design in designers">
                        <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                    </li>
                </ul>
            </li>
            <li v-if="womenCounts">
                <a :class="{'uk-text-bold': category == 'womens'}" :href="'/search?keyword='+keyword+'&category=womens'">WOMENS ({{womenCounts}})</a>
            </li>
            <li v-if="menCounts">
                <a :class="{'uk-text-bold': category == 'mens'}" :href="'/search?keyword='+keyword+'&category=mens'">MENS ({{menCounts}})</a>
            </li>
            <li v-if="kidCounts">
                <a :class="{'uk-text-bold': category == 'kids'}" :href="'/search?keyword='+keyword+'&category=kids'">KIDS ({{kidCounts}})</a>
            </li>
            <li v-if="category == 'womens'" :class="{'uk-parent':true, 'uk-parent uk-open': subcategory}">

                <hr class="uk-margin-small-top">
                <a>CATEGORY</a>
                <ul class="uk-nav-sub">
                <span v-for="cloth in womenCloths">
                    <li v-for="cat in cloth.child" :class="{'uk-text-bold': subcategory == cat.slug}">
                        <a v-for="productCat in productsCategory" :href="'/search?keyword='+keyword+'&category=womens&subcategory='+ cat.slug" v-if="productCat.product_categories_id == cat.id" >{{ cat.name }}</a>
                    </li>
                </span>
                </ul>
            </li>
            <li v-if="category == 'mens'" :class="{'uk-parent':true, 'uk-parent uk-open': subcategory}">
                <hr class="uk-margin-small-top">
                <a>CATEGORY</a>
                <ul class="uk-nav-sub">
                <span v-for="cloth in menCloths">
                    <li v-for="cat in cloth.child" :class="{'uk-text-bold': subcategory == cat.slug}">
                        <a v-for="productCat in productsCategory" :href="'/search?keyword='+keyword+'&category=mens&subcategory='+ cat.slug" v-if="productCat.product_categories_id == cat.id" >{{ cat.name }}</a>
                    </li>
                </span>
                </ul>
            </li>
            <li v-if="category == 'kids'" :class="{'uk-parent':true, 'uk-parent uk-open': subcategory}">
                <hr class="uk-margin-small-top">
                <a>CATEGORY</a>
                <ul class="uk-nav-sub">
                <span v-for="cloth in kidCloths">
                    <li v-for="cat in cloth.child" :class="{'uk-text-bold': subcategory == cat.slug}">
                        <a v-for="productCat in productsCategory" :href="'/search?keyword='+keyword+'&category=kids&subcategory='+ cat.slug" v-if="productCat.product_categories_id == cat.id" >{{ cat.name }}</a>
                    </li>
                </span>
                </ul>
            </li>
         </ul>
</template>
