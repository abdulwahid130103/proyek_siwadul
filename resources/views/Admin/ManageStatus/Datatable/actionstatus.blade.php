@if (Auth::user()->jabatan->nama_jabatan == "admin" && $model->STATUS == "selesai")
    <div class="from-group">
        <a href="javascript:void(0)" class="confirm-status-data" data-id="{{ $model->id }}">
            <label class="custom-switch mt-2">
                <input type="checkbox" name="st_data" data-id="{{ $model->id }}"  id="st_data" 
                class="custom-switch-input st_data" @if ($model->status_data == "public") checked @endif>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">{{ $model->status_data }}</span>
            </label>
        </a>
    </div>
@endif