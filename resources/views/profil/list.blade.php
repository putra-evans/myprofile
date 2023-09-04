@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row" id="loading">

        <div class="card">
            <h5 class="card-header">Data Profil</h5>
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
                            <th width="20%">Nama Lengkap</th>
                            <th width="20%">Email</th>
                            <th class="text-center" width="15%">No Hp</th>
                            <th class="text-center" width="20%">Foto</th>
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 " id="tbody_profile">
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
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="addProfile"
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
                    <h4 class="onboarding-title text-body">Data Profile</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Tambah Profile</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan</div>
                    <form method="POST" action="#" enctype="multipart/form-data" id="formTambah"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input required class="form-control" placeholder="Masukan nama lengkap..."
                                        type="text" id="nama_lengkap" name="nama_lengkap">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                                    <input required class="form-control" placeholder="Masukan nama panggilan..."
                                        type="text" id="nama_panggilan" name="nama_panggilan">
                                    <div class="invalid-feedback">sadasd</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input required class="form-control" placeholder="Masukan tempat lahir..."
                                        type="text" id="tempat_lahir" name="tempat_lahir">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input required class="form-control" placeholder="Masukan tanggal lahir..."
                                        type="date" id="tanggal_lahir" name="tanggal_lahir">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="email" class="form-label">Email</label>
                                    <input required class="form-control" placeholder="Masukan email..." type="text"
                                        id="email" name="email">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input required class="form-control" placeholder="Masukan no hp..." type="text"
                                        id="no_hp" name="no_hp">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input required class="form-control" type="file" id="foto" name="foto">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Lanjang">Lanjang</option>
                                        <option value="Menikah">Menikah</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="kota_asal" class="form-label">Kota Asal</label>
                                    <input required class="form-control" placeholder="Masukan kota asal..." type="text"
                                        id="kota_asal" name="kota_asal">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="provinsi_asal" class="form-label">Provinsi Asal</label>
                                    <input required class="form-control" placeholder="Masukan provinsi asal..."
                                        type="text" id="provinsi_asal" name="provinsi_asal">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="profil_singkat" class="form-label">Profil Singkat</label>
                                    <textarea class="form-control" name="profil_singkat" id="profil_singkat" cols="30"
                                        rows="4" placeholder="Masukan profil singkat..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="alamat_sekarang" class="form-label">Alamat Sekarang</label>
                                    <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" cols="30"
                                        rows="4" placeholder="Masukan alamat sekarang..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="pekerjaan" class="form-label">Pekerjaan Saat Ini</label>
                                    <input required class="form-control" placeholder="Masukan pekerjaan saat ini..."
                                        type="text" id="pekerjaan" name="pekerjaan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_profile">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Add Modal -->

<!-- Form Detail Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static"
    id="detailProfile" tabindex="-1" aria-hidden="true">
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
                                            <h5 class="card-title text-center nama_lengkap"></h5>
                                            <div class="col-12 mb-4 mb-xl-0">
                                                <div class="demo-inline-spacing mt-3">
                                                    <div class="list-group">
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Nama Panggilan">
                                                            <button type="button" class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long" style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 nama_panggilan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tempat Lahir">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tempat_lahir"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Tanggal Lahir">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tanggal_lahir"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Email">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 email"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="No HP">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 no_hp"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Status Perkawinan">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 status_perkawinan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Pekerjaan saat ini">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 pekerjaan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Profil Singkat">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 profil_singkat"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Kota Asal">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 kota_asal"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Provinsi Asal">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 provinsi_asal"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" title="Alamat Saat Ini">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3" >
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 alamat_sekarang"></h6>
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
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="editProfile"
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
                    <h4 class="onboarding-title text-body">Edit Data Profile</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Edit Profile</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan untuk melakukan update data</div>
                    <form action="#" enctype="multipart/form-data" id="formEdit"
                        class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="slug" id="edit_slug" value="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input required class="form-control" placeholder="Masukan nama lengkap..."
                                        type="text" id="edit_nama_lengkap" name="nama_lengkap" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_nama_panggilan" class="form-label">Nama Panggilan</label>
                                    <input required class="form-control" placeholder="Masukan nama panggilan..."
                                        type="text" id="edit_nama_panggilan" name="nama_panggilan" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input required class="form-control" placeholder="Masukan tempat lahir..."
                                        type="text" id="edit_tempat_lahir" name="tempat_lahir" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input required class="form-control" placeholder="Masukan tanggal lahir..."
                                        type="date" id="edit_tanggal_lahir" name="tanggal_lahir" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input required class="form-control" placeholder="Masukan email..." type="text"
                                        id="edit_email" name="email" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_no_hp" class="form-label">No HP</label>
                                    <input required class="form-control" placeholder="Masukan no hp..." type="text"
                                        id="edit_no_hp" name="no_hp" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_status" class="form-label">Status</label>
                                    <select class="form-select" id="edit_status" name="status" required>
                                        <option value="Lanjang">Lanjang</option>
                                        <option value="Menikah">Menikah</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_kota_asal" class="form-label">Kota Asal</label>
                                    <input required class="form-control" placeholder="Masukan kota asal..." type="text"
                                        id="edit_kota_asal" name="kota_asal" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_provinsi_asal" class="form-label">Provinsi Asal</label>
                                    <input required class="form-control" placeholder="Masukan provinsi asal..."
                                        type="text" id="edit_provinsi_asal" name="provinsi_asal" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_profil_singkat" class="form-label">Profil Singkat</label>
                                    <textarea class="form-control" name="profil_singkat" id="edit_profil_singkat" cols="30"
                                        rows="4" placeholder="Masukan profil singkat..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_alamat_sekarang" class="form-label">Alamat Sekarang</label>
                                    <textarea class="form-control" name="alamat_sekarang" id="edit_alamat_sekarang" cols="30"
                                        rows="4" placeholder="Masukan alamat sekarang..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_pekerjaan" class="form-label">Pekerjaan Saat Ini</label>
                                    <input required class="form-control" placeholder="Masukan pekerjaan saat ini..."
                                        type="text" id="edit_pekerjaan" name="pekerjaan" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_edit_profile">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Edit Modal -->


@endsection


@push('js')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@include('profil.js')
@endpush
