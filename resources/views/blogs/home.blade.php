@extends('app-blog')

@section('content')

    @if($status['code'] == '000')
    <div class="uk-container uk-container-small">
      <div class="uk-panel uk-margin-top">
        <div class="uk-card uk-card-border uk-card-small">
          <div class="uk-card-body">
            <div class="uk-visible@m">
              <ul class="uk-grid" uk-grid>
              @foreach($category as $value)
                <li><a href="{{ URL::to('blog/category/'.$value->slug)}}"><h3>{{$value->name}}</h3></a></li>
              @endforeach
              </ul>
            </div>
            <div class="uk-hidden@m">
              <ul class="uk-grid" uk-grid>
              @foreach($category as $value)
                <li><a href="{{ URL::to('blog/category/'.$value->slug)}}"><h5>{{$value->name}}</h5></a></li>
              @endforeach
              </ul>
            </div>

          </div>
        </div>
      </div>
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-2">
                <div class="uk-panel uk-margin-small-top">
                    <h3 class="uk-margin-small">{{$title}}</h3>
                </div>
            </div>
            <div class="uk-width-1-2">
                <div class="uk-panel uk-text-right uk-margin-small-top">
                    {{ Form::open(array('url' => 'search/blog', 'method' =>'get','files' => true,'class' => 'uk-search uk-form-width-medium uk-first-column uk-margin-small-top')) }}
                    <button type="submit" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon></button>
                    <input type="text" class=" uk-search-input" name="keyword"  placeholder="S E A R C H . . .">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
                <div class="uk-width-1-3@m uk-width-1-2 uk-inline">
                    <div class="uk-inline">
                        <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                    <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_2'))}}'">
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-transition-slide-left-small uk-visible@m">
                                            <h1 class="uk-margin-remove uk-text-bold blog-subtitle">{{$post->title}}</h1>
                                        </div>
                                        <div class="uk-hidden@m">
                                            <h4 class="uk-margin-remove">{{$post->title}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="loader" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            <div id="remove-row" class="uk-align-center">
                <h2>
                    @if(count($posts) == 9)
                        <a onclick="myFunction({{ $post->id }})" id="btn-more" class="uk-button uk-button-default" > LOAD MORE </a>
                    @endif
                </h2>
            </div>
        </div>
    </div>

    @else
        <div class="uk-container uk-container-small">
            <div class="uk-panel uk-margin-top">
                <div class="uk-card uk-card-border uk-card-small">
                    <div class="uk-card-body">
                        <div class="uk-visible@m">
                            <ul class="uk-grid" uk-grid>
                                @foreach($category as $value)
                                    <li><a href="{{ URL::to('blog/category/'.$value->slug)}}"><h3>{{$value->name}}</h3></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="uk-hidden@m">
                            <ul class="uk-grid" uk-grid>
                                @foreach($category as $value)
                                    <li><a href="{{ URL::to('blog/category/'.$value->slug)}}"><h5>{{$value->name}}</h5></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="uk-margin-small">{{$title}}</h3>
            <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
                <h1>No Content</h1>
            </div>
        </div>
    @endif
    <script type="text/javascript">

        function myFunction(id) {
                $("#btn-more").html("Loading....");
                var pathArray = window.location.pathname.split( '/' );
                var segment_3 = pathArray[3];
                $.ajax({
                    url : '{{ url("blog") }}',
                    method : "POST",
                    data : {id:id,slug:segment_3,_token:"{{csrf_token()}}"},
                    dataType : "text",
                    success : function (data)
                    {
                        if(data != '')
                        {
                            var result = JSON.parse(data);
                            if(result.count < 9)
                            {
                                $('#remove-row').remove();
                                $('#blog').append(result.blog);
                                $('#loader').append(result.loader);
                                $('#remove-row').remove();
                            }
                            else{
                                $('#remove-row').remove();
                                $('#blog').append(result.blog);
                                $('#loader').append(result.loader);
                            }

                        }
                        else
                        {
                            $('#remove-row').remove();
                        }
                    }
                });
            }

    </script>


@endsection
