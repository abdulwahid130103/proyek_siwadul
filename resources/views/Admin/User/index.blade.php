<x-admin.app >

    @slot('title')
        Data User
    @endslot

    @slot('type_menu')
        data
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

    @endslot

    @slot('main')

    @include('admin.user.modaldetail')
    @include('admin.user.modaltambah')
    @include('admin.user.modaledit')
    @include('admin.user.modalpassword')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Data</a></div>
                    <div class="breadcrumb-item">Users</div>
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
                                            <h4>Data User</h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                                <select class="form-control select2" id="filterStatus">
                                                    <option value="">-- Filter Status --</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="non-aktif">Non Aktif</option>
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
                                            <a href="javascript:void(0)" class="btn btn-icon icon-left btn-primary btn-lg tombol-tambah" style="padding: 7px 20px;border-radius:10px;font-size:16px;"><i class="fas fa-plus" style="font-size:16px;"></i> Tambah</a>
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
                                                <th>Kode user</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Jabatan</th>
                                                <th>Status</th>
                                                <th>Foto</th>
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
        @include('admin.user.script')
        <!-- JS Libraies -->
        <script src="{{ asset('module/dataTables.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('module/jquery-ui.min.js') }}"></script>
        <!-- JS Libraies -->
        <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

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
    @endslot

</x-admin.app>
