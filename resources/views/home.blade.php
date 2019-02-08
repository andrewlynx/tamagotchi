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
                    @if (Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    @if (count($pets) == 0)
                        <h2>Create your first pet!</h2>
                        <div class="row">
                            @foreach (\App\Pet::NAMES as $name)
                                @if (count($pets->where('name', $name)) == 0)
                                    @include('pet.create')
                                @endif
                            @endforeach
                        </div>
                    @endif
                    
                    <div class="row" v-for="pet in pets">
                        @include('pet.thumb')
                    </div>
                    
                    <div class="row" v-if='pets.length !=0'>
                        <div class="col-md-6" v-if="pets.length <= 4">
                            <h3 v-on:click="newPetsToggle = !newPetsToggle">Click to add more pets!</h3>
                            <div class="row" v-if="newPetsToggle">
                                @foreach (\App\Pet::NAMES as $name)
                                    @if (count($pets->where('name', $name)) == 0)
                                        @include('pet.create')
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="restart text-center" v-if="deadPets">
    <div class="vertical-center">
        <h1>We are sorry to let you know that you pet have died :(</h1>
        <h2>Please be careful and don't forget about your pets in real life</h2>
        <button v-on:click="restart" class="btn btn-primary btn-lg">Restart</button>
    </div>
</div>
@endsection
