@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row" id="loading">

        <div class="card">
            <h5 class="card-header">Data Projek</h5>
            <div class="dt-action-buttons text-end pt-3 mt-lg-4 pt-md-0">
                <div class="dt-buttons btn-group flex-wrap">
                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light BtnTambah">
                        <span class="fa-solid fa-plus"></span> Tambah Data
                    </button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <div class="row">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-pills mb-3" role="tablist" id="ListBhsPemograman">
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                                        <table class="table table-striped" id="ListProjek">
                                            <thead class="text-bold">
                                                <tr>
                                                    <th class="text-center" >No</th>
                                                    <th>Bahasa Pemograman</th>
                                                    <th>Nama Projek</th>
                                                    <th class="text-center">Tahun</th>
                                                    <th class="text-center">Tentang</th>
                                                    <th class="text-center">File</th>
                                                    <th class="text-center">No Urut</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show PDF -->
<div class="modal fade" id="ModalPdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <img width="100%" id="imgku" src=""></img> --}}
            <div class="row justify-content-center">
                <iframe id="pdfku" src="" width="100%" height="600">
                </iframe>
            </div>
        </div>
    </div>
</div>


<!-- Form Add Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="addprojek"
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
                    <h4 class="onboarding-title text-body">Data projek</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Tambah projek</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan</div>
                    <form method="POST" action="#" enctype="multipart/form-data" id="formTambah"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="id_bhs_pemograman" class="form-label">Bahasa Pemograman</label>
                                    <select class="form-select" id="id_bhs_pemograman" name="id_bhs_pemograman"
                                        required>
                                        <option value="">--Pilih--</option>
                                        @foreach ($pemograman as $pecah )
                                        <option value="{{$pecah->id_bhs_pemograman }}">{{$pecah->nama_bahasa }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="nama_projek" class="form-label">Nama Projek</label>
                                    <input required class="form-control" placeholder="Masukan nama projek..."
                                        type="text" id="nama_projek" name="nama_projek">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="file" class="form-label">File</label>
                                    <input required class="form-control" placeholder="Masukan tahun pembuatan..."
                                        type="file" id="file" name="file">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                                    <input required class="form-control" placeholder="Masukan tahun pembuatan..."
                                        type="text" id="tahun_pembuatan" name="tahun_pembuatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="tentang_projek" class="form-label">Tentang Projek</label>
                                    <textarea class="form-control" name="tentang_projek" id="tentang_projek" cols="30"
                                        rows="4" placeholder="Masukan tentang projek..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no urut..." type="number"
                                        id="no_urut" name="no_urut" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_projek">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Add Modal -->

<!-- Form Detail Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static"
    id="detailprojek" tabindex="-1" aria-hidden="true">
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
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="tooltip-info" title="Nama Projek">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 nama_projek"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="tooltip-info" title="Tahun Pembuatan">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tahun_pembuatan"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="tooltip-info" title="Tentang Projek">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 tentang_projek"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="tooltip-info" title="No Urut">
                                                            <button type="button"
                                                                class="btn btn-icon btn-success btn-sm waves-effect waves-light me-3">
                                                                <span class="fa-solid fa-right-long"
                                                                    style="color: #FFF;"></span>
                                                            </button>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1 no_urut"></h6>
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
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="editprojek"
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
                    <h4 class="onboarding-title text-body">Edit Data projek</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Edit projek</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan untuk
                        melakukan update data</div>
                    <form action="#" enctype="multipart/form-data" id="formEdit" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="slug" id="edit_slug" value="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="id_bhs_pemograman" class="form-label">Bahasa Pemograman</label>
                                    <select class="form-select dipilih" id="id_bhs_pemograman" name="id_bhs_pemograman"
                                        required>
                                        <option value="">--Pilih--</option>
                                        @foreach ($pemograman as $pecah )
                                        <option value="{{$pecah->id_bhs_pemograman }}">{{$pecah->nama_bahasa }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_nama_projek" class="form-label">Nama Projek</label>
                                    <input required class="form-control" placeholder="Masukan nama projek..."
                                        type="text" id="edit_nama_projek" name="nama_projek">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="file" class="form-label">File</label>
                                    <input required class="form-control" placeholder="Masukan tahun pembuatan..."
                                        type="file" id="file" name="file">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                                    <input required class="form-control" placeholder="Masukan tahun pembuatan..."
                                        type="text" id="edit_tahun_pembuatan" name="tahun_pembuatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_tentang_projek" class="form-label">Tentang Projek</label>
                                    <textarea class="form-control" name="tentang_projek" id="edit_tentang_projek"
                                        cols="30" rows="4" placeholder="Masukan tentang projek..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="edit_no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no urut..." type="number"
                                        id="edit_no_urut" name="no_urut" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_edit_projek">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Edit Modal -->


@endsection


@push('js')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@include('projek.js')
@endpush
