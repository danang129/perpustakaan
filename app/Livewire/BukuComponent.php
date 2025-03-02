<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $kategori, $judul, $penulis, $tahun, $jumlah, $cari;

    public function render()
    {
        if($this->cari != ""){
            $data['buku'] = Buku::where('judul', 'like', '%' . $this->cari . '%')->paginate(10);
        } else {
            $data['buku'] = Buku::paginate(10);
        }
        $data['kateg'] = Kategori::all();
        $layout['title'] = 'Perpustakaan - Kelola Buku';
        return view('livewire.buku-component', $data)->layoutData($layout);
    }

    public function store() {
        $this->validate([
            'judul'     => 'required',
            'kategori'  => 'required',
            'penulis'   => 'required',
            'jumlah'    => 'required',
            'tahun'     => 'required',
        ],[
            'judul.required' => 'Judul Buku Tidak Boleh Kosong',
            'kategori.required' => 'Kategori Tidak Boleh Kosong',
            'penulis.required' => 'Penulis Tidak Boleh Kosong',
            'tahun.required' => 'Tahun Terbit Tidak Boleh Kosong',
            'jumlah.required' => 'Jumlah  Tidak Boleh Kosong',
        ]);

        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'jumlah' => $this->jumlah,
            'tahun' => $this->tahun,
        ]);
        
    }

    public function edit($id){
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori_id;
        $this->penulis = $buku->penulis;
        $this->tahun = $buku->tahun;
        $this->jumlah = $buku->jumlah;
    }

    public function update(){
        $buku = Buku::find($this->id);
        $buku->update([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'tahun' => $this->tahun,
            'jumlah' => $this->jumlah,
        ]);
        return redirect()->route('buku')->with('success','Berhasil di update!');
    }
    
    public function destroy(){
        $buku = Buku::find($this->id);
        $buku->delete();
        return redirect()->route('buku')->with('success','Berhasil di hapus!');
    }

    public function confirm($id){
        $this->id = $id;
    }

}
