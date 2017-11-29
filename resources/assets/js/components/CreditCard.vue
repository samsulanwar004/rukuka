<template>
    <div class="uk-grid" uk-grid>
       <div class="uk-width-1-3" v-for="credit in data">
          <div :class="{'uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large': true, 'uk-background-muted': credit.is_default }">            
             <div class="uk-card-body">
                <table>
                   <tr>
                      <td>
                         <input class="uk-radio" type="radio" name="default" :checked="credit.is_default ? true : false" v-on:click="changeDefault(credit.id)">
                      </td>
                      <td>
                         {{ credit.card_number | card }}
                      </td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>{{ credit.card_number | mask}}</td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>{{ credit.expired_date }}</td>
                   </tr>
                   <tr>
                      <td>
                      </td>
                      <td>
                         {{ credit.name_card }}
                      </td>
                   </tr>
                   <tr>
                      <td>

                      </td>
                      <td>
                        <a href="#modal-edit" class="uk-icon-link" uk-icon="icon: file-edit" uk-toggle v-on:click.prevent="editCredit(credit.id)"></a>
                        <a href="#" v-on:click.prevent="removeCredit(credit.id)" class="uk-icon-link" uk-icon="icon: trash"></a>
                      </td>
                   </tr>
                </table>
             </div>
          </div>
       </div>
       <div class="uk-width-1-3">
          <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
             <div class="uk-card-body">
                <a href="#modal-sections" class="uk-text-meta" uk-toggle> <span class="uk-icon" uk-icon="icon: plus"></span> ADD NEW CARD </a>
             </div>
          </div>
       </div>
       <div id="modal-edit" uk-modal>
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
              <h4 class="uk-modal-title">EDIT CARD</h4>
          </div>
          <div class="uk-modal-body">
            <form class="uk-form-stacked" v-on:submit.prevent="updateCredit">
              <input type="hidden" name="id" :value="credit.id">
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    Credit or debit card number <br>
                    <div class="uk-inline">
                      <span class="uk-form-icon uk-form-icon-flip"><img src="/images/default_card.png" id="card-img"></span>
                      <input class="uk-input uk-input-small" name="card_number" id="card-number" type="text" :value="credit.card_number" required="required">
                    </div>
                  </div>
                  <div class="uk-inline">
                    <a class="uk-icon-link" uk-icon="icon: question"></a>
                    <div uk-drop="pos: right-center">
                        <div class="uk-card uk-card-body uk-card-default uk-padding-small uk-text-small">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>
                  </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    expired date
                      <input class="uk-input uk-input-small" name="expired_date" id="expired-date" type="text" :value="credit.expired_date" required="required">
                  </div>
                  <div class="uk-inline">
                    <a class="uk-icon-link" uk-icon="icon: question"></a>
                    <div uk-drop="pos: right-center">
                        <div class="uk-card uk-card-body uk-card-default uk-padding-small uk-text-small">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>
                  </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    name on card
                      <input class="uk-input uk-input-small" name="name_card" id="form-s-tel" type="text" :value="credit.name_card" required="required">
                  </div>
              </div>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    enter a billing address
                      <select class="uk-input uk-input-small" :value="credit.address_id" name="address" id="address" required="required">
                        <option value="">Select Address</option>
                        <option v-for="address in add" :value="address.id">{{ address.address_line }}</option>
                      </select>

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
    require('../jquery.creditCardValidator');
    import axios from 'axios';
    export default {
        props: [
          'credits', 
          'credit_default', 
          'credit_destroy', 
          'credit_edit',
          'credit_update',
          'address'
        ],

        data () {
            return {
                data: {},
                credit: {},
                add: {}
            }
        },

        created () {
            var self = this;
            self.data = this.credits ? JSON.parse(this.credits) : {};
            self.add = this.address ? JSON.parse(this.address) : {};
        },

        methods: {
            changeDefault: function (id) {
                var self = this;
                axios.post(this.credit_default, {
                    default: id
                })
                .then(function (response) {
                    if (typeof response.data.message !== 'undefined') {
                        if (response.data.status.toLowerCase() == 'ok') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Change default card successfully", {
                                status:'success'
                            });

                            self.data = response.data.credits;
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

            removeCredit: function (id) {
                var self = this;
                axios.post(this.credit_destroy, {
                    id: id,
                    _method: 'DELETE'
                })
                .then(function (response) {
                    if (typeof response.data.message !== 'undefined') {
                        if (response.data.status.toLowerCase() == 'ok') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Delete card successfully", {
                                status:'success'
                            });

                            self.data = response.data.credits;

                            if (response.data.credits.length <= 0) {
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

            editCredit: function (id) {
              var self = this;
              axios.get(this.credit_edit+'/'+id)
              .then(function (response) {
                if (typeof response.data.credit !== 'undefined') {
                  self.credit = response.data.credit;
                }
              })
              .catch(function (error) {
                console.log(error);
              });
            },

            updateCredit: function (e) {
              var card_number = e.target.elements.card_number.value;
              var expired_date = e.target.elements.expired_date.value;
              var name_card = e.target.elements.name_card.value;
              var address = e.target.elements.address.value;
              var id = e.target.elements.id.value;

              var self = this;
              axios.post(this.credit_update+'/'+id, {
                card_number : card_number,
                expired_date : expired_date,
                name_card : name_card,
                address : address
              })
              .then(function (response) {
                  if (typeof response.data.message !== 'undefined') {
                      if (response.data.status.toLowerCase() == 'ok') {
                          UIkit.notification("<span uk-icon='icon: check'></span> Update card successfully", {
                              status:'success'
                          });

                          self.data = response.data.credits;

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
            }
        },

        filters: {
          mask: function (value) {
            var code = value.substring(13);

            return '*************'+code;
          },

          card: function (number) {
            // visa
            var re = new RegExp("^4");
            if (number.match(re) != null)
                return "Visa";

            // Mastercard 
            // Updated for Mastercard 2017 BINs expansion
             if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number)) 
                return "Mastercard";

            // AMEX
            re = new RegExp("^3[47]");
            if (number.match(re) != null)
                return "AMEX";

            // Discover
            re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
            if (number.match(re) != null)
                return "Discover";

            // Diners
            re = new RegExp("^36");
            if (number.match(re) != null)
                return "Diners";

            // Diners - Carte Blanche
            re = new RegExp("^30[0-5]");
            if (number.match(re) != null)
                return "Diners - Carte Blanche";

            // JCB
            re = new RegExp("^35(2[89]|[3-8][0-9])");
            if (number.match(re) != null)
                return "JCB";

            // Visa Electron
            re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
            if (number.match(re) != null)
                return "Visa Electron";

            return "";
          }
        },

        mounted () {
          $('#card-number').validateCreditCard(function(result) {
            var card = result.card_type == null ? '' : result.card_type.name;
            if (result.valid) {
              $('#submit').removeAttr('disabled');
              $('#modal-submit').removeAttr('disabled');
            } else {
              $('#submit').attr('disabled', 'disabled');
              $('#modal-submit').attr('disabled', 'disabled');
            }

            if (card == 'visa') {
              $('#card-img').attr('src', '/images/visa.png');
            } else if (card == 'mastercard') {
              $('#card-img').attr('src', '/images/mastercard.png');
            } else if (card == 'discover') {
              $('#card-img').attr('src', '/images/discover.png');
            } else {
              $('#card-img').attr('src', '/images/default_card.png');
            }
          });
        }
    }

</script>
