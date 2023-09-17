<aside id="layout-menu"
class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
<div class="container-xxl d-flex h-100">
    <ul class="menu-inner">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home" style="color: #FF47DA"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                        <div data-i18n="Analytics">Home</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('show_pemograman') }}" class="menu-link">
                        <i class="menu-icon tf-icons fa-solid fa-code"></i>
                        <div data-i18n="CRM">BHS Pemograman</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('show_kategori') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-atom-2"></i>
                        <div data-i18n="eCommerce">Kategori Sertifikat</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Pages -->
        <li class="menu-item">
            <a href="{{ route('show_profil') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-id-card" style="color: #FF9F43"></i>
                Profil
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('show-riwayat-pendidikan') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-graduation-cap" style="color: #28C76F"></i>
                Riwayat Pendidikan
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('show-riwayat-organisasi') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-people-roof" style="color: #7367F0"></i>
                Riwayat Organisasi
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('show-riwayat-kerja') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-briefcase"  style="color: #EA5455"></i>
                Riwayat Kerja
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('show_projek') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-star"  style="color: #CA3CFF"></i>
                Projek
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('show_sertifikat') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-file-pdf"  style="color: #F44708"></i>
                Sertifikat
            </a>
        </li>

    </ul>
</div>
</aside>
