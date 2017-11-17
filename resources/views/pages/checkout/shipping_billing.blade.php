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
      <span class="uk-text-meta"><b>ENTER YOUR CARD DETAILS:</b></span>
      <hr class="uk-margin-small">
      <div class="uk-text-meta">
        <div>
          Card Number *<br>
          <input type="text" name="" value="" class="uk-input uk-form-small uk-form-width-medium">
        </div>
        <div class="uk-margin-small-top">
          Security Code *<br>
          <input type="text" name="" value="" class="uk-input uk-form-small uk-form-width-small"> <a href="#"> <i>What is this?</i> </a>
        </div>
        <div class="uk-margin-small-top">
          Expiration Date * <br>
          <select class="" name="">
            <option value="1">Month</option>
          </select>
          /
          <select class="" name="">
            <option value="1">Year</option>
          </select>
        </div>
        <div class="uk-margin-small-top">
          Name on Card *<br>
          <input type="text" name="" value="" class="uk-input uk-form-small uk-form-width-medium">
        </div>

      </div>
      <div class="uk-margin">
        <input type="submit" name="" value="C O N T I N U E" class="uk-button uk-button-small uk-button-danger uk-width-1-3">
      </div>
      <hr class="uk-margin-small">
      <span class="uk-text-meta"><b>CHOOSE A BILLING ADDRESS:</b></span>
      <hr class="uk-margin-small">
      <form action="{{ route('user.address.default') }}" method="post">
              {{ csrf_field() }}
        <div class="uk-grid" uk-grid>
          @foreach($address as $add)
            <div class="uk-width-1-3">
              <div id="uk-card" class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
                <div class="uk-card-body">
                  <table>
                    <tr>
                      <td>
                        <input class="uk-checkbox" type="checkbox" name="billing" {{ (bool)$add->is_default ? 'checked' : '' }} value="{{ $add->id }}">
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
                        {{ (bool)$add->is_default ? 'Same as shipping address' : '' }}
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
                <a href="#" class="uk-text-meta"> <span class="uk-icon" uk-icon="icon: plus"></span> ADD YOUR SHIPPING OPTION </a>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="shipping" value="ok">
        <button type="submit" id="default-submit" style="display: none;"></button>
        <hr class="uk-margin-small">
        <span class="uk-text-meta"><b>SHIPPING DETAILS</b></span>
        <hr class="uk-margin-small">
        <div>
          <ul class="uk-list uk-text-meta">
            <li>Joko Susilo</li>
            <li>Ku Ka</li>
            <li>Yogyakarta</li>
            <li>Kota Gede</li>
            <li>Yogyakarta, Indonesia 55872</li>
            <li>Indonesia</li>
            <li>087839525707</li>
          </ul>
        </div>
        <hr class="uk-margin-small">
        <span class="uk-text-meta"><b>ITEMS (3)</b></span>
        <hr class="uk-margin-small">
      </form>
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
          <a href="{{ route('checkout.shipping') }}" class="uk-button uk-button-small uk-button-danger uk-width-1-1">C O N T I N U E</a>
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
    });
  });
</script>
@endsection