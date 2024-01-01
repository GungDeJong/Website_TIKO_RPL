<div>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->site_name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $alias }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.artis.index') }}"><i class="fas fa-star"></i>
                    <span>Artis</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.konser.index') }}"><i
                        class="fas fa-microphone"></i>
                    <span>Konser</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.transaksi.index') }}"><i
                        class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.tiket.index') }}"><i
                        class="fas fa-ticket-alt"></i>
                    <span>Tiket</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.pengembalian-dana.index') }}"><i
                        class="fas fa-undo"></i>
                    <span>Refund</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-newspaper"></i>
                    <span>Berita</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.post-categories.index') }}">Kategori</a></li>
                    <li><a href="{{ route('admin.post-tags.index') }}">Tag</a></li>
                    <li><a href="{{ route('admin.posts.index') }}">Berita</a></li>
                    <li><a href="{{ url('admin/filemanager') }}">File Manager</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-database"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.users.index') }}">User</a></li>
                    <li><a href="{{ route('admin.metode-pembayaran.index') }}">Metode Pembayaran</a></li>
                    <li><a href="{{ route('admin.settings.index') }}">Pengaturan Web</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
