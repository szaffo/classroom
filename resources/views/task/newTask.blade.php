@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if ($data->origin == 'home')
                        Új feladat létrehozása
                    @else
                        Feladat szerkesztése
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('newTaskPost', $data->subjectId)}}">
                        @csrf

                        <input type="hidden" name="origin" id="origin" value="{{old('origin', $data->origin)}}">
                        <input type="hidden" name="id" id="id" value="{{old('id', $data->id)}}">
                        <input type="hidden" name="subjectId" id="subjectId" value="{{old('subjectId', $data->subjectId)}}">

                        <div class="form-group row">

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Feladat neve') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Feladat leírása') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" autocomplete="description">{{{ old('description', $data->description) }}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Feladatra kapható pontszám') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="number" min="0" class="form-control @error('value') is-invalid @enderror" name="value" required autocomplete="value"  value="{{ old('value', $data->value) }}">

                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Feladat kezdete') }}</label>

                            <div class="col-md-6">
                                <input id="start" type="date" min={{$data->start}} placeholder="0" class="form-control @error('start') is-invalid @enderror" name="start" required autocomplete="start" value="{{ old('start', $data->start) }}">
                                 @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">{{ __('Feladat határideje') }}</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" min={{$data->start}} placeholder="0" class="form-control @error('deadline') is-invalid @enderror" name="deadline" required autocomplete="deadline" value="{{ old('deadline', $data->deadline) }}">
                                 @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="ui button primary">
                                    {{ __('Elküld') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
