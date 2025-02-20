<?php

namespace App\Livewire;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class KategoriComponent extends Component
{
    use WithPagination, WithouturlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $id, $deskripsi, $cari;
    public function render()
    {
        if($this->cari != ""){
            $data['kategori'] = Kategori::where('nama','like' .$this->cari ."%")->paginate(10);
        } else {
            $data['kategori'] = Kategori::paginate(10);
        }

        $layout['title'] = 'Kelola Kategori Buku';
        return view('livewire.kategori-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama'      => 'required',
            'deskripsi' => 'required'
        ],[
            'nama.required'     => 'Nama Kategori Tidak Boleh Kosong',
            'deskripsi.requred' => 'Deskripsi Tidak Boleh Kosong'
        ]);
        Kategori::create([
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        return redirect()->route('kategori')->with('success','Berhasil di tambah!');
    }

    public function edit($id){
        $kategori           = Kategori::find($id);
        $this->id           = $kategori->id;
        $this->nama         = $kategori->nama;
        $this->deskripsi    = $kategori->deskripsi;
    }

    public function update(){
        $kategori = Kategori::find($this->id);
        $kategori->update([
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        return redirect()->route('kategori')->with('success','Berhasil di ubah!');
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $kategori = Kategori::find($this->id);
        $kategori->delete();

        return redirect()->route('kategori')->with('success','Berhasil di hapus!');
    }

   
}
