@extends('app')

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
          <a href="#" class="uk-button uk-button-text"><b>SHIPPING ADDRESS</b></a>
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
        @foreach($address as $add)
          <input type="radio"> {{ $add->first_name }} <br>
        @endforeach
      @else
        <span class="uk-text-meta">YOUR SHIPPING INFORMATION</span>
        <hr class="uk-margin-small">
        <div class="uk-grid uk-width-1-2@m">
          <form action="{{ route('user.address') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="shipping" value="ok">
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
            <input type="checkbox" class="uk-checkbox" name="is_billing" value="ok"> This address is also my billing address

            <p> <b>* Required</b> </p>
          </div>
          <div class="uk-text-meta uk-margin-small-top uk-width-1-1">
            <input type="submit" name="submit" value="C O N T I N U E" class="uk-button-danger uk-button uk-button-small uk-width-1-1">
          </div>
          </form>
        </div>
      @endif
    </div>
    <div class="uk-width-1-4@m">
      <div class="uk-card uk-card-border uk-card-default uk-card-small">
        <div class="uk-card-header">
          <b>SUMMARY</b>
        </div>
        <div class="uk-card-body">
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small"><b>SUBTOTAL</b></div>
            <div class="uk-text-right">{{ subtotal }}</div>
          </div>
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small">Shipping Cost</div>
            <div class="uk-text-right">FREE</div>
          </div>
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div class="uk-text-small">Tax</div>
            <div class="uk-text-right">FREE</div>
          </div>
        </div>
        <div class="uk-card-footer">
          <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
            <div><b>TOTAL</b></div>
            <div class="uk-text-right">{{ subtotal }}</div>
          </div>
        </div>

        </div>
        <div class="uk-panel uk-margin-small-top">
          <input type="submit" class="uk-button uk-button-small uk-button-danger uk-width-1-1" name="checkout" value="C O N T I N U E">
        </div>
        <hr>
        <div class="uk-card uk-card-default uk-card-border uk-card-small">
          <div class="uk-card-header">
            PROMO CODE
          </div>
          <div class="uk-card-body">

          </div>
        </div>
      </div>
    </div>

  </div>

  <hr>
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-top">
    <div class="uk-panel uk-text-center">
      <h3>RELATED PRODUCTS</h3>
    </div>
  </div>
  <related api="{{ route('related', ['categoryId' => '2']) }}"></related>
  <div class="uk-grid-small uk-margin-small-bottom uk-margin-medium-top uk-margin-xlarge-bottom">
    <div class="uk-panel uk-text-center">
      <button class="uk-button uk-button-secondary">SHOW ALL PRODUCT</button>
    </div>
  </div>
</div>
@endsection
