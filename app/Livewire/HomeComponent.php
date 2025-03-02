<?php

namespace App\Livewire;

use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title'] = "Perpustakaan - Beranda";
        $member = User::where('jenis','!=','admin')->count();
        $admin = User::where('jenis','!=','member')->count();
        $pinjam = Pinjam::all()->count();
        $kembali = Pengembalian::all()->count();
        return view('livewire.home-component', compact('admin','member','pinjam','kembali'))->layoutData($x);
    }
}
