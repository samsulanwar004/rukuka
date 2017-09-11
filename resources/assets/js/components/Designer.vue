<script>
    export default {
        created() {
            var self = this;
            $.get("/api/v1/menu/designers", function(designers) {
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
    <div>
      <ul class="uk-nav uk-navbar-dropdown-nav">
        <li class="uk-parent" v-for="designer in designers">
            <a :href="'/shop/designers/'+ designer.slug ">{{ designer.name }}</a>
        </li>
      </ul>
    </div>
</template>
