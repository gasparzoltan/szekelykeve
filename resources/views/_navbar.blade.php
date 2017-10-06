<div style="border-bottom: solid 1px #ddd; border-top: solid 1px #ddd; background-color: #fff">
  <div class="ui container">
    <div class="ui secondary  menu">
      <div class="item">
        <div class="ui logo shape">
          <div class="sides">
            <div class="active ui side">
              <h1 style="color: #444">Székelykeve</h1>
            </div>
          </div>
        </div>
      </div>
      <a class="item" href="/">
        Kezdőlap
      </a>
      <div class="right menu">
        <div class="item">
          <div class="ui icon input">
            <input type="text" placeholder="Search...">
            <i class="search link icon"></i>
          </div>
        </div>

        @guest
          <a href="{{ route('login') }}" class="ui item">Belépés</a>
          <a href="{{ route('register') }}" class="ui item">Regisztráció</a>
        @else
        <div class="ui dropdown item">
          <div class="text">{{ Auth::user()->firstname }}</div>
          <i class="dropdown icon"></i>
          <div class="menu">
            <div class="item">
              <span class="description"></span> 
              <i class="fa fa-user"></i>&nbsp;&nbsp;
               Profilom
            </div>
            <div class="divider"></div>
            <div class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i>&nbsp;&nbsp;
               Kilépés
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
            </div>            
          </div>
        </div>
        @endguest
      </div>
    </div>
  </div>
</div>