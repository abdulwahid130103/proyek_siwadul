<x-admin.app >

    @slot('title')
        General Dashboard
    @endslot

    @slot('type_menu')
        dashboard
    @endslot
    @slot('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet"
            href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
             <!-- CSS Libraries -->
        <link rel="stylesheet"
        href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
        <style>
            .active-chart{
                background: #6777ef !important;
                color: #fff !important;
            }
        </style>
    @endslot

    @slot('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengadu</h4>
                                </div>
                                <div class="card-body">
                                    {{ $pengadu }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pengaduan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $pengaduan }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jabatan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $jabatan }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jenis Pengaduan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $jenis }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi')
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row" style="width: 100%;">
                                        <div class="col-lg-12 d-flex justify-content-between align-items-center mb-4" style="width: 100%;">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status active" href="javascript:void(0)" data-statuschart="">All </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Ditolak">Ditolak</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Ditinjau">Ditinjau </span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Terkonfirmasi">Terkonfirmasi </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Tersampaikan">Tersampaikan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Proses">Proses</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link filter-status" href="javascript:void(0)" data-statuschart="Selesai">Selesai</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-between align-items-center">
                                            <h4>Statistik</h4>
                                            <div class="card-header-action">
                                                <div class="btn-group">
                                                    <a href="javascript:void(0)" data-chart="minggu"
                                                        class="btn filter_statistik active-chart">Minggu</a>
                                                    <a href="javascript:void(0)" data-chart="bulan"
                                                        class="btn filter_statistik">Bulan</a>
                                                    <a href="javascript:void(0)" data-chart="tahun"
                                                        class="btn filter_statistik">Tahun</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartPengaduanMinggu" class="minggu-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Pengaduan Terbaru</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        @foreach ($pengaduanlist as $data)        
                                            <li class="media">
                                                <figure class="avatar mr-2" style="height: 50px;width:50px;">
                                                    <img src="{{ asset('storage/user/' . $data->user->foto) }}" alt="gambar">
                                                </figure>
                                                <div class="media-body">
                                                    <div class="text-primary float-right">{{ \Carbon\Carbon::parse($data->tanggal_pengaduan)->locale('id')->diffForHumans() }}</div>
                                                    <div class="media-title">{{ $data->user->nama }}</div>
                                                    <span class="text-small text-muted">{{ \Illuminate\Support\Str::limit($data->judul_pengaduan, $limit = 50, $end = '...') }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi') 
                                        <div class="pt-1 pb-1 text-center">
                                            <a href="{{ url("admin/pengaduan") }}"
                                                class="btn btn-primary btn-lg btn-round">
                                                Lihat semua
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    @endslot

    @slot('script')
        <!-- JS Libraies -->
        <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/modules-chartjs.js') }}"></script>
        <script src="{{ asset('js/page/index-0.js') }}"></script>

        <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            // Fungsi untuk mengonversi nama hari ke bahasa Indonesia
            function convertToIndonesianDay(day) {
                const daysInEnglish = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const daysInIndonesian = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                const index = daysInEnglish.indexOf(day);

                if (index !== -1) {
                    return daysInIndonesian[index];
                } else {
                    return day; // Jika tidak ditemukan, kembalikan nilai asli
                }
            }
            function clearChart() {
                if (window.myTahunChart) {
                    window.myTahunChart.destroy();
                }
                if (window.myBulanChart) {
                    window.myBulanChart.destroy();
                }
                if (window.myMingguChart) {
                    window.myMingguChart.destroy();
                }
            }

            let dataStatusChart = '';
            let dataFilterChart = 'minggu';

            function pantauPerubahan() {
                if(dataFilterChart == 'minggu'){
                    chartMinggu(dataStatusChart);
                }else if(dataFilterChart == 'bulan'){
                    chartBulan(dataStatusChart);
                }else if(dataFilterChart == 'tahun'){
                    chartTahun(dataStatusChart);
                }
            }

            function chartMinggu(statusChart) {

                var ctx = $('.minggu-chart')[0].getContext('2d');

               clearChart()
                $.ajax({
                    url: 'showChartMinggu',
                    type: 'GET',
                    data: {
                        STATUS : statusChart,
                    },
                    success: function(response) {
                        if (response && response.success) {

                            var hariPengaduanArray = [];
                            var jumlahPengaduanArray = [];

                            // Iterasi pada objek respons
                            response.success.forEach(function (data) {
                                // Ekstrak nilai hari_pengaduan dan jumlah_pengaduan
                                var hariPengaduan = data.hari_pengaduan;
                                var jumlahPengaduan = data.jumlah_pengaduan;

                                // Tambahkan nilai ke array masing-masing
                                hariPengaduanArray.push(hariPengaduan);
                                jumlahPengaduanArray.push(jumlahPengaduan);
                                
                            });

                            hariPengaduanArray = hariPengaduanArray.map(day => convertToIndonesianDay(day));

                            window.myMingguChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: hariPengaduanArray,
                                    datasets: [{
                                        label: 'Statistics',
                                        data: jumlahPengaduanArray,
                                        borderWidth: 2,
                                        backgroundColor: '#6777ef',
                                        fill: false,
                                        borderColor: '#6777ef',
                                        borderWidth: 2.5,
                                        pointBackgroundColor: '#ffffff',
                                        pointRadius: 4
                                    }]
                                },
                            });

                        
                        }
                    }
                });
          
            }
            function chartBulan(statusChart) {

                var ctx = $('.bulan-chart')[0].getContext('2d');

               clearChart()
                $.ajax({
                    url: 'showChartBulan',
                    type: 'GET',
                    data: {
                        STATUS : statusChart,
                    },
                    success: function(response) {
                        if (response && response.success) {

                            console.log(response.success);
                            var tanggalPengaduanArray = [];
                            var jumlahPengaduanArray = [];

                            // Iterasi pada objek respons
                            response.success.forEach(function (data) {
                                // Ekstrak nilai hari_pengaduan dan jumlah_pengaduan
                                var tanggalPengaduan = data.tanggal;
                                var jumlahPengaduan = data.jumlah_pengaduan;

                                // Tambahkan nilai ke array masing-masing
                                tanggalPengaduanArray.push(tanggalPengaduan);
                                jumlahPengaduanArray.push(jumlahPengaduan);
                                
                            });

                            window.myBulanChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: tanggalPengaduanArray,
                                    datasets: [{
                                        label: 'Statistics',
                                        data:jumlahPengaduanArray,
                                        fill: false,
                                        tension: 0.1,
                                        borderColor: '#6777ef',
                                    }]
                                },
                            });

                        
                        }
                    }
                });
          
            }
            function chartTahun(statusChart) {

                var ctx = $('.tahun-chart')[0].getContext('2d');

               clearChart()
                $.ajax({
                    url: 'showChartTahun',
                    type: 'GET',
                    data: {
                        STATUS : statusChart,
                    },
                    success: function(response) {
                        if (response && response.success) {

                            console.log(response.success);
                            var bulanPengaduanArray = [];
                            var jumlahPengaduanArray = [];

                            // Iterasi pada objek respons
                            response.success.forEach(function (data) {
                                // Ekstrak nilai hari_pengaduan dan jumlah_pengaduan
                                var bulanPengaduan = data.bulan;
                                var jumlahPengaduan = data.jumlah_pengaduan;

                                // Tambahkan nilai ke array masing-masing
                                bulanPengaduanArray.push(bulanPengaduan);
                                jumlahPengaduanArray.push(jumlahPengaduan);
                                
                            });

                            window.myTahunChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: bulanPengaduanArray,
                                    datasets: [{
                                        label: 'Statistics',
                                        data:jumlahPengaduanArray,
                                        fill: false,
                                        tension: 0.1,
                                        borderColor: '#6777ef',
                                    }]
                                },
                            });

                        
                        }
                    }
                });
          
            }
           


            $('.filter-status').click(function(){
                var data_chart = $(this).data('statuschart');
                $('.filter-status').removeClass('active');
                $(this).addClass('active');
                dataStatusChart = data_chart;
                pantauPerubahan()
            });

            

            $(document).ready(function(){
                pantauPerubahan()
                $('.filter_statistik').click(function(){
                    var data_chart = $(this).data('chart');
                    if(data_chart == 'minggu'){
                        dataFilterChart = 'minggu';
                        $('.filter_statistik').removeClass('active-chart');
                        $(this).addClass('active-chart');
                        $('canvas').removeClass();
                        $('canvas').addClass('minggu-chart');
                        pantauPerubahan()
                    }else if(data_chart == 'bulan'){
                        dataFilterChart = 'bulan';
                        $('.filter_statistik').removeClass('active-chart');
                        $(this).addClass('active-chart');
                        $('canvas').removeClass();
                        $('canvas').addClass('bulan-chart');
                        pantauPerubahan()
                    }else if(data_chart == 'tahun'){
                        dataFilterChart = 'tahun';
                        $('.filter_statistik').removeClass('active-chart');
                        $(this).addClass('active-chart');
                        $('canvas').removeClass();
                        $('canvas').addClass('tahun-chart');
                        pantauPerubahan()
                    }
                });
                
            });
          
           

        </script>
    @endslot

</x-admin.app>
