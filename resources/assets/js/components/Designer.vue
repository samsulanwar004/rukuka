<script>
    export default {
        created() {
            var self = this;
            $.get("/api/v1/menu/designers/all", function(designers) {
                if (designers.status == 'Ok') {
                  self.designers = designers.data;
                }
              });
        },

        data() {
            return {
                designers: {}
            }
        }
    }
</script>

<template>
    
    <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
      <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
          <div>
              <ul class="uk-nav uk-navbar-dropdown-nav">
                <li class="uk-parent" v-for="designer in designers">
                    <a :href="'/shop/designers/'+ designer.slug ">{{ designer.name }}</a>
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
