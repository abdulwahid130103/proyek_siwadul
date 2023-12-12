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
			ajax: "{{ route('jenisPengaduan.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false, 
                    searchable: false 
                },
				{ data: 'nama_jenis_pengaduan', name: 'nama_jenis_pengaduan' },
				{ data: 'action', name: 'action' },
			]
		});

        // create data 
        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#modaltambah').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                $.ajax({
                    url: '/admin/jenisPengaduan',
                    type: 'POST',
                    data: {
                        nama_jenis_pengaduan : $('#tambahjenispengaduan').val()
                    },  // Important to prevent jQuery from automatically transforming the data into a query string
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
                url: '/admin/jenisPengaduan/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $("#editForm").prop('disabled', false);
                    $("#addForm").prop('disabled', true);
                    $('#modaledit').modal('show');
                    $('#editForm #editjenispengaduan').val(response.result.nama_jenis_pengaduan);
                    var idNew = response.result.id;
                    $('.edit-data').off('click').on('click',function() {
                        $.ajax({
                            url: '/admin/jenisPengaduan/' + idNew,
                            type: 'PUT',
                            data: {
                                nama_jenis_pengaduan : $('#editForm #editjenispengaduan').val()
                            },
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
                        url: '/admin/jenisPengaduan/' + id,
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

        // $('#modaltambah').on('hidden.bs.modal',function(){
        //     $('#modaltambah #tambahjabatan').val('');
        // });
		
	});
</script>
