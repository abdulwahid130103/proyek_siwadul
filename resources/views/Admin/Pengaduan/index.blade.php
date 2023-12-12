<x-admin.app >

    @slot('title')
        List Pengaduan
    @endslot

    @slot('type_menu')
        transaksi
    @endslot
    @slot('style')
        <!-- CSS Libraries -->

        <link rel="stylesheet"
        href="{{ asset('module/datatables.min.css') }}">
        <link rel="stylesheet"
        href="{{ asset('module/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet"
        href="{{ asset('module/select.bootstrap4.min.css') }}">
        <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">

        <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

        <link rel="stylesheet"
            href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/codemirror/lib/codemirror.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/selectric/public/selectric.css') }}">
                <!-- CSS Libraries -->
        <link rel="stylesheet"
        href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">

    @endslot

    @slot('main')

    @include('admin.pengaduan.modaldetail')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>List Pengaduan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pengaduan</a></div>
                    <div class="breadcrumb-item">List Pengaduan</div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link filter-status active" href="javascript:void(0)" data-status="">All <span class="badge badge-white">{{ $countPengaduan }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Ditolak">Ditolak <span class="badge badge-primary">{{ $countPengaduanDitolak }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Ditinjau">Ditinjau <span class="badge badge-primary">{{ $countPengaduanDitinjau }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Terkonfirmasi">Terkonfirmasi <span class="badge badge-primary">{{ $countPengaduanTerkonfirmasi }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Tersampaikan">Tersampaikan <span class="badge badge-primary">{{ $countPengaduanTersampaikan }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Proses">Proses <span class="badge badge-primary">{{ $countPengaduanProses }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link filter-status" href="javascript:void(0)" data-status="Selesai">Selesai <span class="badge badge-primary">{{ $countPengaduanSelesai }}</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="row">
                                        <div class="col-lg-3 d-flex justify-content-start align-items-center">
                                            <h4>List Pengaduan</h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                                <select class="form-control select2" id="filterStatusData">
                                                    <option value="">-- Filter Status Data --</option>
                                                    <option value="public">public</option>
                                                    <option value="private">private</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="d-flex justify-content-center " style="width: 100%;">
                                                <select class="form-control select2" id="filterJabatan">
                                                    <option value="">-- Filter Jabatan --</option>
                                                    @foreach ($jabatan as $data)
                                                        <option value="{{ $data->nama_jabatan }}">{{ $data->nama_jabatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex justify-content-end align-items-center">
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pengaduan</th>
                                                <th>User</th>
                                                <th>Judul Pengaduan</th>
                                                <th>Status</th>
                                                <th>Status Data</th>
                                                <th>Jabatan</th>
                                                <th>Tanggal Kejadian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endslot

    @slot('script')
        @include('admin.pengaduan.script')
        <!-- JS Libraies -->
        <script src="{{ asset('module/dataTables.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('module/jquery-ui.min.js') }}"></script>
        <!-- JS Libraies -->
        <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/modules-toastr.js') }}"></script>
            <!-- JS Libraies -->
        <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        
          <!-- JS Libraies -->
        <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
        <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
        <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
        <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    
    @endslot

</x-admin.app>
