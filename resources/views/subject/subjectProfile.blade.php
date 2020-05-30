@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="ui grid">

                            <div class="eight wide column">
                                <div class="content">
                                    {{$data['name']}}
                                    <div class="ui sub header">{{$data['code']}}</div>
                                </div>
                            </div>

                            <div class="eight wide right aligned column">
                                @if (Auth::user()->teacher)
                                    <a class="positive basic ui button" href={{route('newTaskForm', $data['id'])}}>Új feladat</a>
                                    <a class="positive basic ui button" href={{route('subjectEdit', $data['id'])}}>Módosítás</a>
                                    <a class="negative basic ui button" href={{route('subjectDelete', $data['id'])}}>Törlés</a>
                                @else
                                    @if (Auth::user()->isSubscribedTo($data))
                                        <a class="negative basic ui button" href={{route('unSubscribe', $data['id'])}}>Leiratkozás</a>
                                        @else
                                        <a class="purple basic ui button" href={{route('subscribe', $data['id'])}}>Feliratkozás</a>
                                    @endif
                                @endif
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
                            <div class="four wide right aligned column content"><span class="ui sub header">Név</span></div>
                            <div class="twelve wide left aligned column">{{$data['name']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Kód</span></div>
                            <div class="twelve wide left aligned column">{{$data['code']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Tanár</span></div>
                            <div class="twelve wide left aligned column">{{$data->teacher->name}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Kredit</span></div>
                            <div class="twelve wide left aligned column">{{$data['kredit']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Leírás</span></div>
                            <div class="twelve wide left aligned column">{{$data['description'] ?? 'Nincs leírás'}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Létrehozva</span></div>
                            <div class="twelve wide left aligned column">{{$data['created_at']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Módosítva</span></div>
                            <div class="twelve wide left aligned column">{{$data['updated_at']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Létszám</span></div>
                            <div class="twelve wide left aligned column">{{count($data->users)}}</div>
                        </div>
                    </div>

                </div>
            </div>


            <table class="ui  celled  violet striped table">
                <thead>
                    <tr>
                        <th colspan="2">Diákok</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse ($data->users as $user)
                        <tr>
                            <td class="collapsing">
                                <i class="user icon"></i> {{$user->name}}
                            </td>
                            <td>{{$user->email}}</td>
                        </tr>
                    @empty
                       <tr><td>Nincs feliratkozott diák</td></tr>
                    @endforelse
                </tbody>
            </table>

            @if (Auth::user()->isSubscribedTo($data))
            <table class="ui  celled teal striped table">
                <thead>
                    <tr><th colspan="4">Feladatok</th>
                </tr></thead>
                <tbody>
                    @forelse ($data->tasks as $task)
                        @if ((Auth::user()->teacher) || ($task->state() == 'ongoing'))
                            <tr
                                @php
                                    if ($task->state() == 'waiting') echo '';
                                    if ($task->state() == 'ongoing') echo 'class="positive"';
                                    if ($task->state() == 'over') echo 'class="negative"';
                                @endphp>

                                <td class="collapsing">
                                    @if (Auth::user()->teacher)
                                        <i class="pencil icon"></i> <a href={{route('taskProfile', $task->id)}}>{{$task->name}}</a>
                                    @else
                                        <i class="pencil icon"></i> <a href={{route('newSolution', $task->id)}}>{{$task->name}}</a>
                                    @endif
                                </td>
                                <td>{{$task->start}} - {{$task->deadline}}
                                    @php
                                        if ($task->state() == 'waiting') echo 'Még nem elérhető';
                                        if ($task->state() == 'ongoing') echo 'Elérhető';
                                        if ($task->state() == 'over') echo 'Már nem elérhető';
                                    @endphp
                                </td>
                                <td class="center aligned collapsing">{{$task->value}} pont</td>
                                @if (!Auth::user()->teacher)
                                    <td class="center aligned collapsing">
                                        @if (Auth::user()->solutionsByTask($task->id)->count()> 0)
                                            <i class="check icon"></i>Beadva
                                        @else
                                            <i class="delete icon"></i>Még nincs beadva
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @empty
                       <tr><td>Nincs feladat a tárgyhoz</td></tr>
                    @endforelse
                </tbody>
            </table>
            @endif



        </div>
    </div>
</div>
@endsection
