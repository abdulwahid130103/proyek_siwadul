<div class="btn-group" role="group">

    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi' && $model->STATUS == "ditinjau")   
      <div class="mx-1">
        <a href="javascript:void(0)" class="btn btn-warning btn-md tombol-confirm-kaprodi" data-id="{{ $model->id }}">
          <i class="fa fa-check" aria-hidden="true"></i> Confirm
        </a>
      </div>
    @endif
    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi' && $model->STATUS == "ditinjau")   
      <div class="mx-1">
        <a href="javascript:void(0)" class="btn btn-danger btn-md tombol-tolak-kaprodi" data-id="{{ $model->id }}">
          <i class="fa fa-check" aria-hidden="true"></i> Tolak
        </a>
      </div>
    @endif
    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'admin' && $model->STATUS == "terkonfirmasi")   
      <div class="mx-1">
        <a href="javascript:void(0)" class="btn btn-warning btn-md tombol-confirm-admin" data-id="{{ $model->id }}">
          <i class="fa fa-check" aria-hidden="true"></i> Confirm
        </a>
      </div>
    @endif
    @if (Auth::check() && $model->STATUS == "tersampaikan" &&
    (Auth::user()->jabatan->nama_jabatan == 'kaprodi' ||
    Auth::user()->jabatan->nama_jabatan == 'adminprodi' ||
    Auth::user()->jabatan->nama_jabatan == 'laboran'))   
      <div class="mx-1">
        <a href="javascript:void(0)" class="btn btn-warning btn-md tombol-confirm-tersampaikan" data-id="{{ $model->id }}">
          <i class="fa fa-check" aria-hidden="true"></i> Confirm Proses
        </a>
      </div>
    @endif
    @if (Auth::check() && $model->STATUS == "proses" &&
    (Auth::user()->jabatan->nama_jabatan == 'kaprodi' ||
    Auth::user()->jabatan->nama_jabatan == 'adminprodi' ||
    Auth::user()->jabatan->nama_jabatan == 'laboran'))   
      <div class="mx-1">
        <a href="javascript:void(0)" class="btn btn-warning btn-md tombol-confirm-proses" data-id="{{ $model->id }}">
          <i class="fa fa-check" aria-hidden="true"></i> Confirm Selesai
        </a>
      </div>
    @endif
      <div class="mx-1">
        <div class="btn-group" role="group">
          <div class="mx-1">
            <div class="btn-group" role="group">
              <div class="dropdown d-inline">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-eyedropper" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item has-icon tombol-detail" data-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#modaldetail" href="javascript:void(0)"><i class="far fa-eye"></i>Detail</a>
                  </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
  </div>
  