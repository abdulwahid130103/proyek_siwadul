<x-pengadu.app>
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
                background: #1450A3;
                border-radius: 50px;
                position: relative !important;
                box-sizing: border-box;
                transform: translateY(-180px);
            }
            #bg-conten-2{
                height: 256px;
                background: #FFC436;
            }
        </style>
    @endslot
    @slot('content')
        
        @include('Pengadu.Beranda.modaldetail')
        <section>
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="{{ asset('frontend/image/carousel.png') }}" height="600px"
                         class="d-block w-100" id="bg-konten" alt="konten">
                    </div>
                </div>
            </div>
            <div class="container" style="width:80%;">
                <div class="crd">
                    <div class="carousel-caption text-white" style="position: absolute; 
                        width:55rem !important;
                        transform :translateY(-60px) translateX(-30px);
                        ">
                        <h4 style="margin-bottom:50px;">Cek Status Aduan Anda</h4>
                        <form action="" class="d-flex justify-content-center" style="width: 100% !important;">
                            <div class="input-group d-flex justify-content-center" style="width: 100% !important;">
                                <span class="input-group-text" style="
                                    background: #fff !important; 
                                    border-color:#fff; 
                                    border-top-left-radius: 30px;
                                    border-bottom-left-radius: 30px;
                                    color:#000;">
                                <ion-icon name="search-outline"></ion-icon>
                                </span>
                                <input style=" 
                                border:none !important;
                                border-top-right-radius: 30px;
                                border-bottom-right-radius: 30px;
                                padding:12px 0;
                                " 
                                type="text" class="form-control" name="cari" id="cari"
                                placeholder="Masukkan nomer aduan anda..." autocomplete="off">
                            </div>          
                            <a href="javascript:void(0)" class="input-group-text button-kode-pengaduan" 
                            style="background: #fff !important;
                            border-color:#3742fa;
                            border-radius:20px;
                            margin-left:20px;
                            padding:8px 50px;
                            color:#000;">Cari</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-full d-flex justify-content-center align-items-center" id="bg-conten-2">
                <div class="row text-center text-light" style="width: 100%;">
                    <div class="col-lg-12">
                        <h2>Jumlah Pengaduan</h2>
                        <h2>{{ $pengaduan }}</h2>
                    </div>
                </div>
            </div>
        </section>

        <section style="margin: 100px 0 100px 0;">
            <div class="container-full">
                <div class="row" style="width:100%;">
                    <div class="col-lg-2">

                    </div>
                    <div class="col-lg-8 d-flex gap-5">
                        @foreach ($pengaduanAll as $pengaduan)
                            <div class="card" style="width: 18rem;border-radius:20px !important;">
                                <div class="card-body">
                                    <div class="d-flex gap-2">
                                        <div class="card-1">
                                        <img src="{{ asset('storage/user/user.png') }}" 
                                        style="border-radius: 50%;background-size: cover;" width="56" height="56" alt="">
                                        </div>
                                        <div class="card-2">
                                            <h5 class="card-title">Pengadu</h5>
                                            {{-- <h6 class="card-subtitle mb-2 text-body-secondary">{{ $pengaduan->user->jabatan->nama_jabatan }}</h6> --}}
                                            <p class="card-text" style="
                                            font-size: 14px;
                                            text-align: justify;
                                            font-style: normal;
                                            ">{{ \Illuminate\Support\Str::limit($pengaduan->deskripsi_pengaduan, $limit = 50, $end = '...') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </section>
        @include('Pengadu.Beranda.script')
    @endslot
</x-pengadu.app>