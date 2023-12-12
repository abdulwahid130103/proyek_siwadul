<div class="modal fade" tabindex="-1" role="dialog" id="modaltambah">
    <form id="addForm" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User</h5>
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
                            <input type="text" id="tambahnama" placeholder="Masukkan nama user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="tambahemail" placeholder="Masukkan email user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="tambahpassword" placeholder="Masukkan Password user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jabatan</label>  
                            <select class="form-control select2" id="tambahjabatan">
                                @foreach ($jabatan as $item)  
                                    <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Kode User</label>
                            <input type="text" id="tambahkodeuser" placeholder="Masukkan kode user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="tambahalamat" placeholder="Masukkan alamat user ...." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Status</label>  
                            <select class="form-control select2" id="tambahstatus">
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" id="tambahfoto"  class="form-control">
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