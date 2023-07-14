@extends('layouts.template')
@section('content')

    <div class="single">
        <div class="container">
            <div class="single-top">
                <a href="#"><img class="img-responsive" src="{{ asset($post->featured_image) }}" alt=" "></a>
                <div class=" single-grid" style="margin-bottom: 70px">
                    <h4>{{$post->title}}</h4>
                    <ul class="blog-ic">
                        <li><a href="#"><span> <i class="glyphicon glyphicon-user"> </i>{{$post->user->name}}</span>
                            </a></li>
                        <li><span><i class="glyphicon glyphicon-tag"> </i>{{$post->category->title}}</span>
                        </li>
                        {{--  <li><span><i class="glyphicon glyphicon-eye-open"> </i>Hits:145</span></li> --}}
                    </ul>
                    <p>{!!$post->content!!}</p>
                </div>
                <div class="comment-bottom heading">
                    <h3>Leave a Comment</h3>
                    @include('includes.alerts')
                    {{-- <form> --}}
                    {{Form::open(['url'=>'blog/post/'.$post->id.'/save-comment','method'=>'POST'])}}
                    {{-- <input type="text" value="Name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}"> --}}
                    {{Form::text('user_name',null,["placeholder"=>"Name"])}}
                    {{--  <input type="text" value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}"> --}}
                    {{Form::text('user_email',null,["placeholder"=>"Email"])}}
                    {{-- <textarea cols="77" rows="6" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea> --}}
                    {{Form::textarea('comment',null,["cols"=>"77","row"=>"6","placeholder"=>"Comment"])}}
                    <input type="submit" value="Send">
                    {{Form::close()}}
                    {{-- </form> --}}
                </div>
                <div class="comments heading">
                    <h3>Comments</h3>
                    @foreach($post->comments as $comment)
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">
                                    @if (!is_null($comment->user))
                                        {{$comment->user->name}}
                                    @else
                                        {{$comment->user_name}}
                                    @endif
                                    </h4>
                                <p>{{$comment->comment}} </p>
                            </div>
                            <div class="media-right">
                                <a href="#">
                                    <img src="images/si.png" alt=""> </a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection
