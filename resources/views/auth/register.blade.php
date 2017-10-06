@extends('main')

@section('content')
<br><br><br>
<div class="grid-container">
    <div class="grid-x">
        <div class="cell small-6 small-offset-3">
            <h2>Regisztráció</h2>
            <form class="ui form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="field @if($errors->has('firstname')) error @endif">
                    <label for="firstname">Név</label>
                    <input id="firstname" type="text" name="firstname" value="{{ old('firstname') }}" autofocus>
                    @if($errors->has('firstname'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('firstname') }}
                        </div>
                    @endif
                </div>

                <div class="field @if($errors->has('lastname')) error @endif">
                    <label for="lastname">Név</label>
                    <input id="lastname" type="text" name="lastname" value="{{ old('lastname') }}">
                    @if($errors->has('lastname'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('lastname') }}
                        </div>
                    @endif
                </div> 

                <div class="inline fields">                                        
                    <div class="field @if($errors->has('gender')) error @endif">                        
                        <div class="ui radio checkbox">
                            <input type="radio" name="gender" @if(old('gender') !== NULL AND old('gender') == 0) checked @endif value="0" class="hidden">
                            <label>Férfi</label>
                        </div>
                    </div>
                    <div class="field @if($errors->has('gender')) error @endif">
                        <div class="ui radio checkbox">
                            <input type="radio" name="gender" value="1" @if(old('gender') == 1) checked @endif class="hidden">
                            <label>Nő</label>
                        </div>
                        @if($errors->has('gender'))
                            <div class="ui basic red pointing prompt label transition visible">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>    
                </div>         

                <div class="field @if($errors->has('email')) error @endif">
                    <label for="email">E-mail cím</label>
                    <input id="email" type="text" name="email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="field @if($errors->has('password')) error @endif">
                    <label for="password">Jelszó</label>
                    <input id="password" type="password" name="password">
                    @if($errors->has('password'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                
                <div class="field @if($errors->has('password_confirmation')) error @endif">
                    <label for="password-confirm">Jelszó mégegyszer</label>
                    <input id="password-confirm" type="password" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                        <div class="ui basic red pointing prompt label transition visible">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>                

                                

                <div class="field">
                    <button class="ui primary button" type="submit">Regisztrálok</button>
                </div>               
            </form>
        </div>  
    </div>
</div>
@endsection

@push('javascript')
    <script type="text/javascript">
        $('.ui.radio.checkbox').checkbox();        
    </script>
@endpush