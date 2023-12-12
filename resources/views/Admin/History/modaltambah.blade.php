<div class="modal fade" tabindex="-1" role="dialog" id="modaltambah">
    <form id="addForm" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengaduan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" id="tambahkodeuser" placeholder="Masukkan judul pengaudan ...." value="{{ Auth::user()->id }}" class="form-control" required>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Judul Pengaduan</label>
                            <input type="text" id="tambahjudulpengaduan" placeholder="Masukkan judul pengaudan ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <select class="form-control select2" name="tambahjenispengaduan" id="tambahjenispengaduan">
                                @foreach ($jenisPengaduan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_jenis_pengaduan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Kejadian</label>
                            <input type="text" id="tambahtanggalkejadian" name="tambahtanggalkejadian" class="form-control datetimepicker">
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Data Status</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" id="tambahstatusdata" name="tambahstatusdata" value="public" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">Public</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" id="tambahstatusdata" name="tambahstatusdata" value="private" class="selectgroup-input">
                                    <span class="selectgroup-button">Private</span>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Gambar Pengaduan</label>
                            <input type="file" id="tambahgambarpengaduan"  class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi Pengaduan</label>
                            <textarea id="tambahdeskripsipengaduan" style="height: 8rem;" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary simpan-data">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>