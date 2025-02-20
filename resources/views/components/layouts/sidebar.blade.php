<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        {{-- <div class="user">
            <div class="photo">
                <img src="assets/img/profile.jpg">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Hizrian
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <ul class="nav">
            <li class="nav-item active">
                <a href="{{route('home')}}">
                    <i class="fa-solid fa-chart-line"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin')}}">
                    <i class="fa-solid fa-user-secret"></i>
                    <p>Data Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('member')}}">
                    <i class="fa-solid fa-users"></i>
                    <p>Data Member</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('buku')}}">
                    <i class="fa-solid fa-book"></i>
                    <p>Daftar Buku</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('pinjam')}}">
                    <i class="fa-regular fa-handshake"></i>
                    <p>Peminjaman Buku</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('kembali')}}">
                    <i class="fa-regular fa-handshake"></i>
                    <p>Pengembalian Buku</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('kategori')}}">
                    <i class="fa-brands fa-stack-overflow"></i>
                    <p>Kategori</p>
                </a>
            </li>
        </ul>
    </div>
</div>