@extends('layouts.app')

@section('content')

<?php $avatar = DB::table('users')->where('avatar')->get();?>

<div class="col-md-12">

<div class="col-md-3" style="background-color:#fff;position:relative;left:-10px; ">
  <div class="pull-right"><a href="{{url('/newMessage')}}">
  <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="position:relative;top:20px;left:5px;"></i></a>
  </div>
<h3 align="center">Vrienden &amp; Matches</h3>

<ul v-for="privateMessage in privateMessages">
<li @click="messages(privateMessage.id)" style="list-style:none;margin-top:10px;background-color:#ddd;border-radius:5px;">

  <div class="col-md-3 pull-left">
       <img src=""
     style="width:50px; border-radius:100%; margin:5px">
   </div>

<b>@{{privateMessage.User}}</b>


</li>
</ul>
<hr>
</div>

<div class="col-md-7 " style="background-color:#fff;">
<h3 align="center">Bericht</h3>
<div v-for="singleMessage in singleMessages">

<div v-if="singleMessage.user_sender == <?php echo Auth::user()->id;?>">

                         <div style="float:right;background-color:#B4E8C1; padding:25px;margin:20px; text-align:right; color:black; border-radius:5px;
                         box-shadow:2px 5px 10px 1px lightgrey;" class="col-md-9">

                                                 <b>@{{singleMessage.user_sender}}</b>        @{{singleMessage.message}}
                                                 </div>
</div>
<div v-else>
                         <div style="float:left;background-color:#6CB8FF; padding:25px;margin:20px; color:#FFFEEB; border-radius:5px;
                         box-shadow:2px 5px 10px 1px lightgrey;" class="col-md-9">

                                                 <b>@{{singleMessage.user_sender}}</b>
                                                          @{{singleMessage.message}}
                                                 </div>
                                                 </div>

</div>
<hr>
<div style="margin-top:10px;" >
  <input type="text" v-model="conID" name="" value="">
<textarea class="col-md-12 from-control" v-model="messageFrom" @keydown="inputHandler" style=" border:none;resize:none;margin-top:15px;"></textarea>
</div>
</div>

<div class="col-md-2 " style="background-color:#fff;">
<h3 align="center">Info</h3>

<hr>
</div>
</div>
@endsection
