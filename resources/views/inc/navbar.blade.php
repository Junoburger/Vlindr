<nav class="navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
           @if (Auth::guest())
            <a class="navbar-brand" href="{{ url('/') }}">
               <img src="/images/Vlindr-logo.png" class="logo">
            </a>
        </div>

           @else
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
               <img src="/images/Vlindr-logo.png" class="logo">
            </a>
        </div>
@endif

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
@if (Auth::guest())
            <ul class="nav navbar-nav">
              <li><a href="/">Begin</a></li>
              <li><a href="/about">Over Vlindr</a></li>
              <li><a href="/future">Toekomst</a></li>
              <li><a href="/volunteer">Vrijwilligers</a></li>
              <li><a href="/posts">Blog</a></li>
            </ul>
@else

            <ul class="nav navbar-nav">
              <li><a href="/dashboard">Nieuws</a></li>



              <li><a href="/forums">Forum</a></li>

                            <li><a href="/requests"><b  style="background-color:red;padding:1px 2px 1px 2px;border-radius:40%;margin-left:-5px;top:-5px;position:relative;z-index:10;">
                            {{App\Friendships::where('status', 0)->where('recipient_id', Auth::user()->id)->count()}}</b> Verzoeken<i class="notify-nav" aria-hidden="true"></i></a></li>



              <li><a href="/matches"><i class="matches-nav" aria-hidden="true"></i>Matches</a></li>
              <li><a href="/garden"><i class="vlindr-nav" aria-hidden="true"></i>  Vlindrtuin</a></li>
              <li><a href="/friends"><i class="fa fa-users" aria-hidden="true"></i> Vrienden</a></li>
              <li><a href="/messages">chat</a></li>




            </ul>


@endif
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Aanmelden</a></li>
                    <li><a href="{{ route('register') }}">Word Lid</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; position:absolute; top:5px; left:-45px; border-radius:40%;background-color:white;">
                            {{ Auth::user()->User }} <span class="caret"></span>


                            <span class="badge"
                                          style="background:red; position: relative; top: -3px; left:5px">  <i class="fa fa-globe fa-1x" aria-hidden="true"></i>

                                 {{App\notifications::where('status', 1)
                                     ->where('user_hero', Auth::user()->id)
                                      ->count()}}
                                                    </span>
                 </a>
                            <?php
                                   $notes = DB::table('users')
                                        ->leftJoin('notifications', 'users.id', 'notifications.user_logged')
                                    ->where('user_hero', Auth::user()->id)
                                    ->where('status', 1) // unread
                                           ->orderBy('notifications.created_at', 'desc')
                                    ->get();
                             ?>





                        <ul class="dropdown-menu" role="menu">

<br>

                            <li><a style="font-size:14pt !important;" href="/profiles/profile">Mijn Profiel </a></li><br>
                            <li>
                                <a style="font-size:14pt !important;" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Afmelden
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
<hr style="border: dashed royalblue 1px;">

                                                                                        @foreach($notes as $note)
                                  <div class="RQST-accept">
                                          <a href="{{url('/notifications')}}/{{$note->id}}">
                                            @if($note->status==1)
                                        <li style=" padding:5px">
                                          @else
                                          <li style="padding:5px">
                                            @endif
                                         <div class="row">

                                          <div class="col-md-2">
                                            <img src="/uploads/avatars/{{ $note->avatar }}"
                                             style="width:50px; padding:6px; background:#fff; border:1px solid #eee" class="img-rounded">

                                          </div>

                                        <div class="col-md-10">

                                         <b style="color:darkgreen; font-size:90%;  border: none;">{{ucwords($note->User)}}</b>
                                          <span class="RQST-accept" style="color:#000; font-size:90%;padding-left:6px;">{{$note->note}} <i class="fa fa-globe fa-1x" aria-hidden="true"></i></span>
                                          <br/>
                                          <small style="color:green"> <i aria-hidden="true" class="fa fa-users"></i>
                                            {{date('F j, Y', strtotime($note->created_at))}}
                                          at {{date('H: i', strtotime($note->created_at))}}</small>
                                        </div>

                                        </div>
                                        </li></a></div>
                                       @endforeach

                                </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
