<script>
    export default {
        created() {
            var self = this;
            $.get("/api/v1/menu/womens", function(womens) {
                if (womens.status == 'Ok') {
                  self.womens = womens.data;
                }                  
              });
        },

        data() {
            return {
                womens: {}
            }
        }
    }
</script>

<template>
    <div>
      <ul class="uk-nav uk-navbar-dropdown-nav">
        <li class="uk-active">Clothing</li>
        <li class="uk-parent" v-for="women in womens">
          <a :href="'/shop/womens/'+ women.slug ">{{ women.name }}</a>
        </li>
      </ul>
    </div>
</template>
