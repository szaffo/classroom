@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Profil oldal
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
                            <div class="twelve wide left aligned column">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Email cím</span></div>
                            <div class="twelve wide left aligned column">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="row">
                            <div class="four wide right aligned column content"><span class="ui sub header">Fiók típusa</span></div>
                            <div class="twelve wide left aligned column">
                                @if ( Auth::user()->teacher )
                                    Tanár
                                @else
                                    Diák
                                @endif 
                            </div>
                        </div>
                        @if ( Auth::user()->teacher )
                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Tantárgyak száma</span></div>
                                <div class="twelve wide left aligned column">
                                    {{Auth::user()->subjects()->get()->count()}}
                                </div>
                            </div> 
                            <div class="row">
                                <div class="four wide right aligned column content"><span class="ui sub header">Tantárgyak</span></div>
                                <div class="twelve wide left aligned column">
                                    @php $subjects = Auth::user()->subjects()->get() @endphp 
                                    @for ($i = 0; $i<count($subjects); $i++)
                                        <div>{{$subjects[$i]['name']}} - {{$subjects[$i]['code']}}</div>
                                    @endfor
                                    
                                </div>
                            </div> 
                        @endif
                    </div>

                </div>
                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row container-fluid">
                        <p><b>Az Ön neve: </b>{{ Auth::user()->name }}</p>
                    </div>

                     <div class="row container-fluid">
                        <p><b>Az Ön email címe: </b>{{ Auth::user()->email }}</p>
                    </div>

                     <div class="row container-fluid">
                        <p><b>Az Ön fiókjának típusa: </b>
                        @if ( Auth::user()->teacher )
                            Tanár
                        @else
                            Diák
                        @endif    
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
