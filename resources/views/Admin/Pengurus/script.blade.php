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
			ajax: "{{ url('/admin/pengurus') }}",
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
                        return '<div class="badge badge badge-primary">' + data + '</div>';
                    }
                },
				{ 
					data: 'jabatan',  // Assuming the relationship is user -> jabatan
					name: 'jabatan',
					visible: false,  // Make this column invisible
				},
                { data: 'tanggal_kejadian', name: 'tanggal_kejadian' },
                {
                    data: 'status_data',
                    name: 'status_data',
                    render: function (data, type, full, meta) {
                        var isNonaktif = (data == 'private');
                        var badgeClass = isNonaktif ? 'badge badge-warning' : 'badge badge-success';
                        return '<div class="badge ' + badgeClass + '">' + data + '</div>';
                    }
                },
				{ data: 'action', name: 'action' },
			],
			initComplete: function () {
				$('#filterJabatan').on('change', function () {
					var jabatan = $(this).val();
					$('#datatable').DataTable().columns(6).search(jabatan == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(jabatan) + '$', true, false).draw();
				});
                $('.filter-status').on('click', function () {
					$('.filter-status').removeClass('active');
    				$(this).addClass('active');
					var status = $(this).data('status');
					$('#datatable').DataTable().columns(4).search(status == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status) + '$', true, false).draw();
				});
            }
		});

        // konfirmasi data kaprodi
        $('body').on('click', '.tombol-confirm-kaprodi', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
            title: 'Apakah anda yakin?',
            text: 'ingin menkonfirmasi data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                        url: '/admin/pengurus/konfirmasiPengaduan/' + id,
                        type: 'PUT',
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
                swal('Cancel konfirmasi data!');
            }
            });
        });

        // tolak data kaprodi
        $('body').on('click', '.tombol-tolak-kaprodi', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
            title: 'Apakah anda yakin?',
            text: 'ingin menkonfirmasi data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                        url: '/admin/pengurus/tolakPengaduan/' + id,
                        type: 'PUT',
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
                swal('Cancel tolak data!');
            }
            });
        });

        // konfirmasi data tersampaikan
        $('body').on('click', '.tombol-confirm-tersampaikan', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
            title: 'Apakah anda yakin?',
            text: 'ingin menkonfirmasi data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                        url: '/admin/pengurus/konfirmasiTersampaikan/' + id,
                        type: 'PUT',
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
                swal('Cancel konfirmasi data!');
            }
            });
        });

        // update status data
        $(document).on('change', '.st_data', function() {
            var isChecked = $(this).prop('checked');
            // console.log("masuk");
            var statusData = isChecked ? 'public' : 'private';
            // console.log(statusData);
            var dataId = $(this).data("id");
            $.ajax({
                url: '/admin/pengurus/updateStatusData/' + dataId,
                type: 'PUT',
                data: { update_data: statusData },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        } else if (response.error) {
                            iziToast.error({
                                title: 'Gagal',
                                message: response.error,
                                position: 'topRight'
                            });
                        }
                }
            });
            $('#datatable').DataTable().ajax.reload();
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

        // konfirmasi admin
        $('body').on('click', '.tombol-confirm-admin', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#modalconfirmadmin').modal('show');
            $('.confirm-data').off('click').on('click',function() {
                // console.log($('#confirmusertujuan').val());
                $.ajax({
                    url: '/admin/pengurus/konfirmasiAdmin/' + id,
                    type: 'PUT',
                    data: {
                        kd_user_tujuan : $('#confirmusertujuan').val()
                    },
                    success: function(response) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        $('#modalconfirmadmin').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    }
                });
                $('#confirmAdminForm').reset();
            });
        });

        // konfirmasi proses
        $('body').on('click', '.tombol-confirm-proses', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#modalconfirmproses').modal('show');
            $('.confirm-proses').off('click').on('click',function() {
                var formData = new FormData($('#confirmProsesForm')[0]);
                formData.append('_method', 'PUT');
                formData.append('deskripsi_penyelesaian', $('#confirmProsesForm #tambahdeskripsipenyelesaian').val());
                formData.append('bukti_selesai', $('#confirmProsesForm input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '/admin/pengurus/konfirmasiSelesai/' + id,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        $('#modalconfirmproses').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    }
                });
                $('#confirmProsesForm').reset();
            });
        });

	});
</script>
