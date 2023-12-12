<x-pengadu.app>
    @slot('title')
        Pengaduan
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
                transform: translateY(-180px);
            }
            #bg-conten-2{
                height: 256px;
                background: #FFC436;
            }
            .crd2{
                box-shadow: none;
                transform: translateY(-100px);
            }
            *{
                box-sizing: border-box !important;
            }
        </style>
    @endslot
    @slot('content')
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
            <div class="container" style="width:50%;">
                <div class="card crd" style="width: 100%;height:auto;padding:2rem 1rem;">
                    <div class="card-body">
                      <h5 class="card-title text-center text-light" style="background: #1450A3;padding:20px 0;">Sampaikan Aduan Anda</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary text-center" style="margin: 30px 0 15px 0;">Menyampaikan Pengaduan Yang Baik dan Benar 
                        <svg style="transform: translateY(-5px);margin-left:10px;" width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_76_1801)">
                                <path d="M26.9857 4.50488H1.84711C1.01359 4.50488 0.337891 5.18058 0.337891 6.0141V31.1527C0.337891 31.9862 1.01359 32.6619 1.84711 32.6619H26.9857C27.8192 32.6619 28.4949 31.9862 28.4949 31.1527V6.0141C28.4949 5.18058 27.8192 4.50488 26.9857 4.50488Z" stroke="black" stroke-width="0.687031" stroke-miterlimit="10"/>
                                <path d="M11.6006 16.6688C11.6074 16.2678 11.7285 15.877 11.9497 15.5425C12.2032 15.163 12.5478 14.8532 12.9521 14.6415C13.4244 14.3947 13.9511 14.2708 14.4839 14.2811C14.9814 14.2701 15.4748 14.3742 15.9255 14.5852C16.3183 14.7643 16.6536 15.0489 16.8941 15.4073C17.1155 15.7411 17.2331 16.1331 17.232 16.5336C17.2423 16.8234 17.1762 17.1108 17.0405 17.3671C16.9221 17.6011 16.7661 17.8142 16.5787 17.9978L15.6214 18.8763C15.5117 18.9689 15.41 19.0707 15.3173 19.1804C15.249 19.2566 15.1886 19.3397 15.1371 19.4282C15.101 19.4955 15.0745 19.5675 15.0583 19.6422L14.9569 20.0251C14.9526 20.108 14.932 20.1892 14.8962 20.264C14.8604 20.3389 14.8103 20.406 14.7485 20.4615C14.6868 20.5169 14.6147 20.5596 14.5365 20.5872C14.4582 20.6147 14.3752 20.6266 14.2924 20.622C14.1089 20.6236 13.9316 20.5551 13.7968 20.4305C13.7261 20.3534 13.6717 20.2627 13.6368 20.164C13.602 20.0653 13.5875 19.9606 13.5941 19.8561C13.5912 19.5753 13.6409 19.2965 13.7405 19.034C13.8411 18.8128 13.974 18.6079 14.1347 18.4258C14.2924 18.2568 14.5177 18.0428 14.788 17.8063L15.306 17.3333C15.4154 17.2288 15.5067 17.1071 15.5764 16.9729C15.6529 16.8434 15.6918 16.6952 15.689 16.5449C15.6904 16.4005 15.6611 16.2575 15.6028 16.1254C15.5445 15.9934 15.4587 15.8752 15.3511 15.779C15.1117 15.5702 14.8012 15.4613 14.4839 15.4749C14.3182 15.4611 14.1515 15.482 13.9944 15.5363C13.8373 15.5906 13.6933 15.6771 13.5716 15.7903C13.3432 16.0556 13.1743 16.3666 13.076 16.7026C12.9521 17.1305 12.7156 17.3445 12.3552 17.3445C12.256 17.3467 12.1575 17.3278 12.0662 17.289C11.975 17.2501 11.893 17.1923 11.8258 17.1193C11.6955 17.0038 11.6148 16.8424 11.6006 16.6688ZM14.3487 22.852C14.1287 22.8533 13.9161 22.7731 13.7518 22.6268C13.6657 22.549 13.5978 22.4531 13.553 22.346C13.5082 22.2389 13.4877 22.1233 13.4927 22.0073C13.4893 21.8943 13.5096 21.7818 13.5523 21.677C13.595 21.5723 13.6591 21.4776 13.7405 21.3991C13.8194 21.3183 13.9142 21.2545 14.0188 21.2119C14.1234 21.1693 14.2357 21.1487 14.3487 21.1514C14.4602 21.1474 14.5712 21.1675 14.6742 21.2103C14.7772 21.253 14.8697 21.3174 14.9456 21.3991C15.028 21.4746 15.0928 21.5671 15.1356 21.6702C15.1784 21.7733 15.1981 21.8845 15.1934 21.9961C15.197 22.1118 15.1757 22.227 15.131 22.3339C15.0863 22.4407 15.0193 22.5368 14.9344 22.6155C14.7758 22.7652 14.5667 22.8496 14.3487 22.852Z" fill="black"/>
                                <path d="M33.0001 5.6314C33.0001 4.51762 32.6698 3.42884 32.051 2.50276C31.4323 1.57669 30.5528 0.854895 29.5237 0.428667C28.4947 0.00244 27.3625 -0.109081 26.2701 0.108208C25.1777 0.325497 24.1743 0.861836 23.3867 1.6494C22.5991 2.43697 22.0628 3.44039 21.8455 4.53277C21.6282 5.62516 21.7397 6.75744 22.166 7.78645C22.5922 8.81545 23.314 9.69495 24.2401 10.3137C25.1661 10.9325 26.2549 11.2628 27.3687 11.2628C28.8622 11.2628 30.2946 10.6695 31.3507 9.6134C32.4068 8.55731 33.0001 7.12494 33.0001 5.6314Z" fill="black"/>
                                <path d="M28.0217 8.0417H27.2446V4.93317C27.2446 4.5615 27.2446 4.2574 27.2446 4.04341C27.2446 4.09972 27.1319 4.15604 27.0644 4.22361L26.321 4.82054L25.9043 4.33624L27.3234 3.20996H27.9767L28.0217 8.0417Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_76_1801">
                                    <rect width="33" height="33" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </h6>
                      <div class="card-text" style="margin-top: 20px;">
                          <form id="addForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="tambahkodeuser" placeholder="Masukkan judul pengaudan ...." value="{{ Auth::user()->id }}" class="form-control" required>
                            <div class="mb-3">
                              <label for="judulPengaduan" class="form-label">Judul Pengaduan</label>
                              <input type="text" class="form-control" id="tambahjudulpengaduan"
                               placeholder="Masukkan judul pengaduan ...." style="padding: 10px 20px;">
                            </div>
                            <div class="mb-3" style="width:100%;">
                                <label for="jenisPengaduan" class="form-label">Jenis Pengaduan</label>
                                <select class="form-select" style="width:100% !important;padding: 10px 20px;" id="tambahjenispengaduan" aria-label="tambahjenispengaduan">
                                    @foreach ($jenisPengaduan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_jenis_pengaduan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal Kejadian</label>
                                <input type="text" id="tambahtanggalkejadian" name="tambahtanggalkejadian" class="form-control datetimepicker">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Pilih Gambar Pengaduan</label>
                                <input class="form-control" type="file" id="tambahgambarpengaduan">
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Masukkan deskripsi pengadua ..." 
                                    id="tambahdeskripsipengaduan" style="height: 100px"></textarea>
                                    <label for="tambahdeskripsipengaduan">Masukkan deskripsi pengaduan ...</label>
                                </div>
                            </div>
                            <div style="width: 100%;" class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary simpan-data" style="padding: 10px 40px;background:#1450A3;">Lapor!</button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </section>
        <section>
            <div class="container" style="width:80%;">
                <div class="card crd2" style="width: 100%;height:auto;padding:2rem 1rem;">
                    <div class="card-body">
                        <div class="card-text" style="margin-top: 20px;">
                            <div class="row justify-content-center" style="">
                                <div class="col-lg-2" style="position: relative;display: flex;
                                    flex-direction: column;justify-content: start;
                                    height:auto;
                                    align-items: center;">
                                    <div class="d-flex justify-content-center align-items-center mb-4" 
                                    style="width:60px;height:60px;border-radius: 50%;z-index: 2;background:#1450A3;
                                        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,rgba(0,0,0,0.3) 0px 3px 7px -3px;">
                                        <i class="bi bi-pencil-square" style="color: #fff;font-size:20px;"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-center">Tulis Laporan</h5>
                                        <p class="text-center" style="font-size: 12px;">
                                            Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                                        <div style="position: absolute;right:10px;top:10px;transform:translateX(10px);">
                                            <div style="width: 150px;height:2px;background:#DDDDDD;
                                            transform:translateX(70px) translateY(25px);z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="position: relative;display: flex;
                                    flex-direction: column;justify-content: start;
                                    height:auto;
                                    align-items: center;">
                                    <div class="d-flex justify-content-center align-items-center mb-4" 
                                    style="width:60px;height:60px;border-radius: 50%;z-index: 2;background:#fff;
                                        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,rgba(0,0,0,0.3) 0px 3px 7px -3px;">
                                        <i class="fa fa-mail-forward" style="color: #000;font-size:20px;"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-center">Proses Verifikasi</h5>
                                        <p class="text-center" style="font-size: 12px;">
                                            Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang   </p>
                                        <div style="position: absolute;right:10px;top:10px;transform:translateX(10px);">
                                            <div style="width: 150px;height:2px;background:#DDDDDD;
                                            transform:translateX(70px) translateY(25px);z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="position: relative;display: flex;
                                    flex-direction: column;justify-content: start;
                                    height:auto;
                                    align-items: center;">
                                    <div class="d-flex justify-content-center align-items-center mb-4" 
                                    style="width:60px;height:60px;border-radius: 50%;z-index: 2;background:#fff;
                                        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,rgba(0,0,0,0.3) 0px 3px 7px -3px;">
                                        <i class="fa fa-comments" style="color: #333;font-size:20px;"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-center">Proses Tindak Lanjut</h5>
                                        <p class="text-center" style="font-size: 12px;">
                                            Dalam 5 hari, instansi akan menindaklanjuti dan membalas laporan Anda   </p>
                                        <div style="position: absolute;right:10px;top:10px;transform:translateX(10px);">
                                            <div style="width: 150px;height:2px;background:#DDDDDD;
                                            transform:translateX(70px) translateY(25px);z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="position: relative;display: flex;
                                    flex-direction: column;justify-content: start;
                                    height:auto;
                                    align-items: center;">
                                    <div class="d-flex justify-content-center align-items-center mb-4" 
                                    style="width:60px;height:60px;border-radius: 50%;z-index: 2;background:#fff;
                                        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,rgba(0,0,0,0.3) 0px 3px 7px -3px;">
                                        <i class="bi bi-chat-dots" style="color: #333;font-size:20px;"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-center">Beri Tanggapan</h5>
                                        <p class="text-center" style="font-size: 12px;">
                                            Anda dapat menanggapi kembali balasan yang diberikan oleh instansi dalam waktu 10 hari   </p>
                                        <div style="position: absolute;right:10px;top:10px;transform:translateX(10px);">
                                            <div style="width: 150px;height:2px;background:#DDDDDD;
                                            transform:translateX(70px) translateY(25px);z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="position: relative;display: flex;
                                    flex-direction: column;justify-content: start;
                                    height:auto;
                                    align-items: center;">
                                    <div class="d-flex justify-content-center align-items-center mb-4" 
                                    style="width:60px;height:60px;border-radius: 50%;z-index: 2;background:#fff;
                                        box-shadow: rgba(50,50,93,0.25) 0px 6px 12px -2px,rgba(0,0,0,0.3) 0px 3px 7px -3px;">
                                        <i class="fa fa-check" style="color: #333;font-size:20px;"></i>
                                    </div>
                                    <div class="">
                                        <h5 class="text-center">Selesai</h5>
                                        <p class="text-center" style="font-size: 12px;">
                                            Laporan Anda akan terus ditindaklanjuti hingga terselesaikan   </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endslot

    @slot('script')
        @include('pengadu.pengaduan.script')
    @endslot
</x-pengadu.app>