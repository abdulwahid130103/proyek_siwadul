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
			ajax: "{{ url('/admin/history') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false, 
                    searchable: false 
                },
				{ data: 'kode_pengaduan', name: 'kode_pengaduan' },
                { 
                    data: 'user.nama',
                    name: 'kd_user',
                    render: function (data, type, full, meta) {
                        return data;
                    }
                },
				{ data: 'judul_pengaduan', name: 'judul_pengaduan' },
                {
                    data: 'STATUS',
                    name: 'STATUS',
                    render: function (data, type, full, meta) {
                        return '<div class="badge badge badge-success ">' + data + '</div>';
                    }
                },
				{
                    data: 'status_data',
                    name: 'status_data',
                    render: function (data, type, full, meta) {
                        var isNonaktif = (data == 'private');
                        var badgeClass = isNonaktif ? 'badge badge-warning' : 'badge badge-success';
                        return '<div class="badge ' + badgeClass + '">' + data + '</div>';
                    }
                },
                { data: 'tanggal_kejadian', name: 'tanggal_kejadian' },
				{ data: 'action', name: 'action' },
			],
			initComplete: function () {
				$('#filterStatusPengaduanData').on('change', function () {
					var status_data = $(this).val();
					$('#datatable').DataTable().columns(5).search(status_data == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status_data) + '$', true, false).draw(); 
				});
			    $('.filter-status').on('click', function () {
					$('.filter-status').removeClass('active');
    					$(this).addClass('active');
					var status = $(this).data('status');
					$('#datatable').DataTable().columns(4).search(status == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status) + '$', true, false).draw();
				});
            }
		});

		// create data 
		$('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#modaltambah').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                var formData = new FormData($('#addForm')[0]);
                formData.append('kd_user', $('#tambahkodeuser').val());
                formData.append('judul_pengaduan', $('#tambahjudulpengaduan').val());
                formData.append('kd_jenis_pengaduan', $('#tambahjenispengaduan').val());
                formData.append('tanggal_kejadian', $('#tambahtanggalkejadian').val());
                formData.append('deskripsi_pengaduan', $('#tambahdeskripsipengaduan').val());
                // formData.append('status_data', $('input[name="editstatusdata"]:checked').val());
                formData.append('gambar_pengaduan', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '/admin/history',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false, 
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
                url: '/admin/history/' + id + '/edit',
                type: 'GET',
                success: function(response) {

                    $("#editForm").prop('disabled', false);
                    $("#addForm").prop('disabled', true);
                    $('#modaledit').modal('show');
                    $('#editForm #editjenispengaduan').empty();
                    $.each(response.jenisPengaduan, function(key, value) {
                        if (value.id == response.result.kd_jenis_pengaduan) {
                            $('#editForm #editjenispengaduan').append('<option value="' + value.id + '" selected>' + value.nama_jenis_pengaduan + '</option>');
                        } else {
                            $('#editForm #editjenispengaduan').append('<option value="' + value.id + '">' + value.nama_jenis_pengaduan + '</option>');
                        }
                    });

                    var imageSrc = response.result.gambar_pengaduan;
                    if (imageSrc) {
                        $('#editForm #get_foto').attr("src", `{{ asset('storage/pengaduan/${imageSrc}' ) }} `);;
                        $('#editForm #card-gambar-pengaduan').removeClass("d-none");
                    } else {
                        $('#editForm #card-gambar-pengaduan').addClass("d-none");
                    }
                    $('#editForm #editjudulpengaduan').val(response.result.judul_pengaduan);
                    var tanggalKejadian = response.result.tanggal_kejadian;
                    var tanggalKejadianBaru = tanggalKejadian.substring(0, 16);
                    $('#editForm #edittanggalkejadian').val(tanggalKejadianBaru);
                    // $('#editForm input[name="editstatusdata"][value="' + response.result.status_data + '"]').prop("checked", true);
                    $('#editForm #editgambarpengaduanlama').val(response.result.gambar_pengaduan);
                    $('#editForm #editdeskripsipengaduan').val(response.result.deskripsi_pengaduan);

                    var idNew = response.result.id;
                    $('.edit-data').off('click').on('click',function() {
                        var formData = new FormData($('#editForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('judul_pengaduan', $('#editForm #editjudulpengaduan').val());
                        formData.append('kd_jenis_pengaduan', $('#editForm #editjenispengaduan').val());
                        formData.append('tanggal_kejadian', $('#editForm #edittanggalkejadian').val());
                        formData.append('deskripsi_pengaduan', $('#editForm #editdeskripsipengaduan').val());
                        // formData.append('status_data', $('input[name="editstatusdata"]:checked').val());
                        formData.append('foto_lama', $('#editForm #editgambarpengaduanlama').val());
                        formData.append('foto_baru', $('#editForm input[type=file]')[0].files[0]); 
                        $.ajax({
                            url: '/admin/history/' + idNew,
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
                        url: '/admin/history/' + id,
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
		
        // show data
        $('body').on('click', '.tombol-detail', function(e) {
            e.preventDefault();
            $('#modaldetail').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/pengaduan/' + id,
                type: 'GET',
                success: function(response) {
                    $('#showkodepengaduang').val(response.result.kode_pengaduan);
                    $('#showkodeuser').val(response.user.nama);
                    if(response.userTujuan){
                        $('#showkodeusertujuan').val(response.userTujuan.nama);
                        $('#showkodeusertujuanparent').removeClass("d-none");
                    }else{
                        $('#showkodeusertujuanparent').addClass("d-none");
                    }
                    $('#showjudulpengaduan').val(response.result.judul_pengaduan);
                    $('#showdeskripsipengaduan').val(response.result.deskripsi_pengaduan);
                    $('#showjenispengaduan').val(response.jenisPengaduan.nama_jenis_pengaduan);
                    $('#showstatus').val(response.result.STATUS);
                    $('#showstatusdata').val(response.result.status_data);
                    $('#showtanggalpengaduan').val(response.result.tanggal_pengaduan);
                    $('#showtanggalkejadian').val(response.result.tanggal_kejadian);
                    if(response.result.tanggal_selesai_pengaduan){
                        $('#showtanggalselesaipengaduan').val(response.result.tanggal_selesai_pengaduan);
                        $('#showtanggalselesaipengaduanparent').removeClass("d-none");
                    }else{
                        $('#showtanggalselesaipengaduanparent').addClass("d-none");
                    }
                    if(response.result.gambar_pengaduan){
                        $('#showgambarpengaduan').attr('src', '/storage/pengaduan/' + response.result.gambar_pengaduan);
                        $('#showgambarpengaduanparent').removeClass("d-none");
                    }else{
                        $('#showgambarpengaduanparent').addClass("d-none");
                    }
                    if(response.result.bukti_selesai){
                        $('#showbuktiselesai').attr('src', '/storage/penyelesaian/' + response.result.bukti_selesai);
                        $('#showbuktiselesaiparent').removeClass("d-none");
                    }else{
                        $('#showbuktiselesaiparent').addClass("d-none");
                    }
                    if(response.result.deskripsi_penyelesaian){
                        $('#showdeskripsipenyelesaian').val(response.result.deskripsi_penyelesaian);
                        $('#showdeskripsipenyelesaianparent').removeClass("d-none");
                    }else{
                        $('#showdeskripsipenyelesaianparent').addClass("d-none");
                    }
                }
            });
        });
		
	});
</script>
