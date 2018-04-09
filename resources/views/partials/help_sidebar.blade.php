<div class="uk-width-1-4@m">
    <div class="uk-visible@m ">
        <ul class="uk-list uk-text-uppercase uk-text-meta">
            <li><h4>{{ trans('app.help_care') }}</h4></li>
            <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
            <li><a href="{{ URL::to('help/returns-exchanges') }}">{{ trans('app.returns_exchanges') }}</a></li>
            <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
            <li><a href="{{ URL::to('help/payment')}}">{{ trans('app.payment') }}</a></li>
            <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
            <li><a href="{{ route('payment.confirm')}}"> {{trans('app.confirm_payment') }}</a> </li>
            <li><a href="{{ URL::to('help/shipping-handling')}}">{{ trans('app.shipping_handling') }}</a></li>
            <br>
            <li><a href="{{ URL::to('page/about-us')}}">{{ trans('app.about_us') }}</a></li>
            <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
            <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
            <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
        </ul>
    </div>
    <div class="uk-hidden@m">
        <div uk-grid>
            <div class="uk-width-5-6 uk-text-left">
                <h4>{{ trans('app.help_care') }}</h4>
            </div>
            <div class="uk-width-1-6 uk-flex uk-flex-right">
                <a href="#" class="uk-icon uk-icon-link" uk-icon="icon: more"></a>
                <div uk-drop="mode: click; pos: bottom-right" style="width: 200px">
                    <div class="uk-card uk-background-muted uk-box-shadow-small uk-card-small">
                        <div class="uk-card-body">
                            <ul class="uk-list uk-text-uppercase uk-text-meta">
                                <li><a href="{{ URL::to('help/contact-us')}}">{{ trans('app.contact_us') }}</a></li>
                                <li><a href="{{ URL::to('help/returns-exchanges') }}">{{ trans('app.returns_exchanges') }}</a></li>
                                <li><a href="{{ URL::to('help/size-charts') }}">{{ trans('app.size_chart') }}</a></li>
                                <li><a href="{{ URL::to('help/payment')}}">{{ trans('app.payment') }}</a></li>
                                <li><a href="{{ route('tracking-page')}}"> {{trans('app.track_order') }}</a> </li>
                                <li><a href="{{ route('payment.confirm')}}"> {{trans('app.confirm_payment') }}</a> </li>
                                <li><a href="{{ URL::to('help/shipping-handling')}}">{{ trans('app.shipping_handling') }}</a></li>
                                <br>
                                <li><a href="{{ URL::to('page/about-us')}}">{{ trans('app.about_us') }}</a></li>
                                <li><a href="{{ URL::to('page/partners')}}">{{ trans('app.partners') }}</a></li>
                                <li><a href="{{ URL::to('page/careers')}}">{{ trans('app.careers') }}</a></li>
                                <li><a href="{{ URL::to('page/terms-privacy')}}">{{ trans('app.terms_privacy') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
