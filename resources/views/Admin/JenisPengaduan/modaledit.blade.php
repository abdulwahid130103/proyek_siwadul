<div class="modal fade" tabindex="-1" role="dialog" id="modaledit">
    <form id="editForm">
    @csrf
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Jenis Pengaduan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nama Jenis Pengaduan</label>
                            <input type="text" id="editjenispengaduan" placeholder="Masukkan nama jenis pengaduan ...." class="form-control" required>
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