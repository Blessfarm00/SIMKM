  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
          <i class="fa-solid fa-gauge"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Profile Page Nav -->

       <li class="nav-item">
        <a class="nav-link {{ Request::is('antrian') ? 'active' : '' }}" href="{{ url('index') }}">
          <i class="fa-solid fa-list-ol"></i>
          <span>No Antrian</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link {{ Request::is('pasiens') ? 'active' : '' }}" href="{{ url('pasien') }}">
          <i class="fa-solid fa-hospital-user"></i>
          <span>Pasien</span>
        </a>
      </li><!-- End Profile Page Nav -->

            @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ?? ($user->role == 'perawat'))
                {{-- Tampilkan navigasi sesuai dengan peran dokter, admin, atau perawat --}}
            @else
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dokter') ? 'active' : '' }}" href="{{ url('dokter') }}">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Perawat</span>
                    </a>
                </li>
            @endif


            @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ?? ($user && ($user->role == 'admin' || $user->role == 'Perawat')))
                {{-- Tampilkan navigasi sesuai dengan peran dokter, admin, atau perawat --}}
            @else
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">
                        <i class="fa-solid fa-user"></i>
                        <span>User</span>
                    </a>
                </li>
            @endif


           @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ?? ($user->role == 'Perawat'))
        @else
      <li class="nav-heading">INVENTORI</li>
      <li class="nav-item">            
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
	          <i class="bi bi-chart-  "></i><span>Inventori</span><i class="bi bi-chevron-down ms-auto"></i>             
          </a>    
          <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">      
          <a class="nav-link {{ Request::is('obat') ? 'active' : '' }}" href="{{ url('obat') }}">
            <i class="bi bi-person"></i>
            <span>Obat</span>
          </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ Request::is('peralatan_medis') ? 'active' : '' }}" href="{{ url('peralatan_medis') }}">
          <i class="bi bi-person"></i>
          <span>Alat Medis</span>
        </a>
      </li><!-- End Profile Page Nav -->
      </ul>
      @endif

      <li class="nav-heading">Pemeriksaan</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('pemeriksaan') ? 'active' : '' }}" href="{{ url('pemeriksaan') }}">
         <i class="fa-solid fa-stethoscope"></i>
          <span>Pemeriksaan</span>
        </a>
      </li>

       <li class="nav-item">
        <a class="nav-link {{ Request::is('rekam-medis') ? 'active' : '' }}" href="{{ url('rekam-medis') }}">
         <i class="fa-solid fa-notes-medical"></i>
          <span>Rekam Medis</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link {{ Request::is('resep-obat') ? 'active' : '' }}" href="{{ url('resep-obat') }}">
         <i class="fa-solid fa-pills"></i>
          <span>Resep Obat</span>
        </a>
      </li>
          @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ??($user->role == 'Perawat'))
        @else
      <li class="nav-heading">Spesialistik</li>
      
      <li class="nav-item">
        <a class="nav-link {{ Request::is('perawatan') ? 'active' : '' }}" href="{{ url('perawatan') }}">
          <i class="fa-solid fa-bandage"></i>
          <span>Perawatan Luka</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('sunat') ? 'active' : '' }}" href="{{ url('sunat') }}">
         <i class="fa-solid fa-child-reaching"></i>
          <span>Sunat</span>
        </a>
      </li>
       @endif

            
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('janji') ? 'active' : '' }}" href="{{ url('janji') }}">
                  <i class="fa-solid fa-calendar"></i>
                    <span>Janji</span>
                  </a>
                </li>
             
             @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ??($user->role == 'Perawat'))
        @else
      <li class="nav-heading">Keuangan</li>
      <li class="nav-item">            
          <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
	          <i class="bi bi-chart-  "></i><span>Keuangan</span><i class="bi bi-chevron-down ms-auto"></i>             
          </a>    
         <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">      
         <a class="nav-link {{ Request::is('pengeluaran') ? 'active' : '' }}" href="{{ url('pengeluaran') }}">
          <i class="bi bi-person"></i>
          <span>Pemasukan Obat</span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link {{ Request::is('pendapatan') ? 'active' : '' }}" href="{{ url('pendapatan') }}">
          <i class="bi bi-person"></i>
          <span>Pendapatan</span>
        </a>
      </li>
        
      @endif
      </li>
      
      
     
    
    </ul>

     
    
    </ul>
 
      
    </ul>
    

  </aside><!-- End Sidebar-->