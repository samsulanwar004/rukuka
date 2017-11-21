@extends('app_checkout')
@section('content')
<div class="uk-container uk-container-small">
   <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
   </div>
   <div class="uk-grid-small uk-margin-top" uk-grid>
      <div class="uk-width-3-4@m">
         <b>C H E C K O U T</b>
         <hr class="uk-margin-remove-vertical">
         </hr>
         <div class="uk-grid uk-grid-divider uk-child-width-1-4@m uk-margin-small" uk-grid>
            <div>
               <button class="uk-button uk-button-text" disabled><b>SHIPPING ADDRESS</b></button>
            </div>
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>SHIPPING OPTION</button>
            </div>
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>BILLING</button>
            </div>
            <div class="uk-text-center">
               <button class="uk-button uk-button-text" disabled>REVIEW</button>
            </div>
         </div>
         <hr class="uk-margin-small">
         @if (count($address))
         <span class="uk-text-meta">SELECT YOUR SHIPPING ADDRESS:</span>
         <hr class="uk-margin-small">
         <form action="{{ route('user.address.default') }}" method="post">
            {{ csrf_field() }}
            <div class="uk-grid" uk-grid>
               @foreach($address as $add)
               <div class="uk-width-1-3">
                  <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
                     <div class="uk-card-body">
                        <table>
                           <tr>
                              <td>
                                 <input class="uk-checkbox" type="checkbox" name="default[{{$add->id}}]" {{ (bool)$add->is_default ? 'checked disabled' : '' }}>
                              </td>
                              <td>
                                 {{ $add->first_name }} {{ $add->last_name }}
                              </td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>{{ $add->address_line }}</td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>
                                 {{ $add->city }}, {{ $add->province }} {{ $add->postal }}
                              </td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>
                                 {{ $add->country }}
                              </td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>
                                 {{ $add->phone_number }}
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
               @endforeach
               <div class="uk-width-1-3">
                  <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
                     <div class="uk-card-body">
                        <a href="#modal-sections" class="uk-text-meta" uk-toggle> <span class="uk-icon" uk-icon="icon: plus"></span> ADD NEW SHIPPING ADDRESS </a>
                     </div>
                  </div>
               </div>
            </div>
            <input type="hidden" name="checkout" value="ok">
            <button type="submit" id="default-submit" style="display: none;"></button>
         </form>
         <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-header">
                  <h4 class="uk-modal-title">ADD A NEW ADDRESS</h4>
              </div>
              <div class="uk-modal-body">
                <form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout_new_address" value="ok">
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
                      City
                      <input class="uk-input uk-input-small" name="city" id="form-s-tel" type="text" value="{{ old('city') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Province
                      <input class="uk-input uk-input-small" name="province" id="form-s-tel" type="text" value="{{ old('province') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Postal
                      <input class="uk-input uk-input-small" name="postal" id="form-s-tel" type="text" value="{{ old('postal') }}" required="required">
                    </div>
                  </div>
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                    <div>
                      Country
                      <input class="uk-input uk-input-small" name="country" id="form-s-tel" type="text" value="{{ old('country') }}" required="required">
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
                     <input type="text" name="first_name" value="{{ old('first_name') }}" class="uk-input uk-form-small">
                  </div>
                  <div>
                     Last Name *
                     <input type="text" name="last_name" value="{{ old('last_name') }}" class="uk-input uk-form-small">
                  </div>
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Company / Care Of (Optional)
                  <input type="text" name="company" value="{{ old('company') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Address *
                  <input type="text" name="address_line" value="{{ old('address_line') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Town / City *
                  <input type="text" name="city" value="{{ old('city') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Province / State / Country *
                  <input type="text" name="province" value="{{ old('province') }}" class="uk-input uk-form-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                  Postal Code *
                  <input type="text" name="postal" value="{{ old('postal') }}" class="uk-input uk-form-small uk-from-width-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top">
                  Phone Number *
                  <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="uk-input uk-form-small uk-from-width-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  Country *
                  <input type="text" name="country" value="{{ old('country') }}" class="uk-input uk-form-small uk-from-width-small">
               </div>
               <div class="uk-text-meta uk-margin-small-top">
{{--                   <input type="checkbox" class="uk-checkbox" name="is_billing" value="ok"> This address is also my billing address --}}
                  <p> <b>* Required</b> </p>
               </div>
               <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
                  <input type="submit" name="submit" id="submit" value="C O N T I N U E" class="uk-button-danger uk-button uk-button-small uk-width-1-1">
               </div>
            </form>
         </div>
         @endif
         <hr class="uk-margin-small">
            <item-checkout
               bag_api="{{ route('persist.bag') }}"
            ></item-checkout>
         <hr class="uk-margin-small">
      </div>
      <summary-checkout></summary-checkout>
   </div>
</div>
</div>
@endsection
@section('footer_scripts')
<script type="text/javascript">
   $(function () {
     $("input:checkbox").on('click', function () {
       // in the handler, 'this' refers to the box clicked on
       var $box = $(this);
       if ($box.is(":checked")) {
         // the name of the box is retrieved using the .attr() method
         // as it is assumed and expected to be immutable
         var group = "input:checkbox[name='" + $box.attr("name") + "']";
         // the checked state of the group/box on the other hand will change
         // and the current value is retrieved using .prop() method
         $(group).prop("checked", false);
         $box.prop("checked", true);
       } else {
         $box.prop("checked", false);
       }
   
       $('#default-submit').click();
     });
   
     $("#continue").on('click', function (e) {
       e.preventDefault();
       var submit = $('#submit').val();
       var url = '{{ route('checkout.shipping') }}';
       if (submit == 'C O N T I N U E') {
         $('#submit').click();
       } else {
         window.location.href = url;
       }
   
     });

     $('#modal-submit').on('click', function () {
      $('#new-address').click();
    });
   })
</script>
@endsection