  <!-- ======= Sidebar ======= -->
  @include('admin.layouts2.main')
  

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard-pasien') }}">
          <i class="fa-solid fa-gauge"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Profile Page Nav -->   
    </ul>
    

  </aside><!-- End Sidebar-->