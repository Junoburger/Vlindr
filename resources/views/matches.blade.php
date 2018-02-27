@extends('layouts.app')

@section('content')
<br>
<h1 class="gardenHeader"><b>{{Auth::user()->User}}'s Matches</b></h1>

 

                     @if(count($matches) > 0)                                  


                        @foreach($matches as $user)

                        <div class="gardenTable" >
                            <div class="col-md-2 pull-left">
          @if($user->gender == '1')

        <div class="gardenElementMale" ><a style="text-decoration: none;" href="/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage">
        <a href=""><span title="Chatten" class="chat" style="top:145px !important;left:60px !important;">   </span></a>
        
          <a href="/profiles/profile/{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}}  &#9794;</h4></a>
                                     

                                     <p>


                                     </p>

                            
         </div>


@else

                <div class="gardenElementFemale" ><a style="text-decoration: none;" href="/profile/{{$user->id}}"><img src="/uploads/avatars/{{ $user->avatar }}" alt="User Image" class="gardenImage">

                 <a href=""><span title="Chatten" class="chat" style="top:145px !important;left:60px !important;"></span></a>
                 <a href="/profiles/profile/{{$user->id}}" style="text-decoration:none;"><h4 class="gardenName">{{$user->User}} &#9792;</h4></a>

                                     <p>


                                     </p>

        
        </div>
     
     
      @endif
                            </div>



                        </div>
                        @endforeach

                        @else
                        <h3 style="padding:10px;">Bekijk de <a href="/garden">Vlindrtuin</a> en vind iemand die je leuk vind, klik op het hartje -><img src="/images/icons/heartvlindr.png" width="40"> en wacht af..<br> of stuur een Vlindr ->
                        <img src="/images/icons/vlindrt.png" width="40" height="35"> en laat die ene leuke man of vrouw weten dat jij geïnteresseerd ben.</h3>
                        @endif
                    </div>




           
   
    </div>


</div>
@endsection

