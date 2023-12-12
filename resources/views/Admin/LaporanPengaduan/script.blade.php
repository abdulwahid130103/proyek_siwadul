<script type="text/javascript">
   
	$(document).ready(function () {
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
                url : "/admin/laporanPengaduan",
                data : function(data){
                    data.from_date = start_date;
                    data.to_date = end_date;
                }
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0,1,2,3,4,6,7,8]
                    },
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0,1,2,3,4,6,7,8]
                    },
                    text: '<i class="fas fa-file-csv"></i> CSV',
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,6,7,8]
                    },
                    text: '<i class="fas fa-file-excel"></i> Excel',
                }
            ],
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
                    data: 'status_data',
                    name: 'status_data',
                    render: function (data, type, full, meta) {
                        var isNonaktif = (data == 'private');
                        var badgeClass = isNonaktif ? 'badge badge-warning' : 'badge badge-success';
                        return '<div class="badge ' + badgeClass + '">' + data + '</div>';
                    }
                },
				{ 
					data: 'jabatan',  // Assuming the relationship is user -> jabatan
					name: 'jabatan',
					visible: false,  // Make this column invisible
				},
                {
                    data: 'tanggal_kejadian',
                    name: 'tanggal_kejadian',
                    render: function(data) {
                        var value = moment(data).format('DD/MM/YYYY');
                        return value;
                    }
                },
                {
                    data: 'tanggal_pengaduan',
                    name: 'tanggal_pengaduan',
                    render: function(data) {
                        var value = moment(data).format('DD/MM/YYYY');
                        return value;
                    }
                },
				{ data: 'action', name: 'action' },
			],
			initComplete: function () {
				$('#filterStatusData').on('change', function () {
					var status_data = $(this).val();
					$('#datatable').DataTable().columns(5).search(status_data == '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(status_data) + '$', true, false).draw(); 
				});
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
