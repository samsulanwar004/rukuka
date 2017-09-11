<script>
    export default {
        created() {
            var self = this;
            $.get('/menu/men', function(mens) {
                  self.mens = mens
              });
        },

        data() {
            return {
                mens: {}
            }
        }
    }
</script>

<template>
    <div>
      <ul class="uk-nav uk-navbar-dropdown-nav">
          <li class="uk-active">Clothing</li>
            <li class="uk-parent" v-for="men in mens">
              <a :href="'/shop/men/'+ men.slug ">{{ men.name }}</a>
          </li>
      </ul>
    </div>
</template>
