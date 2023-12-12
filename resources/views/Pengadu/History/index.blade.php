<x-pengadu.app>
    @slot('title')
        History
    @endslot
    @slot('style')
        <style>
            .card{
                border: none;
                box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,
                            rgba(0,0,0,0.3) 0px 3px 7px -3px;
            }
            #bg-konten{
                filter: brightness(0.6) !important;
            }
            .crd{
                width: 100%;
                height: 300px;
                position: relative !important;
                box-sizing: border-box;
                transform: translateY(-80px);
            }
            #bg-conten-2{
                height: 256px;
                background: #FFC436;
            }
        </style>

        <link rel="stylesheet" href="{{ asset('frontend/dataTable/css/dataTable.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />   

    @endslot
    @slot('content')
        @include('pengadu.history.modaldetail')
        <section>
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        {{-- <div class="d-block w-100" style="width: 100%; height:600px; background:#337CCF;"></div> --}}
                        <img src="{{ asset('frontend/image/carousel.png') }}" height="600px"
                         class="d-block w-100" id="bg-konten" alt="konten">
                    </img>
                </div>
            </div>
            <div class="container" style="margin-bottom: 100px;">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card crd" style="width: 100%;height:auto;padding:2rem 1rem;">
                            <div class="card-body">
                                <h5 class="card-title text-start text-light" style="
                                    background:  linear-gradient(90deg, rgba(25, 29, 136, 0.45) 39.84%, 
                                    rgba(255, 196, 54, 0.45) 77.94%);padding:20px 0;padding-left:3rem;border-radius:20px;">AduanKU</h5>
                            </div>
                        </div>
                        <table class="table-striped table" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengaduan</th>
                                    <th>Judul Pengaduan</th>
                                    <th>Status</th>
                                    {{-- <th>Tanggal Kejadian</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 mt-4">
                        <h6 class="mb-4">Filter</h6>
                        <div class="" style="width: 100%; height:2px; background:rgba(0, 0, 0, 0.17);"></div>
                        <div class="mb-3 mt-2" style="margin-bottom:1rem !important;">
                            <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                            <div class="form-group" >
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text" style="height: 2.65rem;border-radius:5px 0 0 5px;">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    </div>
                                    <input style="border-radius: 0 5px 5px 0;height:2.65rem;" type="text" class="form-control pull-right" id="datesearch" placeholder=" -- Filter tanggal pengaduan --" /> 
                                </div>
                            </div>
                        </div>
                        <div class="mt-2" style="width: 100%; height:2px; background:rgba(0, 0, 0, 0.17);"></div>
                        <div class="mb-3 mt-2">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" data-status="" name="filter_status" id="filter_status" checked>
                                <label class="form-check-label" for="filter_status">
                                  All  <span class="badge rounded-pill text-bg-primary">{{ $countPengaduan }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" data-status="Ditolak" name="filter_status" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                  Ditolak <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanDitolak }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" data-status="Ditinjau" name="filter_status" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                  Ditinjau <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanDitinjau }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" name="filter_status" data-status="Terkonfirmasi" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                  Terkonfirmasi <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanTerkonfirmasi }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" name="filter_status" data-status="Tersampaikan" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                  Tersampaikan <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanTersampaikan }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" name="filter_status" data-status="Proses" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                    Proses <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanProses }}</span> 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter_status" type="radio" name="filter_status" data-status="Selesai" id="filter_status">
                                <label class="form-check-label" for="filter_status">
                                    Selesai <span class="badge rounded-pill text-bg-primary">{{ $countPengaduanSelesai }}</span> 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endslot

    @slot('script')
    <script src="{{ asset('frontend/dataTable/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/dataTable/js/dataTable.min.js') }}"></script>
    <script src="{{ asset('frontend/dataTable/js/dataTable.bootstrap.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.js"></script>
    <script
    type="text/javascript"
    src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"
    ></script>
    <script
    type="text/javascript"
    src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"
    ></script>
    @include('pengadu.history.script')
    @endslot
</x-pengadu.app>