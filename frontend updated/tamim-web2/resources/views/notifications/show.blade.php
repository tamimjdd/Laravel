@extends('layouts.app')

@section('content')
<div class="center">
    @foreach ($noti as  $notify)
        @if($notify->type=='App\Notifications\UserFollowed')
        <a href="/profile/{{ $notify->data['follower_id'] }}">{{ $notify->data['follower_name'] }} followed you at
             {{ date('jS M Y', strtotime($notify->updated_at)) }}</a>
        <hr>
        @elseif ($notify->type=='App\Notifications\NewPost')
        <a href="/p/{{ $notify->data['post_id'] }}">{{ $notify->data['following_name'] }} created a post
            {{ date('jS M Y', strtotime($notify->updated_at)) }}</a>
        <hr>
        @endif
    @endforeach
</div>
@endsection
