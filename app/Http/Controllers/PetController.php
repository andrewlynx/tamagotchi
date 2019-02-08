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
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Create new pet for user with selected name. 
     * Prevent creating dublicates and non-valid pets
     * 
     * @return redirection to main screen
     */
    public function create(string $name)
    {
        if (in_array(ucfirst($name), Pet::NAMES)) {
            if (!Pet::where('name', ucfirst($name))->where('user_id', Auth::id())->exists()) {
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

    /**
     * Increase pet care value
     * 
     * @return void
     */
    public function care(int $id)
    {
        Pet::find($id)->petCare->increase();
    }

    /**
     * Increase pet hunger value
     * 
     * @return void
     */
    public function feed(int $id)
    {
        Pet::find($id)->petHunger->increase();
    }

    /**
     * Increase pet sleeping value
     * 
     * @return void
     */
    public function sleep(int $id)
    {
        Pet::find($id)->petSleeping->increase();
    }

    /**
     * Delete all current user pets
     * 
     * @return void
     */
    public function restart()
    {
        Pet::where('user_id', Auth::id())->delete();
    }
}
