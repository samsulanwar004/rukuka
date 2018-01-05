<div class="uk-section uk-section-muted uk-section-xsmall uk-visible@m">
  <div class="uk-container uk-container-small">
    <div class="uk-panel uk-grid" uk-grid>
      <div class="uk-width-1-5@m">
        <ul class="uk-nav uk-footer-nav">
          <li><b>LET US HELP YOU</b></li>
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
        <ul class="uk-nav uk-footer-nav">
          <li><b>ABOUT RUKUKA</b></li>
          <li><a href="{{ URL::to('page/our-story')}}">Our Story</a></li>
          <li><a href="{{ URL::to('page/social-responsibility')}}">Social Responsibility</a></li>
          <li><a href="{{ URL::to('page/investor-relation')}}">Investor Relations</a></li>
        </ul>

      </div>
      <div class="uk-width-1-5@m">
          <popular-search
          popular_search="{{ route('popular-search') }}"
          ></popular-search>
      </div>
      <div class="uk-width-2-5@m">
        <subcriber api="{{ route('subcriber') }}"></subcriber>
        <p class="uk-margin-large">
          <ul class="uk-nav uk-footer-nav">
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
    <span class="uk-text-meta">Copyright © 2017 rukuka.com - All Rights Reseved.</span>

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
