@extends('main')

@section('content')
<br><br><br>
<div class="grid-container">
    <div class="grid-x">
        <div class="small-6 small-offset-3 cell">
            <h2>Bejelentkezés</h2>
            <form class="ui form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="field @if($errors->has('email')) error @endif">
                    <label>E-mail cím</label>
                    <input  type="text" name="email" value="{{ old('email') }}" placeholder="E-mail cím">
                    @if($errors->has('email'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="field @if($errors->has('password')) error @endif">
                    <label>Jelszó</label>
                    <input type="password" name="password" placeholder="Jelszó">
                    @if($errors->has('password'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('password') }}
                        </div>                        
                    @endif                     
                </div>
                <div class="field">
                    <div class="ui checkbox">
                      <input class="hidden" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                      <label>Megjegyez</label>
                    </div>
                </div>
                <div class="grid-x">
                    <div class="cell medium-4">
                        <button type="submit" class="ui primary button">
                            Belépés
                        </button>
                    </div>
                    <div class="cell medium-8" style="line-height: 42px">
                        <a href="{{ route('password.request') }}">
                            Elfelejtette jelszavát?
                        </a>            
                    </div> 
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('javascript')
<script type="text/javascript">
    $('.ui.checkbox').checkbox();
</script>
@endpush
