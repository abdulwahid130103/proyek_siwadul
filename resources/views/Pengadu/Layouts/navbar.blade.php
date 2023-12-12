<style>
    .navbar-toggler:focus {
        box-shadow: none !important;
        border-color: transparent !important;
    }
    .navbar-toggler:not(:focus) {
        box-shadow: none !important;
        border-color: transparent !important;
    }
</style>

@if (Auth::user())
  <!-- Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Profile</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- <form id="editForm" enctype="multipart/form-data"> --}}
            <input type="hidden" value="{{ Auth::user()->id }}" id="id_user">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12 d-flex justify-content-center mb-4">
                    <img class="ms-2" src="" id="showfoto" style="width:180px; height:180px; border-radius:50%;" alt="">
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Nama</label>
                          <input type="text" id="shownama" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Email</label>
                          <input type="email" id="showemail" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Jabatan</label>
                          <input type="text" id="showjabatan" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Kode User</label>
                          <input type="text" id="showkodeuser" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" id="showalamat" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Status</label>
                          <input type="text" id="showstatus" class="form-control" disabled>
                      </div>
                  </div>
              </div>
          </div>
          {{-- </form> --}}
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
@endif

<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top navbar-light" style="color:#fff !important;">
  <div  class="container con-nv" style="color:#fff !important;">
    <a class="navbar-brand d-flex justify-content-center align-items-center gap-3" href="#">
      <img src="{{ asset('frontend/image/siwadul_logo.png') }}" 
      alt="logo"
      class="logo" 
      width="50px" 
      height="42px"> 
        <h6 class="font-weight-bolder text-logo text-light mb-0 ">
            SIWADUL
        </h6>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <ion-icon style="color:#fff; font-size:28px;" name="filter-outline"></ion-icon>
    </button>   
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-dark ctn-nav">
        <li class="nav-item lg-mx-2">
          <a class="nav-link text-light" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item lg-mx-2">
          <a class="nav-link text-light" href="{{ url('pengaduan') }}">Pengaduan</a>
        </li>
        <li class="nav-item lg-mx-1">
          <a class="nav-link text-light " href="{{ url('history') }}">Aduanku</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @if (!Auth::user()) 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <button class="btn btn-primary btn-daftar d-flex flex-row" type="button">
                <ion-icon name="log-in-outline" class="icon-daftar"></ion-icon>
                <span style="transform: translateX(-15px)">Masuk</span>
              </button>
            </a>
          </li>
        @else
          <li id="dropdown-navbar" id="nama_user_parent" class="nav-item dropdown" style="transform: translateY(-2px)">
            <button id="usm-nv"
              style="color:#fff !important;"
              class="nav-link btn  dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" value="">
               <span class="text-light nama_user">{{ ucwords(Auth::user()->nama) }}</span>
             <img class="ms-2" src="{{ asset('storage/user/'.Auth::user()->foto) }}" id="profile-new" 
             style="width:30px; height:30px; border-radius:50%;" alt="">
            </button>
            <ul class="dropdown-menu dropdown-menu-light">
              <li>
                <a class="dropdown-item" id="tombol-profile" class="tombol-profile" href="javascript:void(0)">
                  <ion-icon style="transform: translateY(2px);" class="me-2" name="person-outline"></ion-icon>
                  Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}">
                  <ion-icon style="transform: translateY(2px);" class="me-2" name="log-out-outline"></ion-icon>
                  Logout
                </a>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.onscroll = function(){
      const header = document.querySelector('.navbar');
      const fixedNav = header.offsetTop;

      if(window.pageYOffset > fixedNav){
        $('.navbar').addClass('header');
        $('.navbar > .container').removeClass('con-nv');
        $('.nav-item > .nav-link').removeClass('text-white');
        $('.nav-item > .nav-link').addClass('text-dark');
        $('.navbar-brand > h6').removeClass('text-white');
        $('.navbar-brand > h6').addClass('text-dark');
        $('.nama_user').removeClass('text-light');
        $('.nama_user').addClass('text-dark');
        // $('.navbar-brand > .nav-item > .nav-link > button').replace('text-dark');
      }else{
        $('.navbar').removeClass('header');
        $('.navbar > .container').addClass('con-nv');
        $('.nav-item > .nav-link').addClass('text-white');
        $('.nav-item > .nav-link').removeClass('text-dark');
        $('#dropdown-navbar > #nama_user').addClass('text-white');
        $('.nama_user').addClass('text-light');
        $('.nama_user').removeClass('text-dark');
        $('.navbar-brand > h6').addClass('text-white');
        $('.navbar-brand > h6').removeClass('text-dark');
      }
    }

    $('#tombol-profile').click(function(e){
      e.preventDefault();
      $('#profileModal').modal('show');
      var id = $('#id_user').val();
      console.log(id);
      $.ajax({
          url: 'userFrontend/' + id,
          type: 'GET',
          success: function(response) {
              $('#shownama').val(response.result.nama);
              $('#showemail').val(response.result.email);
              $('#showjabatan').val(response.jabatan.nama_jabatan);
              $('#showkodeuser').val(response.result.kode_user);
              $('#showalamat').val(response.result.alamat);
              $('#showstatus').val(response.result.STATUS);
              $('#showfoto').attr('src', '/storage/user/' + response.result.foto);
          }
      });
    });
</script>