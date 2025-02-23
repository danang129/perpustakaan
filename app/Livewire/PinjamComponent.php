<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $user, $buku, $tgl_pinjam, $tgl_kembali, $jumlah;

    public function render()
    {
        $data['member']     = User::where('jenis','member')->get();
        $data['bukuu']       = Buku::all();
        $data['pinjam']     = Pinjam::where('status','dipinjam')->paginate(10);
        $layout['title']    = 'Pinjam Buku';
        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'user' => 'required',
            'buku' => 'required',
        ],[
            'buku.required' => 'Buku harus diisi',
            'user.required' => 'User harus diisi',
        ]);
        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_kembali .' + 7 days'));

    // Mengurangi jumlah buku
    $buku = Buku::find($this->buku);
    if ($buku->jumlah > 0) {
        $buku->jumlah -= 1;
        $buku->save();
    } else {
        return redirect()->route('pinjam')->with('error', 'Stok buku habis!');
    }

        Pinjam::create([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => 'dipinjam'
        ]);
        return redirect()->route('pinjam')->with('success','Berhasil di tambah!');
    }

    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tgl_pinjam = $pinjam->tgl_pinjam;
        $this->tgl_kembali = $pinjam->tgl_kembali;
        $this->jumlah = $pinjam->jumlah;
    }

    public function update()
    {
        $this->validate([
            'user' => 'required',
            'buku' => 'required',
            'jumlah' => 'required|integer|min:1',
        ], [
            'buku.required' => 'Buku harus diisi',
            'user.required' => 'User harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
        ]);

        $pinjam = Pinjam::find($this->id);
        $buku = Buku::find($this->buku);
        $pinjam = Pinjam::find($this->id);
        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_kembali .' + 7 days'));

        // Mengembalikan jumlah buku yang sebelumnya dipinjam
        $buku->jumlah += $pinjam->jumlah;

        // Mengurangi jumlah buku dengan jumlah baru
        if ($buku->jumlah >= $this->jumlah) {
            $buku->jumlah -= $this->jumlah;
            $buku->save();

            $pinjam->update([
                'user_id' => $this->user,
                'buku_id' => $this->buku,
                'tgl_pinjam' => $this->tgl_pinjam,
                'tgl_kembali' => $this->tgl_kembali,
                'status' => 'dipinjam',
                'jumlah' => $this->jumlah,
            ]);

            return redirect()->route('pinjam')->with('success', 'Berhasil di edit!');
        } else {
            return redirect()->route('pinjam')->with('error', 'Stok buku tidak mencukupi untuk buku: ' . $buku->judul);
        }
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $pinjam = Pinjam::find($this->id);
        $pinjam->delete();
        return redirect()->route('pinjam')->with('success','Berhasil di hapus!');
    }
}
