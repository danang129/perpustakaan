<div>
    <div class="card m-3">
        <div class="card-header">
            <div class="card-title">Data Admin</div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success m-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <input type="text" wire:model.live="cari" class="form-control m-2 w-50" placeholder="Cari...">
        <div class="card-body">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->jenis }}</td>
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
            {{ $user->links() }}
            <button type="button" class="btn btn-primary mt-5" data-toggle="modal"
                data-target="#tambahuser">Tambah</button>
        </div>
        {{-- modal Tambahuser --}}
        <div wire:ignore.self class="modal fade" id="tambahuser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-gruop">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}" autofocus>
                                @error('nama')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Email</label>
                                <input type="text" class="form-control" wire:model="email">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" wire:click="store" class="btn btn-primary" data-dismiss="modal">Save
                            changes</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-gruop">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" wire:model="nama"
                                    value="{{ @old('nama') }}" required>
                                @error('nama')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Email</label>
                                <input type="text" class="form-control" wire:model="email">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-gruop">
                                <label for="">Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password')
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
                  <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Yakin ingin menghapus data atas nama "{{ $this->nama}}"</p>
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
