@extends('layouts.app')

@section('content')
    <h1>Berichten</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small><h5><b>Geschreven op:</b></h5> {{$post->created_at}}<br><h5><b>door:</b></h5> {{$post->user->User}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>Geen berichten..</p>
    @endif
@endsection
