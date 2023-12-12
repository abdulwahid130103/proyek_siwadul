<script>
	$(function () {
		// let loadingAlert = $('.modal-body #loading-alert');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // index table show data
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('user.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                   searchable: false 
                },
				{ data: 'kode_user', name: 'kode_user' },
				{ data: 'nama', name: 'nama' },
				{ data: 'email', name: 'email' },
				{ data: 'kd_jabatan', name: 'kd_jabatan' },
				{
                    data: 'STATUS',
                    name: 'STATUS',
                     orderable: false, 
                    render: function (data, type, full, meta) {
                        var isNonaktif = (data == 'non-aktif');
                        var badgeClass = isNonaktif ? 'badge badge-danger' : 'badge badge-success';
                        return '<div class="badge ' + badgeClass + '">' + data + '</div>';
                    }
                },
				{ data: 'foto',
                  name: 'foto',
                  render: function (data, type, full, meta) {
                    var assetUrl = "{{ asset('storage/user/') }}";
                    return '<figure class="avatar mr-2"><img src="' + assetUrl + '/' + data + '" alt="foto" style="object-fit: cover;"></figure>';
                  }
                },
				{ data: 'action', name: 'action' },
			],
            initComplete: function () {
                $('#filterStatus').on('change', function () {
                    var status = $(this).val();
                    $('#datatable').DataTable().columns(5).search(status == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status) + '$', true, false).draw(); 
                });
                $('#filterJabatan').on('change', function () {
                    var jabatan = $(this).val();
                    $('#datatable').DataTable().columns(4).search(jabatan == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(jabatan) + '$', true, false).draw(); 
                });
            }
		});

        // show data
        $('body').on('click', '.tombol-detail', function(e) {
            e.preventDefault();
            $('#modaldetail').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/user/' + id,
                type: 'GET',
                success: function(response) {
                    $('#shownama').val(response.result.nama);
                    $('#showemail').val(response.result.email);
                    $('#showjabatan').val(response.jabatan.nama_jabatan);
                    $('#showkodeuser').val(response.result.kode_user);
                    $('#showalamat').val(response.result.alamat);
                    $('#showstatus').val(response.result.STATUS);
                    $('#showfoto').attr('src', '/storage/user/' + response.result.foto);
                }
            });
        });

        // ganti password
        $('body').on('click', '.tombol-password', function(e) {
            e.preventDefault();
            $('#modalpassword').modal('show');
            var id = $(this).data('id');
            $('.password-data').off('click').on('click',function() {
                $.ajax({
                    url: '/admin/user/' + id + '/password',
                    type: 'PUT',
                    data: {
                        password : $('#gantipassword').val()
                    },
                    success: function(response) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        $('#modalpassword').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    }
                });
            });
        });

        // create data 
        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#modaltambah').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                var formData = new FormData($('#addForm')[0]);
                formData.append('nama', $('#tambahnama').val());
                formData.append('email', $('#tambahemail').val());
                formData.append('password', $('#tambahpassword').val());
                formData.append('kd_jabatan', $('#tambahjabatan').val());
                formData.append('kode_user', $('#tambahkodeuser').val());
                formData.append('alamat', $('#tambahalamat').val());
                formData.append('STATUS', $('#tambahstatus').val());
                formData.append('gambar', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '/admin/user',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,  // Important to prevent jQuery from automatically transforming the data into a query string
                    success: function(response) {

                        if(response.status == 0){
                            var errorMessages = "<ul>";
                            console.log(response.errors);
                            $.each(response.errors, function (key, value) {
                                errorMessages += "<li>" + value + "</li>";
                            });
                            errorMessages += "</ul>";

                            iziToast.error({
                                message: errorMessages,
                                position: 'topRight'
                            });
                        }else{
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                        $('#modaltambah').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    }
                });
                $('#addForm')[0].reset();  // Use [0] to access the actual form element
            });
        });

        // update data
        $('body').on('click', '.tombol-edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/user/' + id + '/edit',
                type: 'GET',
                success: function(response) {

                    $("#editForm").prop('disabled', false);
                    $("#addForm").prop('disabled', true);
                    $('#modaledit').modal('show');
                    $('#editForm #editjabatan').empty();
                    $.each(response.jabatan, function(key, value) {
                        if (value.id == response.result.kd_jabatan) {
                            $('#editForm #editjabatan').append('<option value="' + value.id + '" selected>' + value.nama_jabatan + '</option>');
                        } else {
                            $('#editForm #editjabatan').append('<option value="' + value.id + '">' + value.nama_jabatan + '</option>');
                        }
                    });

                    $('#editForm #get_foto').attr("src","{{  asset('storage/user/') }}"+"/"+response.result.foto);
                    $('#editForm #editnama').val(response.result.nama);
                    $('#editForm #editfotolama').val(response.result.foto);
                    $('#editForm #editemail').val(response.result.email);
                    $('#editForm #editkodeuser').val(response.result.kode_user);
                    $('#editForm #editalamat').val(response.result.alamat);

                    $('#editForm #editstatus').empty();
                    if ($('#editForm #editstatus option').length === 0) {
                        $('#editForm #editstatus').append('<option value="aktif">Aktif</option>');
                        $('#editForm #editstatus').append('<option value="non-aktif">Non Aktif</option>');
                    }
                    var selectedValue = response.result.STATUS.toLowerCase() === 'non-aktif' ? 'non-aktif' : 'aktif';
                    $('#editForm #editstatus').val(selectedValue).prop('selected', true);

                    var idNew = response.result.id;
                    $('.edit-data').off('click').on('click',function() {
                        var formData = new FormData($('#editForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('nama', $('#editForm #editnama').val());
                        formData.append('email', $('#editForm #editemail').val());
                        formData.append('kd_jabatan', $('#editForm #editjabatan').val());
                        formData.append('kode_user', $('#editForm #editkodeuser').val());
                        formData.append('alamat', $('#editForm #editalamat').val());
                        formData.append('STATUS', $('#editForm #editstatus').val());
                        formData.append('foto_lama', $('#editForm #editfotolama').val());
                        formData.append('foto_baru', $('#editForm input[type=file]')[0].files[0]); 
                        $.ajax({
                            url: '/admin/user/' + idNew,
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success:function(response){
                                if(response.status == 0){
                                    var errorMessages = "<ul>";
                                    console.log(response.errors);
                                    $.each(response.errors, function (key, value) {
                                        errorMessages += "<li>" + value + "</li>";
                                    });
                                    errorMessages += "</ul>";

                                    iziToast.error({
                                        message: errorMessages,
                                        position: 'topRight'
                                    });
                                }else{
                                    iziToast.success({
                                        title: 'Berhasil',
                                        message: response.success,
                                        position: 'topRight'
                                    });
                                }
                                $('#modaledit').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
                            }
                        });
                        $('#editForm')[0].reset(); 
                    });
                }
            });
        });

        // delete data
        $('body').on('click', '.tombol-hapus', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
            title: 'Apakah anda yakin?',
            text: 'ingin menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: '/admin/user/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });


        $('#modaltambah').on('hidden.bs.modal',function(){
            $('#modaltambah #tambahnama').val('');
            $('#modaltambah #tambahemail').val('');
            $('#modaltambah #tambahpassword').val('');
            $('#modaltambah #tambahkodeuser').val('');
            $('#modaltambah #tambahalamat').val('');
        });
        $('#modalpassword').on('hidden.bs.modal',function(){
            $('#modalpassword #gantipassword').val('');
        });
		
	});
</script>
