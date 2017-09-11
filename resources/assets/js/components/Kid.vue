<script>
    export default {
        created() {
            var self = this;
            $.get("/api/v1/menu/kids", function(kids) {
                if (kids.status == 'Ok') {
                  self.kids = kids.data;
                }
              });
        },

        data() {
            return {
                kids: {}
            }
        }
    }
</script>

<template>
    <div>
      <ul class="uk-nav uk-navbar-dropdown-nav">
        <li class="uk-active">Clothing</li>
        <li class="uk-parent" v-for="kid in kids">
          <a :href="'/shop/kids/'+ kid.slug ">{{ kid.name }}</a>
        </li>
      </ul>
    </div>
</template>
