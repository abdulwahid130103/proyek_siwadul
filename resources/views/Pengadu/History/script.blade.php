<script>
	$(function () {
		// let loadingAlert = $('.modal-body #loading-alert');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // index table show data
        let start_date = "";
        let end_date = "";
        var $dTable = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
                url : "/history",
                data : function(data){
                    data.from_date = start_date;
                    data.to_date = end_date;
                }
            },
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false, 
                    searchable: false 
                },
				{ data: 'kode_pengaduan', name: 'kode_pengaduan' },
				{ data: 'judul_pengaduan', name: 'judul_pengaduan' },
                {
                    data: 'STATUS',
                    name: 'STATUS',
                    render: function (data, type, full, meta) {
                        return '<div class="badge text-bg-success" style="padding:0.7rem 2rem;border-radius:20px;">' + data + '</div>';
                    }
                },
				// { 
				// 	data: 'jabatan',  // Assuming the relationship is user -> jabatan
				// 	name: 'jabatan',
				// 	visible: false,  // Make this column invisible
				// },
                // { data: 'tanggal_kejadian', name: 'tanggal_kejadian' },
				{ data: 'action', name: 'action' },
			],
			initComplete: function () {
                $('.filter_status').on('click', function () {
					$('.filter_status').removeClass('active');
    				$(this).addClass('active');
					var status = $(this).data('status');
					$('#datatable').DataTable().columns(3).search(status == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status) + '$', true, false).draw();
				});
            }
		});

        $("#datesearch").daterangepicker({
          autoUpdateInput: false,
        });

        //menangani proses saat apply date range
        $("#datesearch").on("apply.daterangepicker", function (ev, picker) {
          $(this).val(
            picker.startDate.format("YYYY-MM-DD") +
              " - " +
              picker.endDate.format("YYYY-MM-DD")
          );
          start_date = picker.startDate.format("YYYY-MM-DD");
          end_date = picker.endDate.format("YYYY-MM-DD");
          $dTable.draw();
        });

        $("#datesearch").on("cancel.daterangepicker", function (ev, picker) {
          $(this).val("");
          start_date = "";
          end_date = "";
          $dTable.draw();
        });
        
		
        // show data
        $('body').on('click', '.tombol-detail', function(e) {
            e.preventDefault();
            $('#modaldetail').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: 'history/' + id,
                type: 'GET',
                success: function(response) {
                    $('#showkodepengaduang').val(response.result.kode_pengaduan);
                    $('#showkodeusernew').val(response.user.nama);
                    if(response.userTujuan){
                        $('#showkodeusertujuan').val(response.userTujuan.nama);
                        $('#showkodeusertujuanparent').removeClass("d-none");
                    }else{
                        $('#showkodeusertujuanparent').addClass("d-none");
                    }
                    $('#showjudulpengaduan').val(response.result.judul_pengaduan);
                    $('#showdeskripsipengaduan').val(response.result.deskripsi_pengaduan);
                    $('#showjenispengaduan').val(response.jenisPengaduan.nama_jenis_pengaduan);
                    $('#showstatusnew').val(response.result.STATUS);
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
