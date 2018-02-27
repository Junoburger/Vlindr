
@extends('layouts.app')

@section('content')

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <input placeholder="zoeken.."></input>

</div>


<div id="main">
<span onclick="openNav()" ondblclick="closeNav()" style="float:left;z-index:2;position:relative;top:10px;right:-5px;">
<img src="images/icons/Zoekn.png" width="40" style="cursor:pointer;font-size:12pt;">
</span>


<h1 class="gardenHeader"><b style="position:relative;left:0px;">De Vlindrtuin</b>
</h1>






<div class="gardenTable">

@if($users)


  @foreach($users as $user)

    @if($user->gender == '1')





        <div class="gardenElementMale"><a style="text-decoration: none;" href="/profiles/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage"></a>
        <a href=""><span title="Stuur een vlindr" class="send-vlindr"></span></a>
        <match :profile_user_id="{{ $user->id }}"></match>
        <friend  :profile_user_id="{{ $user->id }}"></friend>
        <a href="/profile/{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}}  &#9794;</h4></a></div>



@else






        <div class="gardenElementFemale"><a style="text-decoration: none;" href="/profiles/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage"></a>
        <a href=""><span title="Stuur een vlindr" class="send-vlindr"></span></a>
        <match :profile_user_id="{{ $user->id }}"></match>
        <friend :profile_user_id="{{ $user->id }}"></friend>
        <a href="/profile/{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}} ♀</h4></a></div>










      @endif
        @endforeach

        @endif



</div>
<span style="">{{$users->links()}}</span>
</div>
@endsection
