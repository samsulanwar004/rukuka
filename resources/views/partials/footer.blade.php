<div class="uk-section uk-section-muted uk-section-xsmall uk-visible@m">
  <div class="uk-container uk-container-small">
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-navbar-dropdown-nav">
          <li>LET US HELP YOU</li>
          <li><a href="{{ URL::to('help/order-status') }}">Order Status</a></li>
          <li><a href="{{ URL::to('help/shipping-handling') }}">Shipping & Handling</a></li>
          <li><a href="{{ URL::to('help/returns-exchanges') }}">Returns & Exchanges</a></li>
          <li><a href="{{ URL::to('help/international-orders') }}">International Orders</a></li>
          <li><a href="{{ URL::to('help/need-some-help') }}">Need Some Help</a></li>
          <li><a href="{{ URL::to('help/our-services') }}">Our Services</a></li>
          <li><a href="{{ URL::to('help/size-charts') }}">Size Charts</a></li>
        </ul>

      </div>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-navbar-dropdown-nav">
          <li>ABOUT RUKUKA</li>
          <li><a href="{{ URL::to('page/our-story')}}">Our Story</a></li>
          <li><a href="{{ URL::to('page/social-responsibility')}}">Social Responsibility</a></li>
          <li><a href="{{ URL::to('page/investor-relation')}}">Investor Relations</a></li>
        </ul>

      </div>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-navbar-dropdown-nav">
          <li>POPULAR SEARCHES</li>
          <li><a href="#">Cardigans</a></li>
          <li><a href="#">Blazers</a></li>
          <li><a href="#">Men's Sweaters</a></li>
          <li><a href="#">Business Casual For Women</a></li>
          <li><a href="#">Men's Suits</a></li>
        </ul>

      </div>
      <div class="uk-width-2-5@m">
        <subcriber api="{{ route('subcriber') }}"></subcriber>
        <p class="uk-margin-large">
          <ul class="uk-nav uk-navbar-dropdown-nav">
            <li>CONNECT WITH US</li>
          </ul>
        <ul class="uk-grid-small" uk-grid>
          <li><a class="uk-icon-link" uk-icon="icon: twitter"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: pinterest"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: facebook"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: google-plus"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: instagram"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: tumblr"></a></li>
          <li><a class="uk-icon-link" uk-icon="icon: mail"></a></li>
        </ul>
      </p>
      </div>
    </div>
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-3-5@m">
        <p>
          <ul class="uk-grid uk-text-meta" uk-grid>
            <li><a href="{{ URL::to('page/terms-and-conditions')}}">TERMS AND CONDITIONS</a></li>
            <li><a href="{{ URL::to('page/privacy-policy')}}">PRIVACY POLICY</a></li>

          </ul>
        </p>
      </div>

    </div>
  </div>
</div>
<div class="uk-section uk-section-default uk-section-xsmall uk-text-small uk-visible@m">
  <div class="uk-container uk-container-small uk-text-meta">
    Copyright © 2017 rukuka.com - All Rights Reseved.
  </div>
</div>
<div class="uk-section uk-section-muted uk-section-xsmall uk-text-small uk-hidden@m">
  <div class="uk-container uk-container-small uk-text-meta">
    <ul class="uk-grid" uk-grid>
      <li><a href="{{ URL::to('help/need-some-help')}}">Help!</a></li>
      <li><a href="{{ URL::to('page/terms-and-conditions')}}">Term & Conditions</a></li>
      <li><a href="{{ URL::to('page/privacy-policy')}}">Privacy & Policy</a></li>
    </ul>

    <p>Copyright © 2017 rukuka.com - All Rights Reseved.</p>
  </div>
</div>
