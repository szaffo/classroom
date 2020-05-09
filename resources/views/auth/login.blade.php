@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Belépés') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail cím') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Emlékezzen rám') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="ui submit button primary">
                                    {{ __('Belépés') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card" style="margin-top: 40px">
                <div class="card-header">Statisztika</div>

                <div class="card-body">
                    <div class="ui grid stackable">
                        
                        <div class="row">
                            <div class="eight wide column">
                                <div class="ui grid">
                                    <div class="row">
                                        <div class="eight wide right aligned column content"><span class="ui sub header">Tanárok</span></div>
                                        <div class="eight wide left aligned column">{{ DB::table('users')->where('teacher', '1')->count() }}</div>
                                    </div>


                                    <div class="row">
                                        <div class="eight wide right aligned column content"><span class="ui sub header">Diákok</span></div>
                                        <div class="eight wide left aligned column">{{ DB::table('users')->where('teacher', '0')->count() }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="eight wide column">
                                <div class="ui grid">
                                    <div class="row">
                                        <div class="eight wide right aligned column content"><span class="ui sub header">Feladatok</span></div>
                                        <div class="eight wide left aligned column">0</div>
                                    </div>

                                    <div class="row">
                                        <div class="eight wide right aligned column content"><span class="ui sub header">Megoldások</span></div>
                                        <div class="eight wide left aligned column">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
