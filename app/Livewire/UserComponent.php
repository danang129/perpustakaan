<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = "bootstrap";
    public $nama, $email, $password, $id, $cari;

    public function render()
    {
        $layout['title'] = 'Perpustakaan - Kelola Admin';

        $user = User::where('jenis', 'admin')
                    ->where(function($query) {
                        $query->where('nama', 'like', '%' . $this->cari . '%')
                              ->orWhere('email', 'like', '%' . $this->cari . '%');
                    })->paginate(10);

        return view('livewire.user-component', ['user' => $user])->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Format Email Salah',
            'password.required' => 'Password Tidak Boleh Kosong'
        ]);
        User::create([
            'nama'      =>$this->nama,
            'email'     => $this->email,
            'password'  => $this->password,
            'jenis'     =>'admin'
        ]);
        return redirect()->route('admin')->with('success','Berhasil di tambah!');
    }

    public function edit($id){
        $user = User::find($id);
        $this->nama     = $user->nama;
        $this->email    = $user->email;
        $this->id       = $user->id; 
    }

    public function update(){
        $user = User::find($this->id);
        if($this->password==""){
            $user->update([
                'nama'  =>$this->nama,
                'email' => $this->email
            ]);
        } else {
            $user->update([
                'nama'      => $this->nama,
                'email'     => $this->email,
                'password'  => $this->password
            ]);
        }
        return redirect()->route('admin')->with('success','Berhasil di ubah!');
    }

    public function confirm($id){
        $user = User::findOrFail($id);
        $this->id = $id;
        $this->nama = $user->nama;
    }

    public function destroy(){
        $user = User::find($this->id);
        $user->delete();

        return redirect()->route('admin')->with('success','Data "'.$this->nama .'" Berhasil di hapus!');
    }
    
}
