@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <b>MY ADDRESS</b>
			<hr class="uk-margin-small">
      <p>Hi, <b>{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}</b>, create your address by input and save. <br>
      </p>
      <p>
        @if (count($address))
        <div class="uk-overflow-auto">
          <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog">
              <button class="uk-modal-close-default" type="button" uk-close></button>
              <div class="uk-modal-header">
                  <h4 class="uk-modal-title">ADD A NEW ADDRESS</h4>
              </div>
              <div class="uk-modal-body">
                <form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
                  {{ csrf_field() }}
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
                  <input type="submit" id="submit" style="display: none">
                  </form>
              </div>
              <div class="uk-modal-footer uk-text-right">
                  <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                  <button class="uk-button uk-button-secondary" id="modal-submit">Save</button>
              </div>
            </div>
          </div>
          <address-list
            address="{{ $address }}"
            address_default="{{ route('user.address.default') }}"
            address_destroy="{{ route('user.address.destroy') }}"
          ></address-list>
        </div>        
        @else
          <h4>ADD A NEW ADDRESS</h4>
         	<form class="uk-form-stacked" action="{{ route('user.address') }}" method="post">
          		{{ csrf_field() }}
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
              	<div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                      <input type="submit" name="save" class="uk-button uk-button-secondary" value="save">
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

<script type="text/javascript">
	$(function () {
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

    $('#modal-submit').on('click', function () {
      $('#submit').click();
    });
	});

</script>
@endsection
