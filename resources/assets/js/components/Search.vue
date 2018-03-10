<template>
    <div>
        <ul class="uk-accordion">
            <li>
                <h5 :class="{'uk-text-bold': category == ''}" >
                    <a :href="'/search?keyword='+keyword" class="uk-link-reset uk-text-uppercase">
                        {{ trans.all }}({{womenCounts+menCounts+kidCounts}})
                    </a>
                </h5>
            </li>
            <li v-if="womenCounts">
                <h5 :class="{'uk-text-bold': category == 'womens'}" >
                    <a :href="'/search?keyword='+keyword+'&category=womens'" class="uk-link-reset uk-text-uppercase">
                        {{ trans.women_nav }} ({{womenCounts}})
                    </a>
                </h5>
            </li>
            <li v-if="menCounts">
                <h5 :class="{'uk-text-bold': category == 'mens'}" >
                    <a :href="'/search?keyword='+keyword+'&category=mens'" class="uk-link-reset uk-text-uppercase">
                        {{ trans.men_nav }} ({{menCounts}})
                    </a>
                </h5>
            </li>
            <li v-if="homeCounts">
                <h5 :class="{'uk-text-bold': category == 'home'}" >
                    <a :href="'/search?keyword='+keyword+'&category=home'" class="uk-link-reset uk-text-uppercase">
                        {{ trans.home_nav }} ({{homeCounts}})
                    </a>
                </h5>
            </li>
        </ul>

        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li v-if="category == 'womens'" class="uk-open">
                <hr class="uk-margin-small-top">
                <h5 href="#" class="uk-accordion-title uk-text-uppercase">{{ trans.category }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav" v-for="cloth in womenCloths">
                        <li v-for="cat in cloth.child" :class="{'uk-text-bold': subcategory == cat.slug}">
                            <a v-for="productCat in productsCategory" :href="'/search?keyword='+keyword+'&category=womens&subcategory='+ cat.slug" v-if="productCat.product_categories_id == cat.id" >{{ cat.name }}</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li v-if="category == 'mens'" class="uk-open">
                <hr class="uk-margin-small-top">
                <h5 href="#" class="uk-accordion-title uk-text-uppercase">{{ trans.category }}</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav" v-for="cloth in menCloths">
                        <li v-for="cat in cloth.child" :class="{'uk-text-bold': subcategory == cat.slug}">
                            <a v-for="productCat in productsCategory" :href="'/search?keyword='+keyword+'&category=mens&subcategory='+ cat.slug" v-if="productCat.product_categories_id == cat.id" >{{ cat.name }}</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li>
                <hr class="uk-margin-small-top">
                <h5 href="#" class="uk-accordion-title uk-text-uppercase">{{ trans.designers_nav }} ({{designers.length}})</h5>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li class="uk-parent" v-for="design in designers">
                            <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
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
        props: ['api','keyword','category','subcategory','productcategory','locale'],
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

            axios.get(api)
            .then(function (navigations) {
                if (typeof navigations.data.data !== 'undefined') {

                    Event.fire('api-search', navigations.data.data);

                    if (typeof navigations.data.data.mens !== 'undefined') {
                        self.menCounts = navigations.data.data.mens;
                    }

                    if (typeof navigations.data.data.womens !== 'undefined') {
                        self.womenCounts = navigations.data.data.womens;
                    }

                    if (typeof navigations.data.data.home !== 'undefined') {
                        self.homeCounts = navigations.data.data.home;
                    }

                    if (typeof navigations.data.data.kids !== 'undefined') {
                        self.kidCounts = navigations.data.data.kids;
                    }

                    if (typeof navigations.data.data.designers !== 'undefined') {
                        self.designers = navigations.data.data.designers.sort(sort_by('created_at', true, function(result){
                            return result;
                        }));
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
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
                homeCounts: {},
                kidCounts: {},
                designers: {},
                productsCategory: {},
                category: {},
                subcategory: {},
                trans: JSON.parse(this.locale,true),
            }
        }
    }
</script>
