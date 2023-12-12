<script>
    $('body').on('click', '.button-kode-pengaduan', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/beranda',
            type: 'POST',
            data: { 
                kode_pengaduan: $('#cari').val()
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                        $('#data-detail').append(`<tr>`);
                        $.each(response.success,function(key,value){
                            $('#data-detail').append(`<td>${value}</td>`);
                        });
                        $('#data-detail').append(`</tr>`);
                        $('#modaldetail').modal("show");
                } else if (response.error) {
                    iziToast.error({
                        message: response.error,
                        position: 'topRight'
                    });
                }
            }
        });
    });
</script>