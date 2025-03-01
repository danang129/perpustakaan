<div>
    <div class="card m-3">
        <div class="card-header">
            <div class="card-title">Peminjaman Buku</div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success m-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger m-3" role="alert">
                {{ session('error') }}
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
                        <th>Jumlah Pinjam</th>
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
                                <a href="" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info"
                                    data-toggle="modal" data-target="#edituser">Edit</a>
                                <a href="" wire:click="confirm({{ $data->id }})"
                                    class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapususer">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pinjam->links() }}
            <button type="button" class="btn btn-primary mt-5" data-toggle="modal"
                data-target="#tambahuser">Tambah</button>
        </div>
        {{-- modal Tambahuser --}}
        <div wire:ignore.self class="modal fade" id="tambahuser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-gruop">
                                <label for="">Judul Buku</label>
                                <select wire:model="buku" class="form-control">
                                    <option value="">---Pilih---</option>
                                    @foreach ($bukuu as $data)
                                        <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                    @endforeach
                                </select>
                                @error('buku')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label>Nama Member</label>
                                <select wire:model="user" class="form-control">
                                    <option value="">---Pilih---</option>
                                    @foreach ($member as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                @error('user')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label>Jumlah Pinjam :</label>
                                <input type="number" wire:model="jumlah" class="form-control">
                                @error('jumlah')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" wire:click="store" class="btn btn-primary" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal Edituser --}}
        <div wire:ignore.self class="modal fade" id="edituser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Peminjaman Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <form>
                                <div class="form-gruop">
                                    <label for="">Judul Buku</label>
                                    <select wire:model="buku" class="form-control">
                                        <option value="{{old('buku')}}">---Pilih---</option>
                                        @foreach ($bukuu as $data)
                                            <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                    @error('buku')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label for="">Nama Member</label>
                                    <select wire:model="user" class="form-control">
                                        <option value="{{old('user')}}">---Pilih---</option>
                                        @foreach ($member as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label>Jumlah Pinjam :</label>
                                    <input type="number" wire:model="jumlah" class="form-control">
                                    @error('jumlah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" wire:click="update" class="btn btn-primary" data-dismiss="modal">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal hapususer --}}
        <div wire:ignore.self class="modal fade" id="hapususer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus Peminjaman Buku</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" wire:click="destroy" class="btn btn-primary" data-dismiss="modal">Yes</button>
                </div>
              </div>
            </div>
            
          </div>
    </div>
</div>
