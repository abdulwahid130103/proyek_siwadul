<div class="modal fade" tabindex="-1" role="dialog" id="modaledit">
    <form id="editForm" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="editnama" placeholder="Masukkan nama user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="editemail" placeholder="Masukkan email user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jabatan</label>  
                            <select class="form-control select2" id="editjabatan"></select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Kode User</label>
                            <input type="text" id="editkodeuser" placeholder="Masukkan kode user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Status</label>  
                            <select class="form-control select2" id="editstatus"></select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="editalamat" placeholder="Masukkan alamat user ...." class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <figure class="avatar mr-2 avatar-xl" style="margin-right: 1rem;">
                            <img id="get_foto" src="" alt="Gambar Lama">
                        </figure>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" id="editfoto"  class="form-control">
                            <input type="hidden" id="editfotolama"  class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary edit-data">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>