<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title'] = "Home Perpustakaan";
        $data = User::where('jenis','!=','admin')->count();
        return view('livewire.home-component', compact('data'))->layoutData($x);
    }
}
