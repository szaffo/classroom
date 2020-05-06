@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kapcsolat</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="card-title">Szabó Martin</h5>
                    <h6 class="card-subtitle mb-2 text-muted">CQBO0I</h6>
                    <h6 class="card-subtitle mb-2 text-muted">martin77szabo@gmail.com</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
