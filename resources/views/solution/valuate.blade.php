@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="ui grid">

                            <div class="sixteen wide column">

                               Megoldás értékelése
                            </div>


                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="ui grid">

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Feladat</span></div>
                                <div class="twelve wide left aligned column">
                                    <a href="{{route('taskProfile', $data->task->id)}}">{{$data->task->name}}</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Feladatra kapható pontszám</span></div>
                                <div class="twelve wide left aligned column">{{$data->task->value}} pont</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Tantárgy</span></div>
                                <div class="twelve wide left aligned column">
                                    <a href="{{route('subjectProfile', $data->task->subject->id)}}">{{$data->task->subject->name}}</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Beadta</span></div>
                                <div class="twelve wide left aligned column">{{$data->user->name}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Beadás időpontja</span></div>
                                <div class="twelve wide left aligned column">{{$data->created_at}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Feladat leírása</span></div>
                                <div class="twelve wide left aligned column">

                                    <div class="ui accordion">
                                        <div class="title ">
                                            <i class="dropdown icon"></i>
                                            A feladat leírása
                                        </div>
                                        <div class="content ">
                                            <p class="transition visible" style="display: block !important;">{{$data->task->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Megoldás szövege</span></div>
                                <div class="twelve wide left aligned column">{{$data->content}}</div>
                            </div>

                            @if ($data->file)
                                <div class="row">
                                    <div class="four wide right aligned column content"><span class="ui sub header">Megoldás fájl</span></div>
                                    <div class="twelve wide left aligned column">
                                        <a href="{{route('solutionDownload', $data->id)}}">{{$data->file}}</a>
                                    </div>
                                </div>
                            @endif

                            <div class="ui divider"></div>
                            <div class="row">
                                <div class="sixteen wide center aligned column">
                                    <form method="POST" action="{{route('valuatePost')}}">
                                        @csrf

                                        <input type="hidden" name="id" id="id" value="{{old('id', $data->id)}}">

                                        <div class="form-group row">
                                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Értékelés') }}</label>

                                            <div class="col-md-6">
                                                <input type="number" required  class="form-control @error('value') is-invalid @enderror" id="value" name="value" autocomplete="value" value="{{ old('value') }}">
                                                @error('value')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="valuateText" class="col-md-4 col-form-label text-md-right">{{ __('Megjegyzés az értékeléshez') }}</label>

                                            <div class="col-md-6">
                                                <textarea class="form-control @error('valuateText') is-invalid @enderror" id="valuateText" rows="3" name="valuateText" autocomplete="valuateText">{{{ old('valuateText') }}}</textarea>
                                                @error('valuateText')
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
        </div>
    </div>
@endsection
