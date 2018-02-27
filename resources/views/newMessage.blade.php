@extends('layouts.app')

@section('content')

<div class="col-md-12" >

  <div style="background-color:#fff" class="col-md-3 pull-left">

    <div class="row" style="padding:10px">

       <div class="col-md-7">Jouw Vrienden</div>
       <div class="col-md-5 pull-right">
         <a href="{{url('/messages')}}" class="btn btn-sm btn-info">Berichten</a>
       </div>
    </div>

   @foreach($friends as $friend)

   <li @click="friendID({{$friend->id}})" v-on:click="seen = true" style="list-style:none;
    margin-top:10px; background-color:#F3F3F3" class="row">




  @if($friend->gender == '1')

    <div class="col-md-9 col-sm-9 pull-left" style="background-color:#539dcc;border-radius:5%;left:60px;" style="margin-top:5px"><img src="/uploads/avatars/{{ $friend->avatar }}" alt="User Image" class="chatImage">
      <b style="font-size:12pt;">{{$friend->User}}</b><br>
</div>
@else
        <div class="col-md-9 col-sm-9 pull-left" style="margin-top:5px;background-color:#ffbef7;border-radius:5%;left:60px;"><img src="/uploads/avatars/{{ $friend->avatar }}" alt="User Image" class="chatImage">
          <b style="font-size:12pt;">{{$friend->User}}</b><br>
    </div>
   @endif
   </li>
   @endforeach
   <hr>
  </div>



  <div style="background-color:#fff; min-height:600px; border-left:5px solid #F5F8FA"
   class="col-md-6">
   <h3 align="center">Berichten</h3>
<p class="alert alert-success">@{{message}}</p>

   <div  v-if="seen">
      <input type="text" v-model="friend_id">
      <textarea class="col-md-12 form-control" v-model="newMessageFrom" style="resize:none;height:100px;"></textarea><br><br><br><br><br>
      <input type="button" value="verstuur" @click="sendNewMessage()">
  </div>

  </div>

  <div style="background-color:#fff; min-height:600px; border-left:5px solid #F5F8FA"
  class="col-md-3 pull-right">
   <h3 align="center">Info</h3>
   <hr>
  </div>

</div>


@endsection
