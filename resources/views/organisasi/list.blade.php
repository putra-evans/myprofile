@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row" id="loading">

        <div class="card">
            <h5 class="card-header">Data Riwayat Organisasi</h5>
            <div class="dt-action-buttons text-end pt-3 mt-lg-4 pt-md-0">
                <div class="dt-buttons btn-group flex-wrap">
                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light BtnTambah">
                        <span class="fa-solid fa-plus"></span> Tambah Data
                    </button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="text-bold">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="20%">Nama Organisasi</th>
                            <th width="10%">Tanggal Masuk</th>
                            <th class="text-center" width="10%">Tanggal Keluar</th>
                            <th class="text-center" width="15%">Tingkat</th>
                            <th class="text-center" width="20%">Logo</th>
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 " id="tbody_organisasi">
                    </tbody>
                </table>
                <div class="d-flex justify-content-center paginate">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show Image -->
<div class="modal fade" id="ModalFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <img width="100%" id="imgku" src=""></img>
        </div>
    </div>
</div>


<!-- Form Add Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="addOrganisasi"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body onboarding-horizontal p-0">
                <div class="onboarding-media">
                    <img src="{{asset('assets/img/illustrations/boy-verify-email-light.png')}}"
                        alt="boy-verify-email-light" width="273" class="img-fluid"
                        data-app-light-img="illustrations/boy-verify-email-light.png"
                        data-app-dark-img="illustrations/boy-verify-email-dark.html">
                </div>
                <div class="onboarding-content mb-0">
                    <h4 class="onboarding-title text-body">Data Riwayat Organisasi</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Tambah Riwayat Organisasi</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan</div>
                    <form method="POST" action="#" enctype="multipart/form-data" id="formTambah"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                                    <input required class="form-control" placeholder="Masukan nama organisasi..."
                                        type="text" id="nama_organisasi" name="nama_organisasi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input required class="form-control" placeholder="Masukan jabatan..."
                                        type="text" id="jabatan" name="jabatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tentang_organisasi" class="form-label">Tentang Organisasi</label>
                                    <textarea class="form-control" name="tentang_organisasi" id="tentang_organisasi" cols="30"
                                        rows="4" placeholder="Masukan tentang organisasi..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tentang_jabatan" class="form-label">Tentang Jabatan</label>
                                    <textarea class="form-control" name="tentang_jabatan" id="tentang_jabatan" cols="30"
                                        rows="4" placeholder="Masukan tentang jabatan..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                    <input required class="form-control" placeholder="Masukan tanggal masuk..."
                                        type="date" id="tanggal_masuk" name="tanggal_masuk">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                    <input required class="form-control" placeholder="Masukan tanggal keluar..."
                                        type="date" id="tanggal_keluar" name="tanggal_keluar">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input required class="form-control" placeholder="Masukan kota..."
                                        type="text" id="kota" name="kota">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input required class="form-control" placeholder="Masukan provinsi..."
                                        type="text" id="provinsi" name="provinsi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3 required">
                                    <label for="tingkat_organisasi" class="form-label">Tingkat</label>
                                    <input required class="form-control" placeholder="Masukan tingkat organisasi..." type="text"
                                        id="tingkat_organisasi" name="tingkat_organisasi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3 required">
                                    <label for="no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no_urut..." type="number"
                                        id="no_urut" name="no_urut">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3 required">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input class="form-control" type="file" id="logo" name="logo" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_organisasi">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Add Modal -->

<!-- Form Detail Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static"
    id="detailOrganisasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h5 class="pb-1 mb-4 text-center">Detail</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-center nama_organisasi"></h5>
                                            <div class="col-12 mb-4 mb-xl-0">
                                                <div class="demo-inline-spacing mt-3">
                                                    <div class="list-group">
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tanggal Masuk">
                                                            <button type="button" class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long" style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tanggal_masuk"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tanggal Keluar">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tanggal_keluar"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Jabatan Dalam Organisasi">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 jabatan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tingkat Organisasi">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tingkat_organisasi"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tentang Organiasi">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tentang_organisasi"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tentang Jabatan Organisasi">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tentang_jabatan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Kota">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 kota"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Provinsi">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 provinsi"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img class="card-img card-img-right fotoku" src="" alt="Card image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<!-- Form Detail Modal -->

<!-- Form Edit Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="editOrganisasi"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body onboarding-horizontal p-0">
                <div class="onboarding-media">
                    <img src="{{asset('assets/img/illustrations/boy-verify-email-light.png')}}"
                        alt="boy-verify-email-light" width="273" class="img-fluid"
                        data-app-light-img="illustrations/boy-verify-email-light.png"
                        data-app-dark-img="illustrations/boy-verify-email-dark.html">
                </div>
                <div class="onboarding-content mb-0">
                    <h4 class="onboarding-title text-body">Edit Data Riwayat Organisasi</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Edit Data Riwayat Organisasi</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan untuk melakukan update data</div>
                    <form action="#" enctype="multipart/form-data" id="formEdit"
                        class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="slug" id="edit_slug" value="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_nama_organisasi" class="form-label">Nama Organisasi</label>
                                    <input required class="form-control" placeholder="Masukan nama organisasi..."
                                        type="text" id="edit_nama_organisasi" name="nama_organisasi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_jabatan" class="form-label">Jabatan</label>
                                    <input required class="form-control" placeholder="Masukan jabatan..."
                                        type="text" id="edit_jabatan" name="jabatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tentang_organisasi" class="form-label">Tentang Organisasi</label>
                                    <textarea class="form-control" name="tentang_organisasi" id="edit_tentang_organisasi" cols="30"
                                        rows="4" placeholder="Masukan tentang organisasi..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tentang_jabatan" class="form-label">Tentang Jabatan</label>
                                    <textarea class="form-control" name="tentang_jabatan" id="edit_tentang_jabatan" cols="30"
                                        rows="4" placeholder="Masukan tentang jabatan..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                    <input required class="form-control" placeholder="Masukan tanggal masuk..."
                                        type="date" id="edit_tanggal_masuk" name="tanggal_masuk">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                    <input required class="form-control" placeholder="Masukan tanggal keluar..."
                                        type="date" id="edit_tanggal_keluar" name="tanggal_keluar">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_kota" class="form-label">Kota</label>
                                    <input required class="form-control" placeholder="Masukan kota..."
                                        type="text" id="edit_kota" name="kota">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_provinsi" class="form-label">Provinsi</label>
                                    <input required class="form-control" placeholder="Masukan provinsi..."
                                        type="text" id="edit_provinsi" name="provinsi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3 required">
                                    <label for="edit_tingkat_organisasi" class="form-label">Tingkat</label>
                                    <input required class="form-control" placeholder="Masukan tingkat organisasi..." type="text"
                                        id="edit_tingkat_organisasi" name="tingkat_organisasi">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3 required">
                                    <label for="edit_no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no_urut..." type="number"
                                        id="edit_no_urut" name="no_urut">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input class="form-control" type="file" id="logo" name="logo">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_edit_organisasi">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Edit Modal -->


@endsection


@push('js')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@include('organisasi.js')
@endpush
