<template>
    <div class="uk-grid" uk-grid>
       <div class="uk-width-1-3@m" v-for="add in data">
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
                        <a href="#modal-edit" class="uk-icon-link" uk-icon="icon: file-edit" uk-toggle v-on:click.prevent="editAddress(add.id)"></a>
                        <a href="#" v-on:click.prevent="removeAddress(add.id)" class="uk-icon-link" uk-icon="icon: trash"></a>
                      </td>
                   </tr>
                </table>
             </div>
          </div>
       </div>
       <div class="uk-width-1-3@m">
          <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
             <div class="uk-card-body">
                <a href="#modal-sections" class="uk-text-meta" uk-toggle> <span class="uk-icon" uk-icon="icon: plus"></span> ADD NEW SHIPPING ADDRESS </a>
             </div>
          </div>
       </div>
       <div id="modal-edit" uk-modal>
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
              <h4 class="uk-modal-title">EDIT ADDRESS</h4>
          </div>
          <div class="uk-modal-body">
            <form class="uk-form-stacked" v-on:submit.prevent="updateAddress">
              <input type="hidden" name="id" :value="add.id">
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  First name
                  <input class="uk-input uk-input-small" name="first_name" id="form-s-tel" type="text" :value="add.first_name" required="required">
                </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Last name
                  <input class="uk-input uk-input-small" name="last_name" id="form-s-tel" type="text" :value="add.last_name" required="required">
                </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
              <div>
                Company
                <input class="uk-input uk-input-small" name="company" id="form-s-tel" type="text" :value="add.company"></div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Address line
                  <input class="uk-input uk-input-small" name="address_line" id="form-s-tel" type="text" :value="add.address_line" required="required">
                </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Country
                  <!-- <input class="uk-input uk-input-small" name="country" id="form-s-tel" type="text" :value="add.country" required="required"> -->
                  <select class="uk-input uk-input-small" name="country" id="form-country-vue" type="text" required="required" @change="changeCountryAddress">
                  </select>
                </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Province
                  <input class="uk-input uk-input-small" name="province" id="form-province-vue" type="text" :value="add.province" required="required" @change="showVueListCities()">
                </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  City
                  <input class="uk-input uk-input-small" name="city" id="form-city-vue" type="text" :value="add.city" required="required">
                </div>
              </div>

              <!-- only indonesia's address-->
              <div id="div-sub-district-vue" class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Sub district
                  <input class="uk-input uk-input-small " name="sub_district" id="form-subdistrict-vue" type="text" value="" required>
                </div>
              </div>
              <div  id="div-village-vue" class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Village
                  <input class="uk-input uk-input-small " name="village" id="form-village-vue" type="text" value="" required>
                </div>
              </div>
              <!-- end only indonesia's address-->

              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Postal
                  <input class="uk-input uk-input-small" name="postal" id="form-postal-vue" type="text" :value="add.postal" required="required">
                </div>
              </div>

              <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Phone number
                  <input class="uk-input uk-input-small" name="phone_number" id="form-s-tel" type="text" :value="add.phone_number" required="required">
                </div>
              </div>
              <input type="submit" id="submit-edit" style="display: none">
              </form>
          </div>
          <div class="uk-modal-footer uk-text-right">
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <button class="uk-button uk-button-secondary" v-on:click="submitUpdate">Save</button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: [
          'address',
          'address_default',
          'address_destroy',
          'address_edit',
          'address_update'
        ],

        data () {
            return {
                data: {},
                add: {},
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

                            if (response.data.address.length <= 0) {
                              location.reload(true);
                            }
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

            editAddress: function (id) {
              var self = this;
              var responseEdit = axios.get(this.address_edit+'/'+id)
              .then(function (response) {
                if (typeof response.data.address !== 'undefined') {
                  self.add = response.data.address;
                  self.initHandleAddressing(self.add);
                  self.handleAddressing(self.add);
                }
              })
              .catch(function (error) {
                console.log(error);
              });


            },

            updateAddress: function (e) {
              var first_name = e.target.elements.first_name.value;
              var last_name = e.target.elements.last_name.value;
              var address_line = e.target.elements.address_line.value;
              var city = e.target.elements.city.value;
              var province = e.target.elements.province.value;
              var postal = e.target.elements.postal.value;
              var country = e.target.elements.country.value;
              var phone_number = e.target.elements.phone_number.value;
              var id = e.target.elements.id.value;

              var self = this;
              axios.post(this.address_update+'/'+id, {
                first_name : first_name,
                last_name : last_name,
                address_line : address_line,
                city : city,
                province : province,
                postal : postal,
                country : country,
                phone_number : phone_number
              })
              .then(function (response) {
                  if (typeof response.data.message !== 'undefined') {
                      if (response.data.status.toLowerCase() == 'ok') {
                          UIkit.notification("<span uk-icon='icon: check'></span> Update address successfully", {
                              status:'success'
                          });

                          self.data = response.data.address;

                          setTimeout(function () {
                            $('.uk-close').click();
                          }, 2000);
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

            submitUpdate: function () {
              $('#submit-edit').click();
            },

            initHandleAddressing: function(existAddress){

              if (existAddress.country == 'ID') {

                $('#form-province-vue').replaceWith('<select id="form-province-vue" onchange="showVueListCities()" name="province" class="uk-input uk-input-small " required><option>Select country first ya</option></select>');
                $('#form-city-vue').replaceWith('<select id="form-city-vue" onchange="showListSubDistricts()" name="city" class="uk-input uk-input-small " required><option>Select province first</option></select>');
                $('#form-subdistrict-vue').replaceWith('<select id="form-subdistrict-vue" onchange="showListVillages()" name="sub_district" class="uk-input uk-input-small " required><option>Select city first</option></select>');
                $('#form-village-vue').replaceWith('<select id="form-village-vue" onchange="setPostalCode()" name="village" class="uk-input uk-input-small " required><option>Select sub district first</option></select>');

                $('#div-sub-district-vue').show();
                $('#div-village-vue').show();

              }else{

                $('#form-province-vue').replaceWith('<input class="uk-input uk-input-small" name="province" id="form-province-vue" type="text" value="' + existAddress.province +'" required>');
                $('#form-city-vue').replaceWith('<input class="uk-input uk-input-small" name="city" id="form-city-vue" type="text" value="' + existAddress.city +'" required>');
                $('#form-subdistrict-vue').replaceWith('<span class="uk-input uk-input-small " name="sub_district" id="form-subdistrict-vue" type="text" value=""></span>');
                $('#form-village-vue').replaceWith('<span class="uk-input uk-input-small " name="village" id="form-village-vue" type="text" value=""></span>');

                $('#div-sub-district-vue').hide();
                $('#div-village-vue').hide();

              }
            },

            handleAddressing: function(existAddress){

              if (existAddress.country == 'ID') {

                this.showVueListCountries(existAddress);
                this.showVueListProvinces(existAddress);
                this.showVueListCities(existAddress);
                this.showVueListSubDistricts(existAddress);
                this.showVueListVillages(existAddress);

              }else{

                this.showVueListCountries(existAddress);

              }

            },

            showVueListCountries: function (existAddress) {

              var allOptions;

              axios.get('/api/v1/countries').then(function (response) {

                if (response.data.error == '000') {

                  $.each(response.data.data, function( index, value ) {

                    if (existAddress.country == value.countries_code) {

                      allOptions += '<option selected value="' + value.countries_code + '">'+ value.countries_name.toUpperCase() +'</option>'

                    }else{

                      allOptions += '<option value="' + value.countries_code + '">'+ value.countries_name.toUpperCase() +'</option>'

                    }

                  });

                  $('#form-country-vue').append(allOptions);

                }else{

                  console.log(response.data.message);
                  allOptions += '<option></option>';

                }

              })
              .catch(function (error) {

                console.log(error);
                allOptions += '<option></option>';

              });
            },

            showVueListProvinces: function(existAddress){

              var allOptions;

              axios.get('/api/v1/provinces').then(function (response) {

                if (response.data.error == '000') {

                  $.each(response.data.data, function( index, value ) {

                    if (existAddress.province == value.province) {

                      allOptions += '<option selected value="' + value.province + '">'+ value.province.toUpperCase() +'</option>'

                    }else{

                      allOptions += '<option value="' + value.province + '">'+ value.province.toUpperCase() +'</option>'

                    }

                  });

                }else{

                  console.log(response.data.message);
                  allOptions += '<option></option>';

                }

                $('#form-province-vue').empty();
                $('#form-province-vue').append('<option></option>' + allOptions);

              })
              .catch(function (error) {

                console.log(error);
                allOptions += '<option></option>';

              });

            },

            showVueListCities: function(existAddress){

              var allOptions;

              axios.get('/api/v1/cities/' + existAddress.province ).then(function (response) {

                if (response.data.error == '000') {

                  $.each(response.data.data, function( index, value ) {

                    if (existAddress.city == value.city) {

                      allOptions += '<option selected value="' + value.city + '">'+ value.city.toUpperCase() +'</option>'

                    }else{

                      allOptions += '<option value="' + value.city + '">'+ value.city.toUpperCase() +'</option>'

                    }

                  });

                }else{

                  console.log(response.data.message);
                  allOptions += '<option></option>';

                }

                $('#form-city-vue').empty();
                $('#form-city-vue').append(allOptions);

              })
              .catch(function (error) {

                console.log(error);
                allOptions += '<option></option>';

              });

            },

            showVueListSubDistricts: function(existAddress){

              var allOptions;

              axios.get('/api/v1/sub-district/' + existAddress.city ).then(function (response) {

                if (response.data.error == '000') {

                  $.each(response.data.data, function( index, value ) {

                    if (existAddress.sub_district == value.sub_district) {

                      allOptions += '<option selected value="' + value.sub_district + '">'+ value.sub_district.toUpperCase() +'</option>'

                    }else{

                      allOptions += '<option value="' + value.sub_district + '">'+ value.sub_district.toUpperCase() +'</option>'

                    }

                  });

                }else{

                  console.log(response.data.message);
                  allOptions += '<option></option>';

                }

                $('#form-subdistrict-vue').empty();
                $('#form-subdistrict-vue').append(allOptions);

              })
              .catch(function (error) {

                console.log(error);
                allOptions += '<option></option>';

              });

            },

            showVueListVillages: function(existAddress){

              var allOptions;

              axios.get('/api/v1/villages/' + existAddress.sub_district ).then(function (response) {

                if (response.data.error == '000') {

                  $.each(response.data.data, function( index, value ) {

                    if (existAddress.village == value.village) {

                      allOptions += '<option selected value="' + value.village + '">'+ value.village.toUpperCase() +'</option>'

                    }else{

                      allOptions += '<option value="' + value.village + '">'+ value.village.toUpperCase() +'</option>'

                    }

                  });

                }else{

                  console.log(response.data.message);
                  allOptions += '<option></option>';

                }

                $('#form-village-vue').empty();
                $('#form-village-vue').append(allOptions);

              })
              .catch(function (error) {

                console.log(error);
                allOptions += '<option></option>';

              });

            },

            changeCountryAddress: function(e){

              var existAddress = {};

              existAddress.country = e.target.value;
              existAddress.province = '';
              existAddress.city = '';

              this.initHandleAddressing(existAddress);
              this.handleAddressing(existAddress);

            }
        }
    }
</script>
