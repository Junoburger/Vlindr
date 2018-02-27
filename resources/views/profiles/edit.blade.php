
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1"><br>
<h1 class="gardenHeader"><b>Mijn profiel bewerken </b></h1>
<div class=""panel-body>
                         @if ( session()->has('msg') )
                         <h3 class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </h3>
                                @endif

                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="avatar">Profielfoto Wijzigen</label>
                              <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>



                            <div class="form-group">

                            <label for="location">Uw locatie</label>
                            <input type="text" name="location" value="{{ $info->location }}" class="form-control" >

                            </div>


                            <div class="form-group">

                            <label for="about">Over mij</label>
                            <textarea name="about" id="about" cols="30" rows="5" class="form-control" maxlength="355" required>{{ $info->about }}</textarea>

                            </div>


                                                        <div class="form-group">

                                                        <label for="about">Mijn hobbies, passies en interesses</label>
                                                        <textarea name="passion" id="passion" cols="30" rows="5" class="form-control" maxlength="355" required>{{ $info->passion }}</textarea>

                                                        </div>


                            <div class="form-group">

                            <p class="text-center">

                            <button class="btn btn-sm btn-md btn-lid" type="submit">
                            Bewerkingen opslaan
                            </button>

                            </p>

                            </div>

</form>


</div>
</div>
</div>
</div>
@endsection
