<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $telepon, $email, $alamat, $password, $cari, $id;
    public function render()
    {
        if($this->cari !=""){
            $data['member'] = User::where('nama','like','%' .$this->cari .'%')
            ->paginate(10);

        } else {
            $data['member'] = User::where('jenis','member')->paginate(10);
        }
       $layout['title'] = 'Kelola Member';
        return view('livewire.member-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama'      => 'required',
            'email'     => 'required',
            'telepon'   => 'required',
            'alamat'    => 'required'
        ],[
            'nama.required'     => 'Nama Lengkap Tidak Boleh Kosong!',
            'email.required'    => 'Email Tidak Boleh Kosong!',
            'telepon.required'  => 'No. Telp Tidak Boleh Kosong!',
            'alamat.required'   => 'Alamat Tidak Boleh Kosong!',

        ]);
        User::create([
            'nama'      => $this->nama,
            'email'     => $this->email, 
            'alamat'    => $this->alamat,
            'telepon'   => $this->telepon,
            'jenis'     => 'member'
        ]);
        return redirect()->route('member')->with('success','Berhasil di tambah!');
    }

    public function edit($id){
        $member = User::find($id);
        $this->id = $member->id;
        $this->nama = $member->nama;
        $this->alamat = $member->alamat;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }

    public function update(){
        $member = User::find($this->id);
        $member->update([
            'nama'      => $this->nama,
            'email'     => $this->email, 
            'alamat'    => $this->alamat,
            'telepon'   => $this->telepon,
            'jenis'     => 'member'
        ]);

        return redirect()->route('member')->with('success','Berhasil di ubah!');
    }

    public function destroy(){
        $member = User::find($this->id);
        $member->delete();

        return redirect()->route('member')->with('success','Berhasil di hapus!');
    }

    public function confirm($id){
        $this->id = $id;
    }
}
