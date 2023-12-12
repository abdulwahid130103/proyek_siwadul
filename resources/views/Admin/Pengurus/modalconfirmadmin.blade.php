<div class="modal fade" tabindex="-1" role="dialog" id="modalconfirmadmin">
    <form id="confirmAdminForm">
    @csrf
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Pengaduan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>User Tujuan</label>
                            <select class="form-control select2" name="confirmusertujuan" id="confirmusertujuan">
                                @foreach ($user as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary confirm-data">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>