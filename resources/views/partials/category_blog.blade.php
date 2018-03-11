<div class="uk-visible@m">
    <ul class="uk-grid" uk-grid>
        <li><a href="/editorial"><h5 class="uk-text-uppercase">{{ trans('app.all') }}</h5></a> </li>
        @foreach($category as $value)
            <li><a href="{{ URL::to('editorial/category/'.$value->slug)}}"><h5 class="uk-text-uppercase">{{$value->name}}</h5></a></li>
        @endforeach
        <li><a href="{{ URL::to('lookbook') }}"><h5 class="uk-text-uppercase">{{ trans('app.lookbook_title_category') }}</h5></a></li>
    </ul>
</div>
<hr class="uk-margin-remove-top uk-visible@m" style="border-color: #333; border-width: 5px">
<div class="uk-hidden@m uk-margin-small-top">
    <ul class="uk-grid uk-grid-small" uk-grid>
        <li><a href="/editorial">{{ trans('app.all') }}</a> </li>
        @foreach($category as $value)
            <li><a href="{{ URL::to('editorial/category/'.$value->slug)}}">{{$value->name}}</a></li>
        @endforeach
        <li><a href="{{ URL::to('lookbook/') }}">{{ trans('app.lookbook_title_category') }}</a></li>
    </ul>
</div>
<hr class="uk-margin-remove-top uk-hidden@m" style="border-color: #333; border-width: 3px">
<div class="uk-grid-small" uk-grid>
    <div class="uk-width-1-2">
        <div class="uk-panel">
            <h4 class="uk-margin-xsmall">{{$title}}</h4>
        </div>
    </div>
    <div class="uk-width-1-2">
        <div class="uk-panel uk-text-right">
            {{ Form::open(array('url' => 'search/editorial', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column uk-margin-small-top')) }}
            <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
            <input type="text" class=" uk-search-input" name="keyword"  placeholder="{{ trans('app.search') }}">
            {{ Form::close() }}
        </div>
    </div>
</div>