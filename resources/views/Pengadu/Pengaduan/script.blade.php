<script>
	$(function () {
		// let loadingAlert = $('.modal-body #loading-alert');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		// create data 
		$('body').on('click', '.simpan-data', function(e) {
            e.preventDefault();
            var formData = new FormData($('#addForm')[0]);
            formData.append('kd_user', $('#tambahkodeuser').val());
            formData.append('judul_pengaduan', $('#tambahjudulpengaduan').val());
            formData.append('kd_jenis_pengaduan', $('#tambahjenispengaduan').val());
            formData.append('tanggal_kejadian', $('#tambahtanggalkejadian').val());
            formData.append('deskripsi_pengaduan', $('#tambahdeskripsipengaduan').val());
            // formData.append('status_data', $('input[name="editstatusdata"]:checked').val());
            formData.append('gambar_pengaduan', $('input[type=file]')[0].files[0]); 
            $.ajax({
                url: '/pengaduan',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                success: function(response) {

                    if(response.status == 0){
                        var errorMessages = "<ul>";
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

                }
            });
            $('#addForm')[0].reset();  // Use [0] to access the actual form element
        });
	});
</script>
