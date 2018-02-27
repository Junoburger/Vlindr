
@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row">

                @if (Auth::user()->id == $user->id)

                    <div class="profile">
        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="User Image" class="profile-image" style="width:200px !important; height: 200px !important;">

        <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info edit-profile"><i class="fa fa-pencil" aria-hidden="true"></i> Mijn profiel bewerken</a>
        </div>


                        @else

        <div class="profile">
        <img src="/uploads/avatars/{{$user->avatar }}" alt="User Image" class="profile-image" style="width:200px !important; height: 200px !important;">
        <h3 style="float:left;position:relative;left:-180px;top:120px;">{{$user->User}}</h3>
        <friend :profile_user_id="{{ $user->id }}" style="position:relative;left:-30px;top:100px;">

        </friend>

        </div>


                                @endif
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h1>Over <b>{{$user->User}}</b></h1></div>

                                        <div class="panel-body">


                                          <p class="text-center" >
                                          {{ $user->profile->about }}
                                          </p>

                                          <hr>
                                          <h2><b>{{$user->User}}'s</b> favoriete bezigheden</h2>
                                          <p class="text-center" >
                                            {{ $user->profile->passion }}
                                          </p>
                                          <hr>

                                          <h5 style=""><b>{{$user->User}}</b> woont in {{ $user->profile->location }}</h5>
                                          <div class="col-md-10 col-md-offset-1"><br>
                                        <h1 class="gardenHeader"><b>{{$user->User}}'s  Profiel</b></h1>

                                              </div>
                                              </div>
                                            </div>
                                    </div></div>

</div>



@endsection
