@if (Auth::user())
  <!-- Modal -->

  <div class="modal fade" tabindex="-1" role="dialog" id="profileModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Profile User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <form id="editForm" enctype="multipart/form-data"> --}}
            <input type="hidden" value="{{ Auth::user()->id }}" id="id_user">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12 d-flex justify-content-center mb-4">
                    <img class="ms-2" src="" id="profilefoto" style="width:180px; height:180px; border-radius:50%;" alt="">
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Nama</label>
                          <input type="text" id="profilenama" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Email</label>
                          <input type="email" id="profileemail" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Jabatan</label>
                          <input type="text" id="profilejabatan" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Kode User</label>
                          <input type="text" id="profilekodeuser" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" id="profilealamat" class="form-control" disabled>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Status</label>
                          <input type="text" id="profilestatus" class="form-control" disabled>
                      </div>
                  </div>
              </div>
          </div>
          {{-- </form> --}}
        </div>
      </div>
    </div>
  </div>
@endif


<script>

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#tombol-profile').click(function(e){
    e.preventDefault();
    $('#profileModal').modal('show');
    var id = $('#id_user').val();
    console.log(id);
    $.ajax({
        url: 'adminProfile/' + id,
        type: 'GET',
        success: function(response) {
            $('#profilenama').val(response.result.nama);
            $('#profileemail').val(response.result.email);
            $('#profilejabatan').val(response.jabatan.nama_jabatan);
            $('#profilekodeuser').val(response.result.kode_user);
            $('#profilealamat').val(response.result.alamat);
            $('#profilestatus').val(response.result.STATUS);
            $('#profilefoto').attr('src', '/storage/user/' + response.result.foto);
        }
    });
  });

    $(document).ready(function () {

        $.ajax({
            url: 'notifications/',
            type: 'GET',
            success: function (response) {
                // Clear existing content
                $('.dropdown-list-content').empty();

                console.log(response.result);
                console.log(response.result.judul);
                // Append data from the response
                if (response && response.result) {

                  $.each(response.result, function (key, value) {
                      const timeAgo = moment(value.created_at).locale('id').fromNow();
                      const historyRoute = "history";
                      $('.dropdown-list-content').append(`
                          <a href="${historyRoute}" class="dropdown-item">
                              <div class="dropdown-item-icon bg-info text-white">
                                  <i class="fas fa-bell"></i>
                              </div>
                              <div class="dropdown-item-desc">
                                  ${value.deskripsi}
                                  <div class="text-primary">${timeAgo}</div>
                              </div>
                          </a>
                      `);
                  });


                } else {
                    // Handle empty or invalid response
                    $('.dropdown-list-content').append("<p>Tidak ada notifikasi ditemukan</p>");
                }
            },
            error: function (error) {
                console.error('Error fetching notifications:', error);
            }
        });
    });

</script>