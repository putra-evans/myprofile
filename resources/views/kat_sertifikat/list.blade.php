@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row" id="loading">

        <div class="card">
            <h5 class="card-header">Data Kategori Sertifikat</h5>
            <div class="dt-action-buttons text-end pt-3 mt-lg-4 pt-md-0">
                <div class="dt-buttons btn-group flex-wrap">
                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light BtnTambah">
                        <span class="fa-solid fa-plus"></span> Tambah Data
                    </button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="ListPemograman" width="100%">
                    <thead class="text-bold">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>No Urut</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
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
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="addkategori"
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
                    <h4 class="onboarding-title text-body">Data Kategori Sertifikat</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Tambah Kategori Sertifikat</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan</div>
                    <form method="POST" action="#" enctype="multipart/form-data" id="formTambah"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3 required">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input required class="form-control" placeholder="Masukan nama kategori..."
                                        type="text" id="nama_kategori" name="nama_kategori">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3 required">
                                    <label for="ket_kategori" class="form-label">Keterangan Kategori</label>
                                    <textarea class="form-control" name="ket_kategori" id="ket_kategori" cols="30"
                                        rows="4" placeholder="Masukan keterangan..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no_urut..." type="number"
                                        id="no_urut" name="no_urut">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_kategori">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Add Modal -->

<!-- Form Edit Modal -->
<div class="modal-onboarding modal fade animate__animated" data-keyboard="false" data-backdrop="static" id="editkategori"
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
                    <h4 class="onboarding-title text-body">Edit Data pemograman</h4>
                    <div class="onboarding-info">Bagian ini merupakan tampilan dari halaman <b>Edit pemograman</b>,
                        silahkan isi form berikut dengan benar sesuai dengan inputan yang telah disediakan untuk melakukan update data</div>
                    <form action="#" enctype="multipart/form-data" id="formEdit"
                        class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="slug" id="edit_slug" value="">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3 required">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input required class="form-control" placeholder="Masukan nama kategori..."
                                        type="text" id="edit_nama_kategori" name="nama_kategori">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3 required">
                                    <label for="ket_kategori" class="form-label">Keterangan Kategori</label>
                                    <textarea class="form-control" name="ket_kategori" id="edit_ket_kategori" cols="30"
                                        rows="4" placeholder="Masukan keterangan..." required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 required">
                                    <label for="no_urut" class="form-label">No Urut</label>
                                    <input required class="form-control" placeholder="Masukan no_urut..." type="number"
                                        id="edit_no_urut" name="no_urut">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="simpan_edit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Edit Modal -->


@endsection


@push('js')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@include('kat_sertifikat.js')
@endpush
