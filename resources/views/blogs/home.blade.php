@extends('app')

@section('content')
    <div class="uk-container uk-container-small">
        <div class="uk-margin-top uk-margin-bottom">
            {{ Html::image('http://iscaprobus.co.uk/wp-content/uploads/2016/05/book.jpg','alt_image', array( 'width' => 1200, 'height' => 300 )) }}
        </div>

        <div class="uk-grid-small uk-grid-match uk-child-width-expand@s uk-text-justify" uk-grid>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="uk-text-bold">CONTENT</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Womens</a></li>
                    <li><a href="#">Mens</a></li>
                    <li><a href="#">Crewcuts</a></li>
                </ul>
            </div>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="uk-text-bold">FEATURES</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">How Its Done</a></li>
                    <li><a href="#">Behind The Design</a></li>
                    <li><a href="#">How I Got UPS</a></li>
                </ul>
            </div>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="uk-text-bold">DISCOVER</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">The Stripes Index</a></li>
                    <li><a href="#">Ku Ka Style Hacks : Desk To Dinner</a></li>
                </ul>
            </div>
            <div>
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="uk-text-bold">TAGS</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <h2 class="uk-heading-line uk-text-center"><span>Top Stories</span></h2>
        <div id="load-data" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
            @foreach($posts as $post)
                <div class="uk-width-1-3@m uk-width-1-2@s uk-inline">
                <div class="uk-inline">
                    <div class="uk-inline-clip uk-transition-toggle uk-light">
                        <a href="#" class="uk-link-reset">
                            <img src="/{{ $post->photo_1 }}" alt="{{$post->title}}">
                            <div class="uk-card uk-position-bottom-left uk-card-small">
                                <div class="uk-card-body">
                                    <div class="uk-transition-slide-left-small">
                                        <h1 class="uk-margin-remove uk-text-bold uk-text-justify blog-heading">{{$post->title}}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
                <div id="remove-row" class="uk-align-center">
                    <button onclick="myFunction({{ $post->id }})" id="btn-more" class="uk-button uk-button-default" > Load More </button>
                </div>
        </div>
    </div>

    <script type="text/javascript">

        function myFunction(id) {
                $("#btn-more").html("Loading....");
                $.ajax({
                    url : '{{ url("blog") }}',
                    method : "POST",
                    data : {id:id, _token:"{{csrf_token()}}"},
                    dataType : "text",
                    success : function (data)
                    {
                        if(data != '')
                        {
                            $('#remove-row').remove();
                            $('#load-data').append(data);
                        }
                        else
                        {
                            $('#btn-more').html("No Data");
                        }
                    }
                });
            }

    </script>


@endsection

