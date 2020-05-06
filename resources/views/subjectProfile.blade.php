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
                                <a class="positive basic ui button" href={{route('subjectEdit', $data['id'])}}>Módosítás</a>
                                <a class="negative basic ui button" href={{route('subjectDelete', $data['id'])}}>Törlés</a>
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
                            <div class="twelve wide left aligned column">0</div>
                        </div>
                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Diákok</span></div>
                            <div class="twelve wide left aligned column">Nincs jelentkezett diák</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
