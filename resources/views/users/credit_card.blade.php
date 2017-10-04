@extends('app')

@section('content')
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <h3 class="uk-margin-remove uk-padding-remove">MY PAYMENT METHOD</h3>
      <p>Hi, <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b>, create your payment method by input and save. <br>
      </p>
      <p>
            <div class="uk-overflow-auto">
              <form action="{{ route('user.cc.default') }}" method="post">
                {{ csrf_field() }}
                <table class="uk-table uk-table-divider uk-table-hover uk-table-responsive uk-table-small">
                    <thead>
                        <tr>
                            <th class="uk-table-shrink">Default</th>
                            <th class="uk-width-medium">Card Number</th>
                            <th class="uk-width-medium">Expired Date</th>
                            <th class="uk-width-medium">Name Card</th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @forelse($cards as $card)
                        	<tr>
	                            <td><input class="uk-checkbox" type="checkbox" name="default[{{$card->id}}]" {{ (bool)$card->is_default ? 'checked disabled' : '' }}></td>
	                            <td class="uk-table-link">
	                                <a class="uk-link-reset" href="">{{ $card->card_number }}</a>
	                            </td>
	                            <td>{{ $card->expired_date }}</td>
	                            <td>{{ $card->name_card }}</td>
	                        </tr>
	                    @empty
	                    	<tr><td colspan="5"><center>no card</center></td></tr>
                        @endforelse
                    </tbody>
                    
                </table>
                <button type="submit" id="default-submit" style="display: none;"></button>
                </form>
            </div>
            <h4>ADD A NEW PAYMENT METHOD</h4>
            <p>Please note: We only accept Visa and MasterCard for international orders shipping</p>
            <p><img src="/images/sprite-payment.png" alt=""><br>
         	<form class="uk-form-stacked" action="{{ route('user.cc') }}" method="post">
          		{{ csrf_field() }}
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    Credit or debit card number
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
                    <b>enter a billing address</b>
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
      </p>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

<script type="text/javascript">
	$(function () {
      $('#card-number').mask("9999-9999-9999-9999");
      $('#expired-date').mask("99/99");

      $("input:checkbox").on('click', function() {
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
  })
</script>
@endsection