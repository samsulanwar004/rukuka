<script>
    export default {
        props: ['api'],
        created() {
            var self = this;
            var api = this.api;
            $.get(api, function(kids) {
                if (typeof kids.data !== 'undefined') {
                    self.clothings = kids.data.clothing;
                } 
              });
        },

        data() {
            return {
                clothings: {}
            }
        }
    }
</script>

<template>
    
    <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
      <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
          <div>
            <ul class="uk-nav uk-navbar-dropdown-nav">
              <li class="uk-active">Clothing</li>
              <li class="uk-parent" v-for="clothing in clothings">
                <a :href="'/shop/kids/'+ clothing.slug ">{{ clothing.name }}</a>
              </li>
            </ul>
          </div>
          <div>
              <ul class="uk-nav uk-navbar-dropdown-nav">
                  <li class="uk-active"><a href="#">Active</a></li>
                  <li class="uk-parent"><a href="#">Parent</a></li>
                  <li class="uk-nav-header">Header</li>
                  <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                  <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
              </ul>
          </div>
          <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
      </div>
  </div>
</template>
