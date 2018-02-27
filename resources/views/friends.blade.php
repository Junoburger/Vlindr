@extends('layouts.app')

@section('content')
<br>
<h1 class="gardenHeader"><b>{{Auth::user()->User}}'s Vrienden</b></h1>

 

                     @if(count($friends) > 0)                                  


                        @foreach($friends as $user)

                        <div class="gardenTable" >
                            <div class="col-md-2 pull-left">
          @if($user->gender == '1')


        <div class="gardenElementMale" ><a style="text-decoration: none;" href="/profiles/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage">
        <a href=""><span title="Stuur een vlindr" class="send-vlindr"></span></a>
        <match :profile_user_id="{{ $user->id }}"></match> 
        <a href=""><span title="Chatten" class="chat" style="position:relative;float:right;top:-38px;left:-8px"></span></a>
        
          <a href="/profiles/profile{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}}  &#9794;</h4></a>
                                     

                                     <p>

                                         <a href="{{url('/unfriend')}}/{{$user->id}}" style="border-radius:10px;left:10px;top:10px;position:relative;" class="btn btn-default btn-sm buttn">Verwijder</a>

                                     </p>

                            
         </div>


@else


        <div class="gardenElementFemale" ><a style="text-decoration: none;" href="/profiles/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage">
        <a href=""><span title="Stuur een vlindr" class="send-vlindr"></span></a>
        <match :profile_user_id="{{ $user->id }}"></match> 
     <a href=""><span title="Chatten" class="chat" style="position:relative;float:right;top:-38px;left:-10px;"></span></a>
               
         <a href="/profiles/profile/{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}} &#9792;</h4></a>

                                     <p>

                                         <a href="{{url('/unfriend')}}/{{$user->id}}" style="border-radius:10px;left:10px;top:10px;position:relative;" class="btn btn-default btn-sm buttn">Verwijder </a>

                                     </p>

        
        </div>
     
     
      @endif
                            </div>



                        </div>
                        @endforeach

                        @else
                        <h1>Bekijk de <a href="/garden">Vlindrtuin</a> en vind jouw vrienden</h1>
                        @endif
                    </div>




           
   
    </div>


</div>
@endsection

