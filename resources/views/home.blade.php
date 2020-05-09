@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="ui grid">

                            <div class="eight wide column">
                                @if (Route::getCurrentRoute()->getName() == 'subjectsList')
                                    Publikus tárgyak
                                @else
                                    @if (Auth::user()->teacher)
                                    Tárgyaim
                                    @else
                                        
                                    Felvett tárgyak
                                    @endif
                                @endif
                            </div>
                            
                            <div class="eight wide right aligned column">
                                @if (Auth::user()->teacher)
                                    <a class="ui basic button blue" href={{route('newSubjectForm')}}>Új tantárgy</a>
                                @else
                                    <a href={{route('subjectsList')}} class="ui basic button blue">Tantárgy felvétele</a>
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

                    <div class="ui comments" style="max-width: none">
                    
                        @for ($i = 0; $i < count($data); $i++)
                                @php
                                    $sbj = $data[$i];
                                @endphp
                                <div class="ui segment">
                                    <div class="comment">
                                        <div class="ui grid very relaxed">
                                            <div class="twelve wide column">
                                                <div class="content">
                                                    <a class="author" href={{route('subjectProfile', $sbj['id'])}}>{{ $sbj['name'] }}</a>
                                                    <div class="metadata">
                                                        <div class="primary text">{{ $sbj['code'] }}</div>
                                                        <div class="">{{ $sbj['kredit'] }} kredit</div>
                                                        <div class="sub header">{{ $sbj->teacher->name }}</div>
                                                    </div>
                                                    <div class="text">{{ $sbj['description'] ?? 'Nincs leírás'}}</div>
                                                </div>
                                            </div>

                                            <div class="four wide column center aligned">
                                                @if (Auth::user()->teacher)
 
                                                    <a href={{route('togglePrivacy', $sbj['id'])}}>
                                                    @if ($sbj['public'])
                                                        <button class="small purple basic button ui">Publikálás visszavonása</button>
                                                    @else
                                                        <button class="small negative basic button ui">Publikálás</button>
                                                    @endif
                                                    </a>
                                                @else 

                                                    
                                                    @if (Auth::user()->isSubscribedTo($sbj))
                                                        <a href={{route('unSubscribe', $sbj->id)}} class="small negative basic button ui">Leiratkozás</a>
                                                        @else
                                                        <a href={{route('subscribe', $sbj->id)}} class="small purple basic button ui">Feliratkozás</a>
                                                    @endif
                                                    

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
