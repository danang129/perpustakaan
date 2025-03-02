<div>
    <div class="card m-3">
        <div class="card-header">
            <div class="card-title">Pengembalian Buku</div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success m-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <input type="text" wire:model.live="cari" class="form-control m-2 w-50" placeholder="Cari...">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Member</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjam as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->buku->judul }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->tgl_pinjam }}</td>
                            <td>{{ $data->tgl_kembali }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <a href="#" wire:click="pilih({{$data->id}})" class="btn btn-sm btn-success"
                                    data-toggle="modal" data-target="#pilih">Pilih</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pinjam->links() }}
            {{-- <button type="button" class="btn btn-primary mt-5" data-toggle="modal"
                data-target="#tambahuser">Tambah</button> --}}
        </div>
    </div>
    {{-- modal Pilih --}}
    <div wire:ignore.self class="modal fade" id="pilih" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengembalian Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        Judul Buku 
                    </div>
                    <div class="col-md-8">
                        : {{ $judul }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        Nama Member 
                    </div>
                    <div class="col-md-8">
                        : {{ $member }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        Tanggal Kembali 
                    </div>
                    <div class="col-md-8">
                        : {{ $tgl_kembali }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        Tanggal Hari ini 
                    </div>
                    <div class="col-md-8">
                        : {{ date('y-m-d'); }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        Denda 
                    </div>
                    <div class="col-md-8">
                        : @if ($this->status == true)
                            {{ $lama * 1000 }}
                        @else
                            Tidak
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        Durasi
                    </div>
                    <div class="col-md-8">
                        : {{ $lama }} hari
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" wire:click="store" class="btn btn-primary" data-dismiss="modal">Dikembalikan</button>
            </div>
        </div>
    </div>
</div>
</div>