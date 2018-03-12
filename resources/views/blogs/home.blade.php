@extends('app_blog')
@section('title', trans('app.title_blog') )
@section('content')

    @if($status['code'] == '000')
    <div class="uk-container uk-container-small">
        @include('partials.category_blog')

        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
                <div class="uk-width-1-2 uk-inline">
                    <div class="uk-inline uk-visible-toggle">
                        <div class="uk-inline-clip uk-light">
                            <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                    <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-hidden@m">
                                            <div>
                                                <h5 class="uk-margin-remove uk-text-bold uk-text-small">{{$post->title}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                          <a href="{{ URL::to('editorial/'.$post->slug)}}" class="uk-link-reset">
                              <div class="uk-position-cover uk-background-default"></div>
                                  <img src="{{ uploadCDN($post->photo_1) }}" alt="{{$post->title}}" onerror="this.src = '{{imageCDN(config('common.default.image_7'))}}'">
                                    <div class="uk-visible@m">
                                        <div class="uk-position-top-left">
                                          <h4 class="uk-margin-remove">{{$post->category->name}}</h4>
                                            <h1 class="uk-margin-remove blog-title">{{$post->title}}</h1>
                                        </div>
                                        <div class="uk-position-bottom-right">
                                            <h4 class="uk-text-muted">{{date_format($post['created_at'],"F j, Y")}}</h4>
                                        </div>
                                    </div>
                                      <div class="uk-hidden@m">
                                          <div class="uk-position-bottom-left">
                                              <h4 class="uk-margin-remove uk-text-bold uk-text-small"><u>{{$post->title}}</u></h4>
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
                        <a onclick="myFunction({{ $post->id }})" id="btn-more" class="uk-button uk-button-default" > {{ trans('app.load_more') }} </a>
                    @endif
                </h2>
            </div>
        </div>
    </div>

    @else
        <div class="uk-container uk-container-small">
            @include('partials.category_blog')
            <div class="uk-section uk-section-default uk-section-xlarge uk-text-center">
                <h2>{{ trans('app.no_content') }}</h2>
            </div>
        </div>
    @endif
    <script type="text/javascript">

        function myFunction(id) {
                $("#btn-more").html("{{ trans('app.loading') }}");
                var pathArray = window.location.pathname.split( '/' );
                var segment_3 = pathArray[3];
                $.ajax({
                    url : '{{ url("editorial") }}',
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
