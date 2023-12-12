<div class="modal fade" tabindex="-1" role="dialog" id="modalpassword">
    <form id="passwordForm">
    @csrf
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ganti Password User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fas fa-lock"></i>
                                </div>
                              </div>
                              <input type="password" class="form-control" id="gantipassword" placeholder="Password">
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary password-data">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>