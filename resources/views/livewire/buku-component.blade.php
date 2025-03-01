<div>
    <div class="card m-3">
        <div class="card-header">
            <div class="card-title">Kelola Buku</div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success m-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <input type="text" wire:model.live="cari" class="form-control m-2 w-50" placeholder="Cari Judul Buku...">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Jumlah</th>
                        <th>Tahun</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->judul }}</td>
                            <td>{{ $data->kategori->nama }}</td>
                            <td>{{ $data->penulis }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->tahun }}</td>
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
            {{ $buku->links() }}
            <button type="button" class="btn btn-primary mt-5" data-toggle="modal"
                data-target="#tambahuser">Tambah</button>
        </div>
        {{-- modal Tambahuser --}}
        <div wire:ignore.self class="modal fade" id="tambahuser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-gruop">
                                <label for="">Judul Buku</label>
                                <input type="text" class="form-control" wire:model="judul" autofocus>
                                @error('judul')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label>Kategori</label>
                                <select wire:model="kategori" class="form-control">
                                    <option value="">---Pilih---</option>
                                    @foreach ($kateg as $data)
                                        <option value="{{$data->id}}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Penulis</label>
                                <input type="text" class="form-control" wire:model="penulis">
                                @error('penulis')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Jumlah</label>
                                <input type="text" class="form-control" wire:model="jumlah">
                                @error('jumlah')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Tahun</label>
                                <input type="date" class="form-control" wire:model="tahun">
                                @error('tahun')
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <form>
                                <div class="form-gruop">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" wire:model="judul" autofocus>
                                    @error('judul')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label for="">Kategori</label>
                                    <select wire:model="kategori" class="form-control">
                                        <option value="">---Pilih---</option>
                                        @foreach ($kateg as $data)
                                            <option value="{{$data->id}}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label for="">Penulis</label>
                                    <input type="text" class="form-control" wire:model="penulis">
                                    @error('penulis')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label for="">Jumlah</label>
                                    <input type="text" class="form-control" wire:model="jumlah">
                                    @error('jumlah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-gruop">
                                    <label for="">Tahun</label>
                                    <input type="date" class="form-control" wire:model="tahun">
                                    @error('tahun')
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
                  <h5 class="modal-title" id="exampleModalLabel">Hapus Buku</h5>
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
