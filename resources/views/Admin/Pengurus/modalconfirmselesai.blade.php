<div class="modal fade" tabindex="-1" role="dialog" id="modalconfirmproses">
    <form id="confirmProsesForm" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Penyelesaian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi Penyelesaian</label>
                            <textarea type="text" id="tambahdeskripsipenyelesaian" style="height: 8rem;" placeholder="Masukkan deskripsi penyelesaian ...." class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Gambar Bukti Selesai</label>
                            <input type="file" id="tambahbuktiselesai"  class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary confirm-proses">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>