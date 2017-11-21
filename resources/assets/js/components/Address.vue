<template>
    <div class="uk-grid" uk-grid>
       <div class="uk-width-1-3" v-for="add in data">
          <div :class="{'uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large': true, 'uk-background-muted': add.is_default }">            
             <div class="uk-card-body">
                <table>
                   <tr>
                      <td>
                         <input class="uk-radio" type="radio" name="default" :checked="add.is_default ? true : false" v-on:click="changeDefault(add.id)">
                      </td>
                      <td>
                         {{ add.first_name }} {{ add.last_name }}
                      </td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>{{ add.address_line }}</td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>
                         {{ add.city }}, {{ add.province }} {{ add.postal }}
                      </td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>
                         {{ add.country }}
                      </td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>
                         {{ add.phone_number }}
                      </td>
                   </tr>
                   <tr>
                      <td>

                      </td>
                      <td>
                        <a href="#" class="uk-icon-link" uk-icon="icon: file-edit"></a>
                        <a href="#" v-on:click.prevent="removeAddress(add.id)" class="uk-icon-link" uk-icon="icon: trash"></a>
                      </td>
                   </tr>
                </table>
             </div>
          </div>
       </div>
       <div class="uk-width-1-3">
          <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
             <div class="uk-card-body">
                <a href="#modal-sections" class="uk-text-meta" uk-toggle> <span class="uk-icon" uk-icon="icon: plus"></span> ADD NEW SHIPPING ADDRESS </a>
             </div>
          </div>
       </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['address', 'address_default', 'address_destroy'],

        data () {
            return {
                data: {}
            }
        },

        created () {
            var self = this;
            self.data = this.address ? JSON.parse(this.address) : {};
        },

        methods: {
            changeDefault: function (id) {
                var self = this;
                axios.post(this.address_default, {
                    default: id
                })
                .then(function (response) {
                    if (typeof response.data.message !== 'undefined') {
                        if (response.data.status.toLowerCase() == 'ok') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Change default address successfully", {
                                status:'success'
                            });

                            self.data = response.data.address;
                        }
                    }
                })
                .catch(function (error) {
                    var error = JSON.parse(JSON.stringify(error));
                    if (typeof error.response.data.message !== 'undefined') {
                        UIkit.notification(error.response.data.message, {
                            status:'danger'
                        });
                    }
                });
            },

            removeAddress: function (id) {
                var self = this;
                axios.post(this.address_destroy, {
                    id: id,
                    _method: 'DELETE'
                })
                .then(function (response) {
                    if (typeof response.data.message !== 'undefined') {
                        if (response.data.status.toLowerCase() == 'ok') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Delete address successfully", {
                                status:'success'
                            });

                            self.data = response.data.address;
                        }
                    }
                })
                .catch(function (error) {
                    var error = JSON.parse(JSON.stringify(error));
                    if (typeof error.response.data.message !== 'undefined') {
                        UIkit.notification(error.response.data.message, {
                            status:'danger'
                        });
                    }
                });              
            }
        }
    }
</script>
