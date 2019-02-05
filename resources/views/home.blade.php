@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Your pets:</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($pets) == 0)
                        <h2>Create your first pet!</h2>
                    @endif
                    
                    <div class="row">
                        @foreach (\App\Pet::NAMES as $name)
                            @include('pet.create')
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
