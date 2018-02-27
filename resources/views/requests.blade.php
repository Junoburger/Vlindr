
@extends('layouts.app')

@section('content')
<div class="container">
<br>
<h1 class="gardenHeader"><b>{{Auth::user()->User}}'s Vriendschapsverzoeken</b></h1>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </p>
                                @endif
                                
                     @if(count($FriendRequests) > 0)                                  

                        @foreach($FriendRequests as $user)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px;padding-bottom:10px;">
                            <div class="col-md-2 pull-left">
                                <a href="/profiles/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" width="80px" height="80px" class=""/>
                                </a>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="/profiles/profile/{{$user->id}}"><b>{{ucwords($user->User)}}</b></a></h3>



                    @if($user->gender == '1')
                                <p>Man</p>
                                @else
                     <p>Vrouw</p>
                         @endif
                                  




                            </div>

                            <div class="col-md-3 pull-right">

                                     <p>
                                        <a href="{{url('/accept')}}/{{$user->User}}/{{$user->id}}" style="position:relative;right:50px;top:10px;" class="btn btn-lid btn-lg">Bevestig Vriendschap</a>
<br><br>
                                         <a href="{{url('/requestRemove')}}/{{$user->id}}" style="position:relative;right:-150px;" class="btn btn-default btn-sm">Verwijder Verzoek</a>

                                     </p>

                            </div>

                        </div>
                        @endforeach
@else

<h1>Nog geen verzoeken</h1>
@endif
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>

@endsection