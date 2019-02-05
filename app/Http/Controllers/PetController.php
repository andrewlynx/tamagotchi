<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pet;
use App\PetCare;
use App\PetHunger;
use App\PetSleeping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PetController extends Controller
{
    public function create($name) {
        
        if (in_array(ucfirst($name), Pet::NAMES)) {
            if (!Pet::where('name', ucfirst($name))->where('user_id', Auth::user()->id)->exists()) {
                $pet = Pet::create(['name' => ucfirst($name)]);
                $pet->petCare()->save(new PetCare());
                $pet->petHunger()->save(new PetHunger());
                $pet->petSleeping()->save(new PetSleeping());
            } else {
                Session::flash('message', "Wow! You already have a $name, maybe that's enough?" );
            }
        } else {
            Session::flash('message', "You can't create $name, stop cheating!!" );
        }
        return redirect('/');
    }
}
