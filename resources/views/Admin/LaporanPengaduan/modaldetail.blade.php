<div class="modal fade" tabindex="-1" role="dialog" id="modaldetail">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Pengaduan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Kode Pengaduan</label>
                            <input type="text" id="showkodepengaduang" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>User Pengadu</label>
                            <input type="email" id="showkodeuser" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6" id="showkodeusertujuanparent">
                        <div class="form-group">
                            <label>User Tujuan</label>
                            <input type="text" id="showkodeusertujuan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Judul Pengaduan</label>
                            <input type="text" id="showjudulpengaduan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <input type="text" id="showjenispengaduan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" id="showstatus" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Status Data</label>
                            <input type="text" id="showstatusdata" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Pengaduan</label>
                            <input type="text" id="showtanggalpengaduan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Kejadian</label>
                            <input type="text" id="showtanggalkejadian" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="showtanggalselesaipengaduanparent">
                            <label>Tanggal Selesai Pengaduan</label>
                            <input type="text" id="showtanggalselesaipengaduan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi Pengaduan</label>
                            <textarea type="text" id="showdeskripsipengaduan" style="height: 8rem;" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12" id="showgambarpengaduanparent">
                        <div class="card" >
                            <div class="card-body">
                              <div class="mb-2 text-muted">Foto Bukti Pengaduan</div>
                              <div class="chocolat-parent">
                                  <div data-crop-image="285">
                                    <img alt="image" src="#" id="showgambarpengaduan" class="img-fluid">
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" id="showdeskripsipenyelesaianparent">
                        <div class="form-group">
                            <label>Deskripsi Penyelesaian</label>
                            <textarea type="text" id="showdeskripsipenyelesaian" style="height: 8rem;" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12" id="showbuktiselesaiparent">
                        <div class="card" >
                            <div class="card-body">
                              <div class="mb-2 text-muted">Foto Bukti Penyelesaian</div>
                              <div class="chocolat-parent">
                                  <div data-crop-image="285">
                                    <img alt="image" src="#" id="showbuktiselesai" class="img-fluid">
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>