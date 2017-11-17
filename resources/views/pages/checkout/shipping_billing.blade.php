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
       <form action="{{ route('user.cc.default') }}" method="post">
          {{ csrf_field() }}
          <div class="uk-grid" uk-grid>
             @foreach($creditcards as $card)
             <div class="uk-width-1-3">
                <div class="uk-card uk-card-default uk-card-small uk-card-border uk-box-shadow-hover-large">
                   <div class="uk-card-body">
                      <table>
                         <tr>
                            <td>
                               <input class="uk-checkbox" type="checkbox" name="default[{{$card->id}}]" {{ (bool)$card->is_default ? 'checked disabled' : '' }}>
                            </td>
                            <td>
                               {{ $card->card_number }}
                            </td>
                         </tr>
                         <tr>
                            <td>
                            </td>
                            <td>{{ $card->expired_date }}</td>
                         </tr>
                         <tr>
                            <td>
                            </td>
                            <td>
                               {{ $card->name_card }}
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
                      <a href="#" class="uk-text-meta"> <span class="uk-icon" uk-icon="icon: plus"></span> ADD NEW CARD </a>
                   </div>
                </div>
             </div>
          </div>
          <input type="hidden" name="checkout" value="ok">
          <button type="submit" id="default-submit" style="display: none;"></button>
       </form>
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
                        <input class="uk-checkbox" type="checkbox" name="address" {{ (bool)$add->is_default ? 'checked' : '' }} value="{{ $add->id }}">
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
        <hr class="uk-margin-small">
      @endif
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
  });
</script>
@endsection