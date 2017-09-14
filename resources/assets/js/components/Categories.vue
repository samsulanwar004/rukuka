<script>
    export default {
        props: ['api', 'parent'],
        created() {
            var self = this;
            var api = this.api;
            self.parent = this.parent;
            $.get(api, function(categories) {
              if (typeof categories.data !== 'undefined') {
                if (typeof categories.data.accessories !== 'undefined') {
                  self.accessories = categories.data.accessories;
                }

                if (typeof categories.data.clothing !== 'undefined') {
                  self.clothings = categories.data.clothing;
                }

                if (typeof categories.data.shoes !== 'undefined') {
                  self.shoes = categories.data.shoes;
                }
              } 
            });
        },

        data() {
            return {
                accessories: {},
                clothings: {},
                shoes: {},
                parent: {}
            }
        }
    }
</script>

<template>   
<ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
    <li class="uk-active">
      <a :href="'/shop/'+parent+'/all'">All</a>
    </li>
    <li class="uk-parent">
        <a href="#">ACCESSORIES</a>
        <ul class="uk-nav-sub">
            <li v-for="accessoris in accessories">
              <a :href="'/shop/'+parent+'/'+ accessoris.slug ">{{ accessoris.name }}</a>
            </li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">CLOTHING</a>
        <ul class="uk-nav-sub">
            <li v-for="clothing in clothings">
              <a :href="'/shop/'+parent+'/'+ clothing.slug ">{{ clothing.name }}</a>
            </li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">SHOES</a>
        <ul class="uk-nav-sub">
            <li v-for="shoe in shoes">
              <a :href="'/shop/'+parent+'/'+ shoe.slug ">{{ shoe.name }}</a>
            </li>
        </ul>
    </li>
</ul>
</template>
