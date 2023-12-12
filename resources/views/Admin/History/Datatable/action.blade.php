<div class="btn-group" role="group">
    <div class="mx-1">
      <div class="btn-group" role="group">
        <div class="dropdown d-inline">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-eyedropper" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon tombol-detail" data-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#modaldetail" href="javascript:void(0)"><i class="far fa-eye"></i>Detail</a>
              @if ($model->STATUS == "ditinjau")
                <a class="dropdown-item has-icon tombol-edit" href="javascript:void(0)" data-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#modaledit"><i class="far fa-edit"></i> Edit</a>
              @endif
              @if ($model->STATUS == "ditinjau")
                <a class="dropdown-item has-icon tombol-hapus" href="javascript:void(0)" data-id="{{ $model->id }}" ><i class="fas fa-times"></i> Hapus</a>
              @endif
            </div>
        </div>
      </div>
    </div>
  </div>
  