           <div class="container">

            <ul class="navbar-header">
                &nbsp;
            </ul>
@if (Auth::guest())
            <ul class="nav navbar-nav new-footer">
              <li><a style="font-size:8pt !important; color: black !important;" href="/contact">Contact</a></li>
              <li><a style="font-size:8pt !important; color: black !important;" href="#">Algemene Voorwaarden</a></li>
              <li><a style="font-size:8pt !important; color: black !important;" href="#">Disclaimer</a></li>
              <li><a style="font-size:8pt !important; color: black !important;" href="#">Help</a></li>
            </ul>

@else




@endif
 </div>
</nav>
