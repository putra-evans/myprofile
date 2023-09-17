<script>
    let url = window.location.origin
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    function loading(el) {
        el.waitMe({
            effect: 'ios',
            text: 'Mohon tunggu...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function (el) {}
        });
    }
    $(document).ready(function () {
        getAllData();
    });



    function getAllData() {

// var url = "{{ route('get_projek', ['slug' => ':slug']) }}";
//     url = url.replace(':slug', slug_bahasa);

'use strict';
var ListProfil = $("#ListProfil").DataTable({
    dom: 'Bfrtip',
    responsive: false,
    scrollX: true,
    autoWidth: false,
    bDestroy: true,
    ajax: "{{ route('show_profil') }}",
    buttons: [],
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center'
        },
        {
            data: 'nama_lengkap',
            name: 'nama_lengkap'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'no_hp',
            name: 'no_hp',
            className: 'text-center'
        },
        {
            data: 'foto',
            name: 'foto',
            className: 'text-center'
        },
        {
            data: 'action',
            name: 'action',
            className: 'text-center'
        },
    ],
    columnDefs: [{
        orderable: false,
        targets: [0, 1, 2]
    }],
});
}


    // function data_profile(data) {
    //     var rows = '';
    //     var i = 0;
    //     $.each(data, function (key, value) {
    //         $('#tbody_profile').append("<tr>\
    //                     			<td class='text-center'>" + ++i + "</td>\
    //                     			<td>" + value.nama_lengkap + "</td>\
    //                     			<td>" + value.email + "</td>\
    //                     			<td class='text-center'>" + value.no_hp + "</td>\
    //                     			<td class='text-center'><img src='" + value.foto +
    //             "' alt='user image' width='40%' class='rounded mx-auto d-block open-img' data-bs-toggle='modal' data-bs-target='#ModalFoto' data-imgku='" +
    //             value.foto + "'></td>\
    //                     			<td class='text-center'><button type='button' title='Edit data' data-slug='" + value.slug +
    //             "' class='btn btn-icon btn-warning waves-effect waves-light BtnEdit'><i class='fa-solid fa-pencil'></i></button>&nbsp;<button type='button' title='Hapus data' data-slug='" +
    //             value.slug +
    //             "' class='btn btn-icon btn-danger waves-effect waves-light' id='BtnHapus'><span class='fa-regular fa-trash-can'></span></button>&nbsp;<button type='button' title='Detail data' data-slug='" +
    //             value.slug + "' class='btn btn-icon btn-primary waves-effect waves-light' id='BtnDetail'><span class='fa-solid fa-circle-info'></span></button></td>\
    //                     			</tr>");

    //                             });
    // }



    // function getAllData() {
    //     $('#tbody_profile').empty();
    //     loading($('#loading'));
    //     axios.get("api/profile")
    //         .then(function (res) {
    //             data_profile(res.data.data)
    //             $('#loading').waitMe('hide');
    //         })
    // }

    $(document).on('click', '.open-img', function (e) {
        e.preventDefault();
        var img = $(this).data('imgku');
        $('#imgku').attr('src', img);
    });

    function resetprofile() {
        $('form#formTambah').trigger('reset');
        $('form#formTambah').removeClass('was-validated');
    }

    $(document).on('click', '.BtnTambah', function (e) {
        e.stopPropagation();
        resetprofile();
        $('#addProfile').modal('show');
    });

    $(document).on('click', '#BtnDetail', function (e) {
        e.stopPropagation();
        let slug = $(this).data('slug')
        $('#detailProfile').modal('show');
        getDetailData(slug);
    });

    function getDetailData(slug) {
        loading($('#detailProfile'));
        axios.get(`${url}/api/profile/${slug}`)
            .then(function (res) {
                $('#detailProfile').waitMe('hide');
                let data = res.data.data;
                $('.fotoku').attr('src', data.foto);
                $('.nama_lengkap').html(data.nama_lengkap);
                $('.nama_panggilan').html(data.nama_panggilan);
                $('.tempat_lahir').html(data.tempat_lahir);
                $('.tanggal_lahir').html(data.tanggal_lahir);
                $('.email').html(data.email);
                $('.no_hp').html(data.no_hp);
                $('.status_perkawinan').html(data.status);
                $('.pekerjaan').html(data.pekerjaan);
                $('.profil_singkat').html(data.profil_singkat);
                $('.kota_asal').html(data.kota_asal);
                $('.provinsi_asal').html(data.provinsi_asal);
                $('.alamat_sekarang').html(data.alamat_sekarang);
            })
    }

    $(document).on('submit', '#formTambah', function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_profile").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_profile").addClass('disabled');
        loading($('#formTambah'));
        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Tidak, batalkan!',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/api/profile', postData)
                    .then(function (response) {
                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan.',
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                            showCancelButton: false,
                        });
                        getAllData();
                        $('#formTambah').waitMe('hide');
                        $('#addProfile').modal('toggle');

                    })
                    .catch(function (error) {
                        if (error.response.status == 422) {
                            $('#formTambah').addClass('was-validated');
                            swalWithBootstrapButtons.fire({
                                title: 'Batal',
                                text: 'Simpan data dibatalkan',
                                icon: 'error',
                                confirmButtonText: '<i class="fas fa-check"></i> Oke',
                                showCancelButton: false,
                            }).then((result) => {
                                if (result.value) {
                                    $.each(error.response.data, function (key, value) {
                                        if (key != 'isi') {
                                            $('input[name="' + key +
                                                '"], textarea[name="' + key +
                                                '"], select[name="' + key + '"]'
                                            ).closest('div.required').find(
                                                'div.invalid-feedback').text(
                                                value[0]);
                                        } else {
                                            $('#pesanErr').html(value);
                                        }
                                    });
                                    $('#formTambah').waitMe('hide');
                                }
                            })
                        }
                    });
                $('#formTambah').waitMe('hide');
                $("#simpan_profile").html('Simpan');
                $("#simpan_profile").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formTambah').waitMe('hide');
                $("#simpan_profile").html('Simpan');
                $("#simpan_profile").removeClass('disabled');
            }
        })
    });

    $('body').on('click', '#BtnHapus', function (e) {
        e.preventDefault();
        let slug = $(this).data('slug')
        //    let del = url + '/api/profile/' + id
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`${url}/api/profile/${slug}`).then(function (r) {
                    getAllData();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    )
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }
        })
    });

    function reseteditprofile() {
        $('form#formEdit').trigger('reset');
        $('form#formEdit').removeClass('was-validated');
    }


    $(document).on('click', '.BtnEdit', function (e) {
        e.stopPropagation();
        reseteditprofile();
        let slug = $(this).data('slug')
        $('#editProfile').modal('show');
        getEditData(slug);
    });


    function getEditData(slug) {
        loading($('#editProfile'));
        axios.get(`${url}/api/profile/${slug}`)
            .then(function (res) {
                $('#editProfile').waitMe('hide');
                let data = res.data.data;
                // $('#fotoku').attr('src', data.foto);
                $('#edit_slug').val(data.slug);
                $('#edit_nama_lengkap').val(data.nama_lengkap);
                $('#edit_nama_panggilan').val(data.nama_panggilan);
                $('#edit_tempat_lahir').val(data.tempat_lahir);
                $('#edit_tanggal_lahir').val(data.tanggal_lahir);
                $('#edit_email').val(data.email);
                $('#edit_no_hp').val(data.no_hp);
                $('#edit_status').val(data.status).change();
                $('#edit_pekerjaan').val(data.pekerjaan);
                $('#edit_profil_singkat').val(data.profil_singkat);
                $('#edit_kota_asal').val(data.kota_asal);
                $('#edit_provinsi_asal').val(data.provinsi_asal);
                $('#edit_alamat_sekarang').val(data.alamat_sekarang);
            })
    }

    $(document).on('submit', '#formEdit', function (e) {
        e.preventDefault();
        var slug = $('#edit_slug').val();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_edit_profile").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_edit_profile").addClass('disabled');
        loading($('#formEdit'));
        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Tidak, batalkan!',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`${url}/api/profile/${slug}`, postData)
                    .then(function (response) {
                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan.',
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                            showCancelButton: false,
                        });
                        getAllData();
                        $('#formEdit').waitMe('hide');
                        $('#editProfile').modal('toggle');

                    })
                    .catch(function (error) {
                        if (error.response.status == 422) {
                            $('#formEdit').addClass('was-validated');
                            swalWithBootstrapButtons.fire({
                                title: 'Batal',
                                text: 'Simpan data dibatalkan',
                                icon: 'error',
                                confirmButtonText: '<i class="fas fa-check"></i> Oke',
                                showCancelButton: false,
                            }).then((result) => {
                                if (result.value) {
                                    $.each(error.response.data, function (key, value) {
                                        if (key != 'isi') {
                                            $('input[name="' + key +
                                                '"], textarea[name="' + key +
                                                '"], select[name="' + key + '"]'
                                            ).closest('div.required').find(
                                                'div.invalid-feedback').text(
                                                value[0]);
                                        } else {
                                            $('#pesanErr').html(value);
                                        }
                                    });
                                    $('#formEdit').waitMe('hide');
                                }
                            })
                        }
                    });
                $('#formEdit').waitMe('hide');
                $("#simpan_edit_profile").html('Simpan');
                $("#simpan_edit_profile").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formEdit').waitMe('hide');
                $("#simpan_edit_profile").html('Simpan');
                $("#simpan_edit_profile").removeClass('disabled');
            }
        })
    });

</script>
