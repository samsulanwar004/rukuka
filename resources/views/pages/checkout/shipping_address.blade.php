@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
   <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
   </div>
   <div class="uk-margin-top" uk-grid>
      <div class="uk-width-2-3@m">
        <div class="uk-card uk-card-default uk-card-small uk-background-muted uk-box-shadow-small" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;">
          <div class="uk-card-body">
           <div class="uk-grid uk-grid-divider uk-child-width-1-3 uk-margin-small" uk-grid>

               <div class="uk-text-center">
                  <button class="uk-button uk-button-text" disabled><b>{{ trans('app.shipping_address') }}</b></button>
               </div>
               <div class="uk-text-center">
                  <button class="uk-button uk-button-text" disabled>{{ trans('app.shipping_option') }}</button>
               </div>
               <div class="uk-text-center">
                  <button class="uk-button uk-button-text" disabled>{{ trans('app.review') }}</button>
               </div>

           </div>
         </div>
         </div>
         <h4 class="uk-margin-small uk-text-uppercase">{{ trans('app.checkout') }}</h4>
         @if (count($address))
         <h6 class="uk-margin-small uk-text-uppercase">{{ trans('app.select_shipping') }}:</h6>
          <address-list
                address="{{ $address }}"
                address_default="{{ route('user.address.default') }}"
                address_destroy="{{ route('user.address.destroy') }}"
                address_edit="{{ route('user.address.edit') }}"
                address_update="{{ route('user.address.update') }}"
                locale="{{ json_encode(trans('app')) }}"
          ></address-list>
         <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-body">
                <h4 class="uk-modal-title">{{ trans('app.add_address') }}</h4>
                <form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout" value="ok">
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.first_name') }}</label>
                      <input class="uk-input uk-form-small" name="first_name" id="form-s-tel" type="text" value="{{ old('first_name') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.last_name') }}</label>
                      <input class="uk-input uk-form-small" name="last_name" id="form-s-tel" type="text" value="{{ old('last_name') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                  <div>
                      <label>{{ trans('app.company') }}</label>
                    <input class="uk-input uk-form-small" name="company" id="form-s-tel" type="text" value="{{ old('company') }}"></div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.address_line') }}</label>
                      <input class="uk-input uk-form-small" name="address_line" id="form-s-tel" type="text" value="{{ old('address_line') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.country') }}</label>
                      <select id="form-country-empty" name="country" class="uk-input uk-form-small {{ $errors->has('country') ? ' uk-form-danger' : '' }}" required="required" onchange="handleLocalAddress();showListProvices();">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.province') }}</label>
                      <input class="uk-input uk-form-small" name="province" id="form-province-empty" type="text" value="{{ old('province') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.city') }}</label>
                      <input id="form-city-empty" class="uk-input uk-form-small" name="city" id="form-s-tel" type="text" value="{{ old('city') }}" required="required">
                    </div>
                  </div>
                  <div id="div-sub-district" class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.sub_district') }}</label>
                      <input class="uk-input uk-form-small {{ $errors->has('sub_district') ? ' uk-form-danger' : '' }}" name="sub_district" id="form-subdistrict-empty" type="text" value="{{ old('sub_district') }}" required>
                    </div>
                  </div>
                  <div  id="div-village" class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.village') }}</label>
                      <input class="uk-input uk-form-small {{ $errors->has('village') ? ' uk-form-danger' : '' }}" name="village" id="form-village-empty" type="text" value="{{ old('village') }}" required>
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.postal') }}</label>
                      <input class="uk-input uk-form-small {{ $errors->has('postal') ? ' uk-form-danger' : '' }}" name="postal" id="form-postal-empty" type="text" value="{{ old('postal') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-text-meta uk-width-1-1">
                    <div>
                        <label>{{ trans('app.phone') }}</label>
                      <input class="uk-input uk-form-small" name="phone_number" id="form-s-tel" type="text" value="{{ old('phone_number') }}" required="required">
                    </div>
                  </div>
                  <input type="submit" id="new-address" style="display: none">
                  </form>
              </div>
              <div class="uk-modal-footer uk-text-right">
                <div class="uk-child-width-1-2" uk-grid>
                  <div>
                    <button class="uk-button uk-button-default uk-button-small uk-modal-close uk-width-1-1" type="button">{{ trans('app.cancel') }}</button>
                  </div>
                  <div>
                    <button class="uk-button uk-button-secondary uk-button-small uk-width-1-1" id="modal-submit">{{ trans('app.save') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
         @else
         <h5 class="uk-margin-small-top uk-text-uppercase">{{ trans('app.shipping_info') }}</h5>
         <div class="uk-grid uk-width-1-2@m">
            <form action="{{ route('user.address') }}" method="post">
               {{ csrf_field() }}
               <input type="hidden" name="checkout" value="ok">
               <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-text-meta" uk-grid>
                  <div>
                      <label>{{ trans('app.first_name') }}*</label>
                     <input type="text" name="first_name" value="{{ old('first_name') }}" class="uk-input uk-form-small {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" required="required">
                  </div>
                  <div>
                      <label>{{ trans('app.last_name') }}*</label>
                     <input type="text" name="last_name" value="{{ old('last_name') }}" class="uk-input uk-form-small {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" required="required">
                  </div>
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                   <label>{{ trans('app.company') }}</label>
                  <input type="text" name="company" value="{{ old('company') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                   <label>{{ trans('app.address_line') }}*</label>
                  <input type="text" name="address_line" value="{{ old('address_line') }}" class="uk-input uk-form-small {{ $errors->has('address_line') ? ' uk-form-danger' : '' }}" required="required">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                   <label>{{ trans('app.country') }}</label>
                  <select id="form-country-empty" name="country" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('country') ? ' uk-form-danger' : '' }}" required="required" onchange="handleLocalAddress();showListProvices();">
                    <option></option>
                  </select>
              </div>
              <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  <label>{{ trans('app.province') }}</label>
                  <input class="uk-input uk-form-small uk-from-width-small" name="province" id="form-province-empty" type="text" value="{{ old('province') }}" required="required">
              </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                   <label>{{ trans('app.city') }}</label>
                  <input id="form-city-empty" class="uk-input uk-form-small uk-from-width-small" name="city" id="form-s-tel" type="text" value="{{ old('city') }}" required="required">
               </div>
               <div id="div-sub-district" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                        <label>{{ trans('app.sub_district') }}</label>
                      <input class="uk-input uk-form-small {{ $errors->has('sub_district') ? ' uk-form-danger' : '' }}" name="sub_district" id="form-subdistrict-empty" type="text" value="{{ old('sub_district') }}" required>
                    </div>
                  </div>
                  <div  id="div-village" class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                        <label>{{ trans('app.village') }}</label>
                      <input class="uk-input uk-form-small {{ $errors->has('village') ? ' uk-form-danger' : '' }}" name="village" id="form-village-empty" type="text" value="{{ old('village') }}" required>
                    </div>
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                   <label>{{ trans('app.postal') }}*</label>
                  <input type="text" id="form-postal-empty" name="postal" value="{{ old('postal') }}" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('postal') ? ' uk-form-danger' : '' }}" required="required">
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                   <label>{{ trans('app.phone') }}*</label>
                  <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="uk-input uk-form-small uk-from-width-small {{ $errors->has('phone_number') ? ' uk-form-danger' : '' }}" required="required">
               </div>
               <div class="uk-text-meta uk-margin-top">
                  <p> <b>* {{ trans('app.required') }}</b> </p>
               </div>
                <div class="uk-panel uk-margin-small-top">
                  <input type="submit" name="submit" id="submit" value="{{ trans('app.submit') }}" class="uk-button uk-button-default uk-button-small uk-width-1-1">
               </div>
            </form>
         </div>

         @endif
         <hr class="uk-margin" style="border-color: #333; border-width: 3px">
            <item-checkout
               bag_api="{{ route('persist.bag') }}"
               aws_link="{{ config('filesystems.s3url') }}"
               default_image="{{ json_encode(config('common.default')) }}"
               locale="{{ json_encode(trans('app')) }}"
               exchange_api="{{ route('exchange') }}"
            ></item-checkout>
      </div>
      <summary-checkout
        shipping_cost="0"
        locale="{{ json_encode(trans('app')) }}"
      ></summary-checkout>
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
       var url = '{{ route('checkout.shipping') }}';
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

        $('#form-province-empty').replaceWith('<select id="form-province-empty" onchange="showListCities()" name="province" class="uk-input uk-form-small {{ $errors->has("province") ? " uk-form-danger" : "" }}" required></select>');
        showListProvices();

        $('#form-city-empty').replaceWith('<select id="form-city-empty" onchange="showListSubDistricts()" name="city" class="uk-input uk-form-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required></select>');
        showListCities();

        $('#div-sub-district').show();
        $('#div-village').show();

        $('#form-subdistrict-empty').replaceWith('<select id="form-subdistrict-empty" onchange="showListVillages()" name="sub_district" class="uk-input uk-form-small {{ $errors->has("sub_district") ? " uk-form-danger" : "" }}" required></select>');
        showListSubDistricts();

        $('#form-village-empty').replaceWith('<select id="form-village-empty" onchange="setPostalCode()" name="village" class="uk-input uk-form-small {{ $errors->has("village") ? " uk-form-danger" : "" }}" required></select>');
        showListVillages();

      }

    }

  }

  function handleLocalAddress() { //onchange , triger in <option> country

    if ($('#form-country-empty').val() == 'ID') {

      $('#form-province-empty').replaceWith('<select id="form-province-empty" onchange="showListCities()" name="province" class="uk-input uk-form-small {{ $errors->has("province") ? " uk-form-danger" : "" }}" required><option>Select country first</option></select>');
      $('#form-city-empty').replaceWith('<select id="form-city-empty" onchange="showListSubDistricts()" name="city" class="uk-input uk-form-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required><option>Select province first</option></select>');
      $('#form-subdistrict-empty').replaceWith('<select id="form-subdistrict-empty" onchange="showListVillages()" name="sub_district" class="uk-input uk-form-small {{ $errors->has("city") ? " uk-form-danger" : "" }}" required><option>Select city first</option></select>');
      $('#form-village-empty').replaceWith('<select id="form-village-empty" onchange="setPostalCode()" name="village" class="uk-input uk-form-small {{ $errors->has("village") ? " uk-form-danger" : "" }}" required><option>Select sub district first</option></select>');

      $('#div-sub-district').show();
      $('#div-village').show();

    }else{

      $('#form-province-empty').replaceWith('<input class="uk-input uk-form-small" name="province" id="form-province-empty" type="text" value="{{ old("province") }}" required>');
      $('#form-city-empty').replaceWith('<input class="uk-input uk-form-small" name="city" id="form-city-empty" type="text" value="{{ old("city") }}" required>');
      $('#form-subdistrict-empty').replaceWith('<span class="uk-input uk-form-small " name="sub_district" id="form-subdistrict-empty" type="text" value=""></span>');
      $('#form-village-empty').replaceWith('<span class="uk-input uk-form-small " name="village" id="form-village-empty" type="text" value=""></span>');

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
