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
                                </div>
                            </div>

                            <div class="eight wide right aligned column">
                                @if (Auth::user()->teacher)
                                    <a class="positive basic ui button" href={{route('taskEdit', $data['id'])}}>Módosítás</a>
                                    <a class="negative basic ui button" href={{route('taskDelete', $data['id'])}}>Törlés</a>
                                @else
                                    <a class="positive basic ui button" href="{{route('newSolution', $data['id'])}}">Megoldás beküldése</a>
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
                            <div class="four wide right aligned column content"><span class="ui sub header">Feladat</span></div>
                            <div class="twelve wide left aligned column">{{$data->name}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Tantárgy</span></div>
                            <div class="twelve wide left aligned column">
                                <a href="{{route('subjectProfile', $data->subject->id)}}">{{$data->subject->name}}</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Leírás</span></div>
                            <div class="twelve wide left aligned column">{{$data['description']  ?? 'Nincs leírás'}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Kapható pont</span></div>
                            <div class="twelve wide left aligned column">{{$data->value}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Kezdés</span></div>
                            <div class="twelve wide left aligned column">{{$data['start']}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Vége</span></div>
                            <div class="twelve wide left aligned column">{{$data['deadline']}}</div>
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
                            <div class="four wide right aligned column content"><span class="ui sub header">Megoldások száma</span></div>
                            <div class="twelve wide left aligned column">{{$data->solutions()->count()}}</div>
                        </div>

                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Értékelt megoldások száma</span></div>
                            <div class="twelve wide left aligned column">{{$data->solutions()->whereNotNull('value')->count()}}</div>
                        </div>
                    </div>

                </div>
            </div>

            @if ((Auth::user()->teacher))
            <table class="ui  celled teal striped table">
                <thead>
                <tr><th colspan="6">Megoldások</th>
                </tr></thead>
                <tbody>
                @forelse ($data->solutions as $solution)
                        <tr>
                            <td
                                @if ($solution->value)
                                class="left-border-green"
                                @endif
                            >{{$solution->created_at}}</td>
                            <td>{{$solution->user->name}}</td>
                            <td>{{$solution->user->email}}</td>

                            @if ($solution->value)
                                <td class="center aligned collapsing">Értékelve</td>
                                <td class="center aligned collapsing">{{$solution->value}} pont</td>
                                <td class="center aligned collapsing">{{$solution->valuated_at}}</td>
                            @else
                                <td class="center aligned collapsing" colspan="2">Még nem értékelt</td>
                                <td class="center aligned collapsing">
                                    <a href="{{route('solutionValuate', $solution->id)}}" class="ui button basic positive">Értékelés</a>
                                </td>
                            @endif

                        </tr>
                @empty
                    <tr><td>Nincs megoldás a feladathoz</td></tr>
                @endforelse
                </tbody>
            </table>
            @endif


        </div>
    </div>
</div>
@endsection
