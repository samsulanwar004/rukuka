@extends('app-blog')

@section('content')

    @if($status['code'] == '000')
    <div class="uk-container uk-container-small">
      {{-- <h4 class="uk-margin-top">CATEGORIES!</h4> --}}
      <div class="uk-panel uk-margin-top">
        <div class="uk-card uk-card-border uk-card-small">
          <div class="uk-card-body">
            <ul class="uk-grid" uk-grid>
            @foreach($category as $value)
              <li><a href="{{ URL::to('blog/category/'.$value->slug)}}"><h3>{{$value->name}}</h3></a></li>
            @endforeach
            <li> <a href="#"> <h3>Winter</h3></a></li>
            <li> <a href="#"> <h3>Daily</h3> </a> </li>
            <li> <a href="#"> <h3>Party</h3> </a> </li>
            <li> <a href="#"> <h3>Beach</h3> </a> </li>
            <li> <a href="#"> <h3>Outdoor</h3> </a> </li>
            </ul>
          </div>
        </div>
      </div>
        <h3 class="uk-margin-small">{{$title}}</h3>
        <div id="blog" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
                <div class="uk-width-1-3@m uk-width-1-2@s uk-inline">
                    <div class="uk-inline">
                        <div class="uk-inline-clip uk-transition-toggle uk-light">
                            <a href="{{ URL::to('blog/'.$post->slug)}}" class="uk-link-reset">
                                <div style="background: rgba(0,0,0,.2);" class="uk-position-cover"></div>
                                @if(count($post->photo_1))
                                    <img src="/{{ $post->photo_1 }}" alt="{{$post->title}}">
                                @else
                                    {{ Html::image("images/blog-default.jpg") }}
                                @endif
                                <div class="uk-card uk-position-bottom-left uk-card-small">
                                    <div class="uk-card-body">
                                        <div class="uk-transition-slide-left-small">
                                            <h1 class="uk-margin-remove uk-text-bold blog-subtitle">{{$post->title}}</h1>
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
                    @if(count($posts) <= 9)
                        <a onclick="myFunction({{ $post->id }})" id="btn-more" class="uk-button uk-button-default" > LOAD MORE </a>
                    @endif
                </h2>
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
                            $('#remove-row').remove();
                            $('#blog').append(result.blog);
                            $('#loader').append(result.loader);
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
