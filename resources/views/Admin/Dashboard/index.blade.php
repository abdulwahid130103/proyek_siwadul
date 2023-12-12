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
                                    <h4>Statistik</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartPengaduan"></canvas>
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
            

            var ctx = document.getElementById("chartPengaduan").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($days) !!},
                    datasets: [{
                        label: 'Statistics',
                        data: {!! json_encode(array_values($dataCounts)) !!},
                        borderWidth: 2,
                        backgroundColor: '#6777ef',
                        borderColor: '#6777ef',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f2f2f2',
                            },
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1 // Sesuaikan dengan kebutuhan Anda
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: true
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                }
            });

        </script>
    @endslot

</x-admin.app>
