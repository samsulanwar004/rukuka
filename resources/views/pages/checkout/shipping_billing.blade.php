@extends('app_checkout')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
      @include('partials.alert')
  </div>
  <div class="uk-grid-small uk-margin-top" uk-grid>
    <div class="uk-width-3-4@m">
      <b>C H E C K O U T</b>
      <hr class="uk-margin-remove-vertical"></hr>
      <div class="uk-grid uk-grid-divider uk-child-width-1-4@m uk-margin-small" uk-grid>
        <div>
          <a href="{{ route('checkout') }}" class="uk-button uk-button-text">SHIPPING ADDRESS</a>
        </div>
        <div class="uk-text-center">
          <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-text">SHIPPING ADDRESS</a>
        </div>
        <div class="uk-text-center">
          <button class="uk-button uk-button-text" disabled><b>BILLING</b></button>
        </div>
        <div class="uk-text-center">
          <button class="uk-button uk-button-text" disabled>REVIEW</button>
        </div>
      </div>
      <hr class="uk-margin-small">
      {{-- <span class="uk-text-meta"><b>CHOOSE A PAYMENT METHOD:</b></span>
      <hr class="uk-margin-small">
      <div class="uk-grid" uk-grid>
        <div class="uk-width-1-3">
          <div class="uk-card uk-card-small uk-card-default uk-card-border uk-box-shadow-hover-large">
            <div class="uk-card-body">
              <input type="radio" name="creditcard" value="1" class="uk-radio"> Credit/Debit Card
            </div>
          </div>
        </div>
        <div class="uk-width-1-3">
          <div class="uk-card uk-card-small uk-card-default uk-card-border uk-box-shadow-hover-large">
            <div class="uk-card-body">
              <input type="radio" name="creditcard" value="2" class="uk-radio"> Credit
            </div>
          </div>
        </div>
      </div>
      <hr class="uk-margin-small"> --}}
      @if (count($creditcards))
      <span class="uk-text-meta">CHOOSE A CREDIT OR DEBIT CARD:</span>
       <hr class="uk-margin-small">
        <credit-card
          credits="{{ $creditcards }}"
          credit_default="{{ route('user.cc.default') }}"
          credit_destroy="{{ route('user.cc.destroy') }}"
          credit_edit="{{ route('user.cc.edit') }}"
          credit_update="{{ route('user.cc.update') }}"
          address="{{ $address }}"
        ></credit-card>
       <div id="modal-sections" uk-modal>
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
              <h4 class="uk-modal-title">ADD A NEW CARD</h4>
          </div>
          <div class="uk-modal-body">
            <form class="uk-form-stacked" action="{{ route('user.cc') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="checkout_new_card" value="ok">
            <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  Credit or debit card number <span id="card"></span>
                    <input class="uk-input uk-input-small" name="card_number" id="card-number" type="text" required="required" value="{{ old('card_number') }}">
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
                    <input class="uk-input uk-input-small" name="expired_date" id="expired-date" type="text" value="{{ old('expired_date') }}" required="required">
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
                    <input class="uk-input uk-input-small" name="name_card" id="form-s-tel" type="text" value="{{ old('name_card') }}" required="required">
                </div>
            </div>
            <div class="uk-margin-small uk-grid-small" uk-grid>
                <div>
                  enter a billing address
                  <select class="uk-input uk-input-small" name="address" id="address" required="required">
                    <option value="">Select Address</option>
                    @foreach($address as $add)
                      <option value="{{ $add->id }}">{{ $add->address_line }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <input type="submit" id="new-card" style="display: none">
            </form>
          </div>
          <div class="uk-modal-footer uk-text-right">
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <button class="uk-button uk-button-secondary" id="modal-submit">Save</button>
          </div>
        </div>
      </div>
      @else
      <span class="uk-text-meta"><b>ENTER YOUR CARD DETAILS:</b></span>
      <hr class="uk-margin-small">
      <form action="{{ route('user.cc') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="checkout" value="ok">
        <div class="uk-text-meta">
          <div>
            Card Number *<br>
            <input class="uk-input uk-form-small uk-form-width-medium" name="card_number" id="card-number" type="text" required="required" value="{{ old('card_number') }}">
          </div>
          <div class="uk-margin-small-top">
            Security Code *<br>
            <input type="text" name="security_code" value="{{ old('security_code') }}" class="uk-input uk-form-small uk-form-width-small" required="required"> <a href="#"> <i>What is this?</i> </a>
          </div>
          <div class="uk-margin-small-top">
            Expiration Date * <br>
            <input class="uk-input uk-form-small uk-form-width-small" name="expired_date" id="expired-date" type="text" value="{{ old('expired_date') }}" required="required">
          </div>
          <div class="uk-margin-small-top">
            Name on Card *<br>
            <input type="text" name="name_card" value="{{ old('name_card') }}" class="uk-input uk-form-small uk-form-width-medium" required="required">
          </div>
        </div>
        <div class="uk-margin">
          <input type="submit" name="submit" id="submit" value="C O N T I N U E" class="uk-button uk-button-small uk-button-danger uk-width-1-3">
        </div>
      <hr class="uk-margin-small">
      <span class="uk-text-meta"><b>CHOOSE A BILLING ADDRESS:</b></span>
      <hr class="uk-margin-small">
        <div class="uk-grid" uk-grid>
          @foreach($address as $add)
            <div class="uk-width-1-3">
              <div id="uk-card" class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
                <div class="uk-card-body">
                  <table>
                    <tr>
                      <td>
                        <input class="uk-radio" type="radio" name="address" {{ (bool)$add->is_default ? 'checked' : '' }} value="{{ $add->id }}">
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
                    <tr>
                      <td>

                      </td>
                      <td>
                        {{ (bool)$add->is_default ? '* Same as shipping address' : '' }}
                      </td>
                    </tr>
                  </table>

                </div>
              </div>
            </div>
          @endforeach
      </form>
          <div class="uk-width-1-3">
            <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
              <div class="uk-card-body">
                <a href="#" class="uk-text-meta"> <span class="uk-icon" uk-icon="icon: plus"></span> ADD YOUR SHIPPING OPTION </a>
              </div>
            </div>
          </div>
        </div>
      @endif
        <hr class="uk-margin-small">
        <span class="uk-text-meta"><b>SHIPPING DETAILS</b></span>
        <hr class="uk-margin-small">
        <div>
          <ul class="uk-list uk-text-meta">
            <li>{{ $defaultAddress->first_name }} {{ $defaultAddress->last_name}}</li>
            <li>{{ $defaultAddress->address_line }}</li>
            <li>{{ $defaultAddress->city }}</li>
            <li>{{ $defaultAddress->city }}, {{ $defaultAddress->country }} {{ $defaultAddress->postal }}</li>
            <li>{{ $defaultAddress->country }}</li>
            <li>{{ $defaultAddress->phone_number }}</li>
          </ul>
        </div>
        <hr class="uk-margin-small">
          <item-checkout
               bag_api="{{ route('persist.bag') }}"
            ></item-checkout>
        <hr class="uk-margin-small">
      </form>
    </div>
    <summary-checkout></summary-checkout>
  </div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script type="text/javascript">
  $(function () {

    $('#card-number').mask("9999-9999-9999-9999");
    $('#expired-date').mask("99/99");

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
       var url = '{{ route('checkout.billing') }}';
       if (submit == 'C O N T I N U E') {
         $('#submit').click();
       } else {
         window.location.href = url;
       }
   
    });

    $('#modal-submit').on('click', function () {
      $('#new-card').click();
    });
  });
</script>
@endsection