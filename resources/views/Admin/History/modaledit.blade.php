<div class="modal fade" tabindex="-1" role="dialog" id="modaledit">
    <form id="editForm" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Pengaduan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" id="editkodeuser" placeholder="Masukkan judul pengaudan ...." value="{{ Auth::user()->id }}" class="form-control" required>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Judul Pengaduan</label>
                            <input type="text" id="editjudulpengaduan" placeholder="Masukkan judul pengaudan ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <select class="form-control select2" name="editjenispengaduan" id="editjenispengaduan">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Kejadian</label>
                            <input type="text" id="edittanggalkejadian" name="edittanggalkejadian" class="form-control datetimepicker">
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Data Status</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" id="editstatusdata" name="editstatusdata" value="public" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">Public</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" id="editstatusdata" name="editstatusdata" value="private" class="selectgroup-input">
                                    <span class="selectgroup-button">Private</span>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12" id="card-gambar-pengaduan">
                        <div class="card" >
                            <div class="card-body">
                              <div class="mb-2 text-muted">Foto Bukti Pengaduan</div>
                              <div class="chocolat-parent">
                                  <div data-crop-image="285">
                                    <img alt="image" src="#" id="get_foto" class="img-fluid">
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" id="editgambarpengaduan"  class="form-control">
                            <input type="hidden" id="editgambarpengaduanlama"  class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi Pengaduan</label>
                            <textarea id="editdeskripsipengaduan" style="height: 8rem;" class="form-control"></textarea>
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