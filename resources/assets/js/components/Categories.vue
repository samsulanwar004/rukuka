<template>
    <div v-if="parent == 'designers'">
      <!-- <div class="uk-grid-small uk-width-1-1 uk-child-width-1-2" uk-grid>
        <div class="uk-text-center">
          <label>
          <input type="radio" class="uk-radio" name="gender" v-on:click="pickGender('mens')" :checked="gender == 'mens'">
          <img src="https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/uploads/1/2018-02/black.png" alt="" width="28" class="uk-border-circle uk-box-shadow-small">
          </label>
           <h6 class="uk-margin-remove-top uk-text-uppercase"> {{ trans.men }}</h6>
        </div>
        <div class="uk-text-center">
          <label>
          <input type="radio" class="uk-radio" name="gender" v-on:click="pickGender('womens')" :checked="gender == 'womens'">
          <img src="https://s3-ap-southeast-1.amazonaws.com/rukuka-assets/uploads/1/2018-02/black.png" alt="" width="28" class="uk-border-circle uk-box-shadow-small">
          </label>
          <h6 class="uk-margin-remove-top uk-text-uppercase">{{ trans.women }}</h6>
        </div>
      </div> -->
        <ul class="uk-accordion">
            <li>
                <span class="uk-link-reset">
                    <a :href="'/shop?menu=designers&category=all'">
                        <span :class="{'uk-text-bold': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </span>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open">
                <span href="#" class="uk-accordion-title">{{ parent }}</span>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-filter-nav">
                        <li v-for="category in categories">
                            <a :href="'/shop?menu='+parent+'&category='+ category.slug ">
                                <span :class="{'uk-text-bold': slug == category.slug}">
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
                <span class="uk-link-reset">
                    <a v-if="sales" :href="'/shop?menu='+parent+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+'&parent=all'">
                        <span :class="{'uk-text-bold': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </span>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open" v-for="category in categories" v-if="category.name.toLowerCase() == 'homeware'">
                <span href="#" class="uk-accordion-title">{{ category.name }}</span>
                <div class="uk-accordion-content">
                <ul class="uk-nav uk-filter-nav">
                    <li>
                        <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'uk-text-bold': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                        </a>
                    </li>
                    <li v-for="cat in category.child" >
                      <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
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

    <div v-else>
        <ul class="uk-accordion">
            <li>
                <span class="uk-link-reset">
                    <a v-if="sales" :href="'/shop?menu='+parent+'&parent=sale'">
                        {{ trans.all }}
                    </a>
                    <a v-else :href="'/shop?menu='+parent+'&parent=all'">
                        <span :class="{'uk-text-bold': categorySlug == 'all'}">
                            {{ trans.all }}
                        </span>
                    </a>
                </span>
            </li>
        </ul>
        <ul class="uk-accordion" uk-accordion="multiple: true" >
            <li class="uk-open" v-for="category in categories" v-if="category.name.toLowerCase() != 'homeware'">
                <span href="#" class="uk-accordion-title">{{ category.name }}</span>
                <div class="uk-accordion-content">
                <ul class="uk-nav uk-filter-nav">
                    <li>
                        <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category=all'">
                            <span :class="{'uk-text-bold': categorySlug == category.name.toLowerCase() && slug == 'all'}">
                                 {{ trans.all }}
                            </span>
                        </a>
                    </li>
                    <li v-for="cat in category.child" v-if="cat.menu == parent || cat.menu == null">
                      <a :href="'/shop?menu='+parent+'&parent='+ category.name.toLowerCase() +'&category='+ cat.slug + sales">
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
        props: ['api', 'parent', 'category_slug', 'slug', 'sale','locale', 'action_link', 'gender'],
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
        },

        methods: {
            pickGender: function (gender) {
                var search = function searchStringInArray (str, strArray) {
                    for (var j=0; j<strArray.length; j++) {
                        if (strArray[j].match(str)) return j;
                    }
                    return -1;
                }
                var myarr = this.action_link.split("&");
                var position = search('gender',myarr);
                if(position == -1) {
                    window.location.href = this.action_link+'&gender='+gender;
                } else {
                    delete myarr[position];
                    window.location.href = myarr.join('&')+'&gender='+gender;
                }
            }
        }


    }
</script>
