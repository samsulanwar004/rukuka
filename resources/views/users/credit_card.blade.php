@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <b>MY PAYMENT METHOD</b>
			<hr class="uk-margin-small">
      <p>Hi, <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b>, create your payment method by input and save. <br>
      </p>
      <p>
      @if (count($cards))
        <div class="uk-overflow-auto">
          <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-header">
                  <h4 class="uk-modal-title">ADD A NEW CARD</h4>
              </div>
              <div class="uk-modal-body">
                <form class="uk-form-stacked" action="{{ route('user.cc') }}" method="post">
                  {{ csrf_field() }}
                  <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    Credit or debit card number <span id="card"></span>
                      <input class="uk-input uk-input-small" name="card_number" id="card-number" type="text" required="required">
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
                      <input class="uk-input uk-input-small" name="expired_date" id="expired-date" type="text" required="required">
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
          <credit-card
            credits="{{ $cards }}"
            credit_default="{{ route('user.cc.default') }}"
            credit_destroy="{{ route('user.cc.destroy') }}"
            credit_edit="{{ route('user.cc.edit') }}"
            credit_update="{{ route('user.cc.update') }}"
            address="{{ $address }}"
          ></credit-card>
        </div>        
      @else
            <p class="uk-text-meta"><b>Please Note : </b> We only accept Visa and MasterCard for international orders shipping</p>
            <p><img src="/images/sprite-payment.png" alt="" width="300"><br>
         	<form class="uk-form-stacked" action="{{ route('user.cc') }}" method="post">
          		{{ csrf_field() }}
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
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                      <input type="submit" name="save" class="uk-button uk-button-secondary" value="save"> <a href="{{ route('user.address') }}" class="uk-button uk-button-default">New Address</a>
                  </div>
              </div>
            </form>
            </p>
          </p>
      @endif
      </p>
    </div>
</div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script src="{{ elixir('js/creditcard.js') }}"></script>
<script type="text/javascript">
	$(function () {

      $('#card-number').validateCreditCard(function(result) {
        $('#card').html(result.card_type == null ? '' : result.card_type.name);
      });

      $('#card-number').mask("9999-9999-9999-9999");
      $('#expired-date').mask("99/99");

      $('#modal-submit').on('click',  function () {
        $('#submit').click();
      });
  })
</script>
@endsection
