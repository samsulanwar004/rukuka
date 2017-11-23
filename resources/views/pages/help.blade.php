@extends('app')

@section('content')

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp

    @if($status['code'] == '000')
        <div class="uk-container uk-container-small uk-margin-top uk-margin-large-bottom">
          <div class="uk-flex uk-flex-center">
            <div class="uk-width-4-5@m">

              <div class="uk-text-justify uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>
                  <div class="uk-width-1-4">

                      <ul class="uk-nav uk-navbar-dropdown-nav uk-text-uppercase">
                          <li><h4>Lets us help you</h4></li>
                          <li><a href="{{ URL::to('help/order-status') }}">Order Status</a></li>
                          <li><a href="{{ URL::to('help/registration-qa') }}">Registration Q & A</a></li>
                          <li><a href="{{ URL::to('help/privacy-policy') }}">Privacy Policy</a></li>
                          <li><a href="{{ URL::to('help/contact-us') }}">Contact Us</a></li>
                          <br>
                          <li><a href="{{ URL::to('help/about-rukuka') }}">About Rukuka</a></li>
                          <li><a href="{{ URL::to('page/investor-relation') }}">Investor Relation</a></li>
                          <li><a href="{{ URL::to('help/term-of-use') }}">Term of Use</a></li>
                          <br>
                          <li><a href="{{ URL::to('help/payment-option') }}">Payment Option</a></li>
                          <li><a href="{{ URL::to('help/secure-ordering') }}">Secure Ordering</a></li>
                          <li><a href="{{ URL::to('help/order-verification') }}">Order Verification</a></li>
                          <li><a href="{{ URL::to('help/shipping-handling') }}">Shipping & Handling</a></li>
                          <li><a href="{{ URL::to('help/returns-exchanges') }}">Return & Exchange</a></li>
                          <li><a href="{{ URL::to('help/international-orders') }}">International</a></li>
                          <br>
                          <li><a href="{{ URL::to('help/size-charts') }}">Size Charts</a></li>
                      </ul>
                  </div>
                  <div class="uk-width-3-4">
                      <div class="scroll">
                          <h3>{!! $page[0]['title'] !!}</h3>
                          {!! $page[0]['content']!!}
                      </div>
                  </div>
              </div>
            </div>
          </div>

        </div>
    @else
        <div class="uk-container uk-container-small">
            <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
                <h1>No Content</h1>
            </div>
        </div>
    @endif
@endsection
