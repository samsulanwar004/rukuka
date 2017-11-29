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
                  Credit or debit card number <br>
                  <div class="uk-inline">
                    <span class="uk-form-icon uk-form-icon-flip"><img src="/images/default_card.png" id="card-img-modal"></span>
                    <input class="uk-input uk-input-small" name="card_number" id="card-number-modal" type="text" required="required">
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
                    <input class="uk-input uk-input-small" name="expired_date" id="expired-date-modal" type="text" required="required">
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
                    <input class="uk-input uk-input-small" name="name_card" id="form-s-tel" type="text" required="required">
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
                <input type="submit" id="submit" style="display: none">
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
            <div class="uk-inline">
              <span class="uk-form-icon uk-form-icon-flip"><img src="/images/default_card.png" id="card-img"></span>
              <input class="uk-input uk-form-small uk-form-width-medium" name="card_number" id="card-number" type="text" required="required" value="{{ old('card_number') }}">
            </div>
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
                <a href="#modal-address" class="uk-text-meta" uk-toggle> <span class="uk-icon" uk-icon="icon: plus"></span> ADD YOUR SHIPPING OPTION </a>
              </div>
            </div>
          </div>
          <div id="modal-address" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-header">
                  <h4 class="uk-modal-title">ADD A NEW ADDRESS</h4>
              </div>
              <div class="uk-modal-body">
                <form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout_address_billing" value="ok">
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
                  <input type="submit" id="submit-address" style="display: none">
                  </form>
              </div>
              <div class="uk-modal-footer uk-text-right">
                  <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                  <button class="uk-button uk-button-secondary" id="modal-submit-address">Save</button>
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
            <li>{{ $defaultAddress->company }}</li>
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
<script src="{{ elixir('js/creditcard.js') }}"></script>
<script type="text/javascript">
  $(function () {
    var is_found = "{{ count($creditcards) }}";

    $('#expired-date').mask("99/9999");
    $('#expired-date-modal').mask("99/9999");

    if (is_found > 0) {
      $('#card-number-modal').validateCreditCard(function(result) {
        var card = result.card_type == null ? '' : result.card_type.name;
        if (result.valid) {
          $('#submit').removeAttr('disabled');
          $('#modal-submit').removeAttr('disabled');
        } else {
          $('#submit').attr('disabled', 'disabled');
          $('#modal-submit').attr('disabled', 'disabled');
        }

        if (card == 'visa') {
          $('#card-img-modal').attr('src', '/images/visa.png');
        } else if (card == 'mastercard') {
          $('#card-img-modal').attr('src', '/images/mastercard.png');
        } else if (card == 'discover') {
          $('#card-img-modal').attr('src', '/images/discover.png');
        } else {
          $('#card-img-modal').attr('src', '/images/default_card.png');
        }
      });
    }

    $('#card-number').validateCreditCard(function(result) {
      var card = result.card_type == null ? '' : result.card_type.name;
      if (result.valid) {
        $('#submit').removeAttr('disabled');
        $('#modal-submit').removeAttr('disabled');
        if (is_found <= 0) {
          $('#continue').removeAttr('disabled');
        }
      } else {
        $('#submit').attr('disabled', 'disabled');
        $('#modal-submit').attr('disabled', 'disabled');
        if (is_found <= 0) {
          $('#continue').attr('disabled', 'disabled');
        }
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

    $("#continue").on('click', function (e) {
       e.preventDefault();
       var submit = $('#submit').val();
       var url = '{{ route('checkout.review') }}';
       if (submit == 'C O N T I N U E') {
         $('#submit').click();
       } else {
         window.location.href = url;
       }
   
    });

    $('#modal-submit').on('click', function () {
      $('#submit').click();
    });

    $('#modal-submit-address').on('click', function () {
      $('#submit-address').click();
    });
  });
</script>
@endsection