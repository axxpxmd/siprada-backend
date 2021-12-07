<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="{{ route('home') }}">
            <i class="icon icon-dashboard2 blue-text s-18"></i> 
            <span>Dashboard</span>
        </a>
    </li>
    <li class="header light"><strong>MASTER USER</strong></li>
    <li class="no-b">
        <a href="{{ route('pengguna.index') }}">
            <i class="icon icon-users text-success s-18"></i> 
            <span>User</span>
        </a>
    </li>
    <li class="header light"><strong>MASTER TAHAPAN</strong></li>
    <li class="no-b">
        <a href="{{ route('tahapan.index') }}">
            <i class="icon icon-document-text4 text-danger s-18"></i> 
            <span>Tahapan</span>
        </a>
        <a href="{{ route('sub-tahapan.index') }}">
            <i class="icon icon-document-text4 text-primary s-18"></i> 
            <span>Sub Tahapan</span>
        </a>
    </li>
    <li class="header light"><strong>MASTER PERDA</strong></li>
    <li class="no-b">
        <a href="{{ route('perda.index') }}">
            <i class="icon icon-document-text4 text-warning s-18"></i> 
            <span>Perda</span>
        </a>
    </li>
    <li class="header light"><strong>MASTER DATA</strong></li>
    <li class="no-b">
        <a href="#">
            <i class="icon icon-chat2 text-purple s-18"></i> 
            <span>Konseling</span>
        </a>
    </li>
    <li class="no-b">
        <a href="{{ route('aspirasi.index') }}">
            <i class="icon icon-document-text4 text-success s-18"></i> 
            <span>Aspirasi</span>
        </a>
    </li>
</ul>
