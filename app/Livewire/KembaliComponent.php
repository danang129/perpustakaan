<?php

namespace App\Livewire;

use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\Buku;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $judul, $member, $tgl_kembali, $status, $denda, $lama, $cari;

    public function render()
    {
        $query = Pinjam::query()->where('status','dipinjam');

        if($this->cari != ""){
            $searchTerms = explode(':', $this->cari);
            if(count($searchTerms) == 2) {
                $member = $searchTerms[0];
                $judul = $searchTerms[1];
                $query->whereHas('user', function($q) use ($member) {
                          $q->where('nama', 'like', '%' . $member . '%');
                      })
                      ->whereHas('buku', function($q) use ($judul) {
                          $q->where('judul', 'like', '%' . $judul . '%');
                      });
            } else {
                $query->whereHas('user', function($q) {
                          $q->where('nama', 'like', '%' . $this->cari . '%');
                      })
                      ->orWhereHas('buku', function($q) {
                          $q->where('judul', 'like', '%' . $this->cari . '%');
                      });
            }
        }

        $layout['title'] = 'Perpustakaan - Pengembalian Buku';
        $data['pinjam'] = $query->paginate(10);
        return view('livewire.kembali-component', $data)->layoutData($layout);
    }

    public function pilih($id)
    {
        $pinjam = Pinjam::find($id);
        $this->judul = $pinjam->buku->judul;
        $this->member = $pinjam->user->nama;
        $this->tgl_kembali = $pinjam->tgl_kembali;
        $this->id = $pinjam->id;

        $kembali = new \DateTime($this->tgl_kembali);
        $today = new \DateTime();
        $selisih = $today->diff($kembali);

        if ($selisih->invert == 1) {
            $this->status = true;
        } else {
            $this->status = false;
        }
        $this->lama = $selisih->days;
    }

    public function store()
    {
        if ($this->status == true) {
            $denda = $this->lama * 1000;
        } else {
            $denda = 0;
        }
        $pinjam = Pinjam::find($this->id);

        // Menambah jumlah buku kembali
        $buku = Buku::find($pinjam->buku_id);
        $buku->jumlah += $pinjam->jumlah;
        $buku->save();

        Pengembalian::create([
            'pinjam_id' => $this->id,
            'tgl_kembali' => date('Y-m-d'),
            'denda' => $denda,
        ]);

        $pinjam->update([
            'status' => 'dikembalikan',
        ]);

        return redirect()->route('kembali')->with('success', 'Berhasil dikembalikan!');
    }
}
