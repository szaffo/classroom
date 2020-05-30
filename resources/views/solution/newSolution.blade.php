@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       Megoldás beadása
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="ui grid">

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Tárgy neve</span></div>
                                <div class="twelve wide left aligned column">{{$task->subject->name}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Tanár</span></div>
                                <div class="twelve wide left aligned column">{{$task->subject->teacher->name}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Feladat</span></div>
                                <div class="twelve wide left aligned column">{{$task->name}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Feladat leírása</span></div>
                                <div class="twelve wide left aligned column">


                                    <div class="ui accordion">
                                        <div class="title active">
                                            <i class="dropdown icon"></i>
                                            A feladat leírása
                                        </div>
                                        <div class="content active">
                                            <p class="transition visible" style="display: block !important;">{{$task->description}}</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Pontszám</span></div>
                                <div class="twelve wide left aligned column">{{$task['value']}}</div>
                            </div>

                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Határidő</span></div>
                                <div class="twelve wide left aligned column">{{$task['start']}} - {{$task['deadline']}}</div>
                            </div>

                            <div class="ui divider"></div>
                            <div class="row">
                                <div class="sixteen wide column">
                                    <form method="POST" action="">
                                        @csrf

                                        <input type="hidden" name="taskId" id="taskId" value="{{old('taskId', $taskId)}}">
                                        <input type="hidden" name="subjectId" id="subjectId" value="{{old('subjectId', $task->subject->id)}}">

                                        <div class="form-group row">
                                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Megoldás szövege') }}</label>

                                            <div class="col-md-6">
                                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="3" name="content" autocomplete="content">{{{ old('content') }}}</textarea>
                                                @error('content')
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
    </div>
@endsection

