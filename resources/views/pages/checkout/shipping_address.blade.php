@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
   <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
   </div>
   <div class="uk-grid-small uk-margin-top" uk-grid>
      <div class="uk-width-3-4@m">
         <h4>CHECKOUT</h4>
         <div class="uk-grid uk-grid-divider uk-child-width-1-3@m uk-margin-small" uk-grid>
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled><b>SHIPPING ADDRESS</b></button>
            </div>
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>SHIPPING OPTION</button>
            </div>
{{--             <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>BILLING</button>
            </div> --}}
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>REVIEW</button>
            </div>
         </div>
         <hr class="uk-margin-small">
         @if (count($address))
         <span class="uk-text-meta">SELECT YOUR SHIPPING ADDRESS:</span>
         <hr class="uk-margin-small">
          <address-list
            address="{{ $address }}"
            address_default="{{ route('user.address.default') }}"
            address_destroy="{{ route('user.address.destroy') }}"
            address_edit="{{ route('user.address.edit') }}"
            address_update="{{ route('user.address.update') }}"
          ></address-list>
         <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-header">
                  <h4 class="uk-modal-title">ADD A NEW ADDRESS</h4>
              </div>
              <div class="uk-modal-body">
                <form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout" value="ok">
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      First name
                      <input class="uk-input uk-input-small" name="first_name" id="form-s-tel" type="text" value="{{ old('first_name') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Last name
                      <input class="uk-input uk-input-small" name="last_name" id="form-s-tel" type="text" value="{{ old('last_name') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    Company
                    <input class="uk-input uk-input-small" name="company" id="form-s-tel" type="text" value="{{ old('company') }}"></div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Address line
                      <input class="uk-input uk-input-small" name="address_line" id="form-s-tel" type="text" value="{{ old('address_line') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Country
                      <select id="form-country-empty" name="country" class="uk-input uk-input-small {{ $errors->has('country') ? ' uk-form-danger' : '' }}" required="required" onchange="handleLocalAddress();showListProvices();">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Province
                      <input class="uk-input uk-input-small" name="province" id="form-province-empty" type="text" value="{{ old('province') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      City
                      <input id="form-city-empty" class="uk-input uk-input-small" name="city" id="form-s-tel" type="text" value="{{ old('city') }}" required="required">
                    </div>
                  </div>
                  <div id="div-sub-district" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Sub district
                      <input class="uk-input uk-input-small {{ $errors->has('sub_district') ? ' uk-form-danger' : '' }}" name="sub_district" id="form-subdistrict-empty" type="text" value="{{ old('sub_district') }}" required>
                    </div>
                  </div>
                  <div  id="div-village" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Village
                      <input class="uk-input uk-input-small {{ $errors->has('village') ? ' uk-form-danger' : '' }}" name="village" id="form-village-empty" type="text" value="{{ old('village') }}" required>
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Postal
                      <input class="uk-input uk-input-small {{ $errors->has('postal') ? ' uk-form-danger' : '' }}" name="postal" id="form-postal-empty" type="text" value="{{ old('postal') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Phone number
                      <input class="uk-input uk-input-small" name="phone_number" id="form-s-tel" type="text" value="{{ old('phone_number') }}" required="required">
                    </div>
                  </div>
                  <input type="submit" id="new-address" style="display: none">
                  </form>
              </div>
              <div class="uk-modal-footer uk-text-right">
                  <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                  <button class="uk-button uk-button-secondary" id="modal-submit">Save</button>
              </div>
            </div>
          </div>
         @else
         <span class="uk-text-meta">YOUR SHIPPING INFORMATION</span>
         <hr class="uk-margin-small">
         <div class="uk-grid uk-width-1-2@m">
            <form action="{{ route('user.address') }}" method="post">
               {{ csrf_field() }}
               <input type="hidden" name="checkout" value="ok">
               <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-text-meta" uk-grid>
                  <div>
                     First Name *
                     <input type="text" name="first_name" value="{{ old('first_name') }}" class="uk-input uk-form-small {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" required="required">
                  </div>
                  <div>
                     Last Name *
                     <input type="text" name="last_name" value="{{ old('last_name') }}" class="uk-input uk-form-small {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" required="required">
                  </div>
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Company / Care Of (Optional)
                  <input type="text" name="company" value="{{ old('company') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Address *
                  <input type="text" name="address_line" value="{{ old('address_line') }}" class="uk-input uk-form-small {{ $errors->has('address_line') ? ' uk-form-danger' : '' }}" required="required">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Country
                  <select id="form-country-empty" name="country" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('country') ? ' uk-form-danger' : '' }}" required="required" onchange="handleLocalAddress();showListProvices();">
                    <option></option>
                  </select>
              </div>
              <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Province / State / Country *
                  <input class="uk-input uk-form-small uk-from-width-small" name="province" id="form-province-empty" type="text" value="{{ old('province') }}" required="required">
              </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Town / City *
                  <input id="form-city-empty" class="uk-input uk-form-small uk-from-width-small" name="city" id="form-s-tel" type="text" value="{{ old('city') }}" required="required">
               </div>
               <div id="div-sub-district" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Sub district
                      <input class="uk-input uk-input-small {{ $errors->has('sub_district') ? ' uk-form-danger' : '' }}" name="sub_district" id="form-subdistrict-empty" type="text" value="{{ old('sub_district') }}" required>
                    </div>
                  </div>
                  <div  id="div-village" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Village
                      <input class="uk-input uk-input-small {{ $errors->has('village') ? ' uk-form-danger' : '' }}" name="village" id="form-village-empty" type="text" value="{{ old('village') }}" required>
                    </div>
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                  Postal Code *
                  <input type="text" id="form-postal-empty" name="postal" value="{{ old('postal') }}" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('postal') ? ' uk-form-danger' : '' }}" required="required">
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                  Phone Number *
                  <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('phone_number') ? ' uk-form-danger' : '' }}" required="required">
               </div>

               <div class="uk-text-meta uk-margin-small-top">
{{--                   <input type="checkbox" class="uk-checkbox" name="is_billing" value="ok"> This address is also my billing address --}}
                  <p> <b>* Required</b> </p>
               </div>
                <div class="uk-panel uk-margin-small-top">
                  <input type="submit" name="submit" id="submit" value="SUBMIT" class="uk-button uk-button-danger uk-width-1-1">
               </div>
            </form>
         </div>
         @endif
            <item-checkout
               bag_api="{{ route('persist.bag') }}"
               aws_link="{{ config('filesystems.s3url') }}"
               default_image="{{ json_encode(config('common.default')) }}"
            ></item-checkout>
         <hr class="uk-margin-small">
      </div>
      <summary-checkout
        shipping_cost="0"
      ></summary-checkout>
   </div>
</div>
</div>
@endsection
@section('footer_scripts')
<script type="text/javascript">
   $(function () {
     var url = '{{ route('checkout.shipping') }}';
     $("#continue").on('click', function (e) {
       e.preventDefault();
       var submit = $('#submit').val();
       console.log(submit);
       if (submit == 'SUBMIT') {
         $('#submit').click();
       } else {
         window.location.href = url;
       }

     });

     $('#modal-submit').on('click', function () {
     $('#new-address').click();
    });
   })

   $(document).ready(function(){
      startLocalAddressing();
  });

  function startLocalAddressing() {

    // default hidden
    $('#div-sub-district').hide();
    $('#div-village').hide();

    // show all country
    showListCountries();

    // fixing template if submit error
    handleFormWhenError();

  }

  function handleFormWhenError(){ // this methode will replace input that suitable by country

    if ( {{ ($errors->any() == true) ? 1 : 0 }} ) {

      if ('{{old("country")}}' == 'ID') {

        $('#form-province-empty').replaceWith('<select id="form-province-empty" onchange="showListCities()" name="province" class="uk-input uk-input-small {{ $errors->has("province") ? " uk-form-danger" : "" }}" required></select>');
        showListProvices();

        $('#form-city-empty').replaceWith('<select id="form-city-empty" onchange="showListSubDistricts()" name="city" class="uk-input uk-input-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required></select>');
        showListCities();

        $('#div-sub-district').show();
        $('#div-village').show();

        $('#form-subdistrict-empty').replaceWith('<select id="form-subdistrict-empty" onchange="showListVillages()" name="sub_district" class="uk-input uk-input-small {{ $errors->has("sub_district") ? " uk-form-danger" : "" }}" required></select>');
        showListSubDistricts();

        $('#form-village-empty').replaceWith('<select id="form-village-empty" onchange="setPostalCode()" name="village" class="uk-input uk-input-small {{ $errors->has("village") ? " uk-form-danger" : "" }}" required></select>');
        showListVillages();

      }

    }

  }

  function handleLocalAddress() { //onchange , triger in <option> country

    if ($('#form-country-empty').val() == 'ID') {

      $('#form-province-empty').replaceWith('<select id="form-province-empty" onchange="showListCities()" name="province" class="uk-input uk-input-small {{ $errors->has("province") ? " uk-form-danger" : "" }}" required><option>Select country first</option></select>');
      $('#form-city-empty').replaceWith('<select id="form-city-empty" onchange="showListSubDistricts()" name="city" class="uk-input uk-input-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required><option>Select province first</option></select>');
      $('#form-subdistrict-empty').replaceWith('<select id="form-subdistrict-empty" onchange="showListVillages()" name="sub_district" class="uk-input uk-input-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required><option>Select city first</option></select>');
      $('#form-village-empty').replaceWith('<select id="form-village-empty" onchange="setPostalCode()" name="village" class="uk-input uk-input-small {{ $errors->has("village") ? " uk-form-danger" : "" }}" required><option>Select sub district first</option></select>');

      $('#div-sub-district').show();
      $('#div-village').show();

    }else{

      $('#form-province-empty').replaceWith('<input class="uk-input uk-input-small" name="province" id="form-province-empty" type="text" value="{{ old("province") }}" required>');
      $('#form-city-empty').replaceWith('<input class="uk-input uk-input-small" name="city" id="form-city-empty" type="text" value="{{ old("city") }}" required>');
      $('#form-subdistrict-empty').replaceWith('<span class="uk-input uk-input-small " name="sub_district" id="form-subdistrict-empty" type="text" value=""></span>');
      $('#form-village-empty').replaceWith('<span class="uk-input uk-input-small " name="village" id="form-village-empty" type="text" value=""></span>');

      $('#div-sub-district').hide();
      $('#div-village').hide();

      $('#form-province-empty').val('');
      $('#form-city-empty').val('');
    }

  }

  function showListCountries(){

    var allOptionsCountry = '';

    var jqxhr = $.get( "/api/v1/countries", function(response) {

      if (response.error == '000') {

        $.each(response.data, function( index, value ) {

          if ("{{old('country')}}" == value.countries_code) {

            selectedAlreadyExist = true;
            allOptionsCountry += '<option selected value="' + value.countries_code + '">'+ value.countries_name.toUpperCase() +'</option>'

          }else{

            allOptionsCountry += '<option value="' + value.countries_code + '">'+ value.countries_name.toUpperCase() +'</option>'

          }

        });

      }else{

        console.log(response.message);
        allOptionsCountry += '<option></option>';

      }

      $('#form-country-empty').append(allOptionsCountry);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load countries');

    });
  }

  function showListProvices(){

    var allOptionsProvince = null;

    var jqxhr = $.get( "/api/v1/provinces", function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('province')}}" == value.province) {

              selectedAlreadyExist = true;
              allOptionsProvince += '<option selected value="' + value.province + '">'+ value.province +'</option>';

            }else{

              allOptionsProvince += '<option value="' + value.province + '">'+ value.province +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsProvince += '<option></option>';

      }

      $('#form-province-empty').empty();
      $('#form-province-empty').append( '<option></option>'+ allOptionsProvince);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load province');

    });
  }

  function showListCities() {

    var allOptionsCity = '';
    var byProvince = $('#form-province-empty').val();

    if (byProvince == null) {

      byProvince = '{{ old("province") }}';

    }

    var jqxhr = $.get( "/api/v1/cities/" + byProvince , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('city')}}" == value.city) {

              selectedAlreadyExist = true;
              allOptionsCity += '<option selected value="' + value.city + '">'+ value.city +'</option>';

            }else{

              allOptionsCity += '<option value="' + value.city + '">'+ value.city +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsCity += '<option></option>';

      }

      $('#form-city-empty').empty();
      $('#form-city-empty').append('<option></option>'+allOptionsCity);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load city');

    });

  }

  function showListSubDistricts() {

    var allOptionsSubDistrict = '';
    var byCity = $('#form-city-empty').val();

    if (byCity == null) {

      byCity = '{{old("city")}}';

    }

    var jqxhr = $.get( "/api/v1/sub-district/" + byCity , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('sub_district')}}" == value.sub_district) {

              allOptionsSubDistrict += '<option selected value="' + value.sub_district + '">'+ value.sub_district +'</option>';

            }else{

              allOptionsSubDistrict += '<option value="' + value.sub_district + '">'+ value.sub_district +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsSubDistrict += '';

      }

      $('#form-subdistrict-empty').empty();
      $('#form-subdistrict-empty').append('<option></option>' + allOptionsSubDistrict);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load subdistrict');

    });

  }

  function showListVillages() {

    var allOptionsVillage = '';
    var bySubDistrict = $('#form-subdistrict-empty').val();

    if (bySubDistrict == null) {

      bySubDistrict = '{{ old("sub_district") }}';

    }

    var jqxhr = $.get( "/api/v1/villages/" + bySubDistrict , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('village')}}" == value.village) {

              allOptionsVillage += '<option selected value="' + value.village + '">'+ value.village + ' - ' + value.postal_code +'</option>';

            }else{

              allOptionsVillage += '<option value="' + value.village + '">'+ value.village + ' - ' + value.postal_code +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsVillage += '';

      }
      console.log(this.vilageWithPosCode);
      $('#form-village-empty').empty();
      $('#form-village-empty').append('<option></option>' + allOptionsVillage);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load village');

    });

  }

  function setPostalCode() {

    var villageLabel = $('#form-village-empty option:selected').text();
    var posCode;

    posCode = villageLabel.replace(' ','');
    posCode = posCode.split('-');
    posCode = posCode[1];

    $('#form-postal-empty').val(posCode);

  }

   // punya vue -----------

   function showVueListCities() {

    var allOptionsCity = '';
    var byProvince = $('#form-province-vue').val();

    var jqxhr = $.get("/api/v1/cities/" + byProvince , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('city')}}" == value.city) {

              allOptionsCity += '<option selected value="' + value.city + '">'+ value.city +'</option>';

            }else{

              allOptionsCity += '<option value="' + value.city + '">'+ value.city +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsCity += '<option></option>';

      }

      $('#form-city-vue').empty();
      $('#form-city-vue').append('<option></option>'+allOptionsCity);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load city');

    });

  }

  function showVueListSubDistricts() {

    var allOptionsSubDistrict = '';
    var byCity = $('#form-city-vue').val();

    var jqxhr = $.get( "/api/v1/sub-district/" + byCity , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('sub_district')}}" == value.sub_district) {

              allOptionsSubDistrict += '<option selected value="' + value.sub_district + '">'+ value.sub_district +'</option>';

            }else{

              allOptionsSubDistrict += '<option value="' + value.sub_district + '">'+ value.sub_district +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsSubDistrict += '';

      }

      $('#form-subdistrict-vue').empty();
      $('#form-subdistrict-vue').append('<option></option>' + allOptionsSubDistrict);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load subdistrict');

    });

  }

  function showVueListVillages() {

    var allOptionsVillage = '';
    var bySubDistrict = $('#form-subdistrict-vue').val();

    var jqxhr = $.get( "/api/v1/villages/" + bySubDistrict , function(response) {

      if (response.error == '000') {

          $.each(response.data, function( index, value ) {

            if ("{{old('village')}}" == value.village) {

              allOptionsVillage += '<option selected value="' + value.village + '">'+ value.village + ' - ' + value.postal_code +'</option>';

            }else{

              allOptionsVillage += '<option value="' + value.village + '">'+ value.village + ' - ' + value.postal_code +'</option>';

            }

          });

      }else{

        console.log(response.message);
        allOptionsVillage += '';

      }

      $('#form-village-vue').empty();
      $('#form-village-vue').append('<option></option>' + allOptionsVillage);

    }).fail(function(xhr, status, error) {

      alert(error + ' when load subdistrict');

    });

  }

  function setVuePostalCode() {

    var villageLabel = $('#form-village-vue option:selected').text();
    var posCode;

    posCode = villageLabel.replace(' ','');
    posCode = posCode.split('-');
    posCode = posCode[1];

    $('#form-postal-vue').val(posCode);

  }

   // end punya vue -------
</script>
@endsection
