@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <table class="ui celled table">
                <thead>
                    <tr><th colspan="4">Aktív feladatok</th></tr>
                </thead>
                <tbody>
                    @forelse (Auth::user()->subjects as $subject)
                        <tr><td colspan="4" class="ui header small">{{ $subject->name }}</td></tr>
                        @forelse($subject->activeTasks as $task)
{{--                            @if (($task->start <= date('Y-m-d')) && ($task->deadline > date('Y-m-d')))--}}
                                <tr>
                                    <td class="collapsing">
                                        <i class="pencil icon"></i> <a href={{route('newSolution', $task->id)}}>{{$task->name}}</a>
                                    </td>
                                    <td>{{$task->start}} - {{$task->deadline}}</td>
                                    <td class="center aligned collapsing">{{$task->value}} pont</td>
                                    <td class="center aligned collapsing">
                                        @if (Auth::user()->solutionsByTask($task->id)->count()> 0)
                                            <i class="check icon"></i>Beadva
                                        @else
                                            <i class="delete icon"></i>Még nincs beadva
                                        @endif
                                    </td>
                                </tr>
{{--                            @endif--}}
                        @empty
                            <tr><td style="color: #aaa" colspan="4">Nincs feladat ehhez a tárgyhoz</td></tr>
                        @endforelse
                    @empty
                       <tr><td><span style="color: #aaa">Nincs aktív feladat</span></td></tr>
                    @endforelse
                </tbody>
            </table>




        </div>
    </div>
</div>
@endsection
