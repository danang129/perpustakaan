<?php

namespace App\Livewire;

use App\Models\Pengembalian;
use App\Models\Pinjam;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
public $id, $judul, $member, $tgl_kembali, $status, $denda, $lama;

    public function render()
    {
        $layout['title'] = 'Pengembalian Buku';
        $data['pinjam'] = Pinjam::where('status','dipinjam')->paginate(10);
        return view('livewire.kembali-component', $data)->layoutData($layout);
    }

    // public function pilih($id)
    // {
    //    $pinjam = Pinjam::find($id); 
    //    $this->judul = $pinjam->buku->judul;
    //    $this->member = $pinjam->user->nama;
    //    $this->tgl_kembali = $pinjam->tgl_kembali;
       
    //     // Menghitung selisih hari antara tanggal kembali dan hari ini
    //     $kembali = new \DateTime($pinjam->tgl_kembali);
    //     $today = new \DateTime();
    //     $this->selisih = $kembali->diff($today)->days;

    //     // Menghitung denda (misalnya, Rp 1000 per hari keterlambatan)
    //     $dendaPerHari = 1000;
    //     $this->denda = $this->selisih > 0 ? $this->selisih * $dendaPerHari : 0;
    // }

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
        // $this->denda = $selisih->invert;
        if($selisih->invert == 1){
            $this->status = true;
        } else {
            $this->status = false;
        }
        $this->lama = $selisih->days;
    }

    public function store()
    {
        if($this->status == true){
            $denda = $this->lama * 1000;
        }
        else {
            $denda = 0;
        }
        $pinjam = Pinjam::find($this->id);

       Pengembalian::create([
        'pinjam_id' => $this->id,
        'tgl_kembali' => date('Y-m-d'),	
        'denda' => $denda,
       ]) ;
       
       $pinjam->update([
        'status' => 'dikembalikan',
       ]);
       return redirect()->route('kembali')->with('success','Berhasil di kembalikan!');
    }

}
