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
        var ListOrganisasi = $("#ListOrganisasi").DataTable({
            dom: 'Bfrtip',
            responsive: false,
            scrollX: true,
            autoWidth: false,
            bDestroy: true,
            ajax: "{{ route('show-riwayat-organisasi') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'nama_organisasi',
                    name: 'nama_organisasi'
                },
                {
                    data: 'tingkat_organisasi',
                    name: 'tingkat_organisasi'
                },
                {
                    data: 'logo',
                    name: 'logo',
                    className: 'text-center'
                },
                {
                    data: 'no_urut',
                    name: 'no_urut',
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


    // function data_organisasi(data) {
    //     var rows = '';
    //     var i = 0;
    //     $.each(data, function (key, value) {
    //         $('#tbody_organisasi').append("<tr>\
    //                     			<td class='text-center'>" + ++i + "</td>\
    //                     			<td>" + value.nama_organisasi + "</td>\
    //                     			<td>" + value.tanggal_masuk + "</td>\
    //                     			<td class='text-center'>" + value.tanggal_keluar + "</td>\
    //                     			<td class='text-center'>" + value.tingkat_organisasi + "</td>\
    //                     			<td class='text-center'><img src='" + value.logo +
    //             "' alt='user image' width='40%' class='rounded mx-auto d-block open-img' data-bs-toggle='modal' data-bs-target='#ModalFoto' data-imgku='" +
    //             value.logo + "'></td>\
    //                     			<td class='text-center'><button type='button' title='Edit data' data-slug='" + value.slug +
    //             "' class='btn btn-icon btn-warning waves-effect waves-light BtnEdit'><i class='fa-solid fa-pencil'></i></button>&nbsp;<button type='button' title='Hapus data' data-slug='" +
    //             value.slug +
    //             "' class='btn btn-icon btn-danger waves-effect waves-light' id='BtnHapus'><span class='fa-regular fa-trash-can'></span></button>&nbsp;<button type='button' title='Detail data' data-slug='" +
    //             value.slug + "' class='btn btn-icon btn-primary waves-effect waves-light' id='BtnDetail'><span class='fa-solid fa-circle-info'></span></button></td>\
    //                     			</tr>");

    //                             });
    // }

    // function getAllData() {
    //     $('#tbody_organisasi').empty();
    //     loading($('#loading'));
    //     axios.get(`${url}/api/organisasi`)
    //         .then(function (res) {
    //             data_organisasi(res.data.data)
    //             $('#loading').waitMe('hide');
    //         })
    // }

    $(document).on('click', '.open-img', function (e) {
        e.preventDefault();
        var img = $(this).data('imgku');
        $('#imgku').attr('src', img);
    });

    function resetorganisasi() {
        $('form#formTambah').trigger('reset');
        $('form#formTambah').removeClass('was-validated');
    }

    $(document).on('click', '.BtnTambah', function (e) {
        e.stopPropagation();
        resetorganisasi();
        $('#addOrganisasi').modal('show');
    });

    $(document).on('click', '#BtnDetail', function (e) {
        e.stopPropagation();
        let slug = $(this).data('slug')
        $('#detailOrganisasi').modal('show');
        getDetailData(slug);
    });

    function getDetailData(slug) {
        loading($('#detailOrganisasi'));
        axios.get(`${url}/api/organisasi/${slug}`)
            .then(function (res) {
                $('#detailOrganisasi').waitMe('hide');
                let data = res.data.data;
                $('.fotoku').attr('src', data.logo);
                $('.nama_organisasi').html(data.nama_organisasi);
                $('.tanggal_masuk').html(data.tanggal_masuk);
                $('.tanggal_keluar').html(data.tanggal_keluar);
                $('.jabatan').html(data.jabatan);
                $('.tingkat_organisasi').html(data.tingkat_organisasi);
                $('.tentang_organisasi').html(data.tentang_organisasi);
                $('.tentang_jabatan').html(data.tentang_jabatan);

                $('.kota').html(data.kota);
                $('.provinsi').html(data.provinsi);
            })
    }

    $(document).on('submit', '#formTambah', function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var postData = new FormData(form);

        // get form action url
        $("#simpan_organisasi").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_organisasi").addClass('disabled');
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
                axios.post(`${url}/api/organisasi`, postData)
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
                        $('#addOrganisasi').modal('toggle');

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
                $("#simpan_organisasi").html('Simpan');
                $("#simpan_organisasi").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formTambah').waitMe('hide');
                $("#simpan_organisasi").html('Simpan');
                $("#simpan_organisasi").removeClass('disabled');
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
                axios.delete(`${url}/api/organisasi/${slug}`).then(function (r) {
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

    function reseteditorganisasi() {
        $('form#formEdit').trigger('reset');
        $('form#formEdit').removeClass('was-validated');
    }


    $(document).on('click', '.BtnEdit', function (e) {
        e.stopPropagation();
        reseteditorganisasi();
        let slug = $(this).data('slug')
        $('#editOrganisasi').modal('show');
        getEditData(slug);
    });


    function getEditData(slug) {
        loading($('#editOrganisasi'));
        axios.get(`${url}/api/organisasi/${slug}`)
            .then(function (res) {
                $('#editOrganisasi').waitMe('hide');
                let data = res.data.data;
                // $('#fotoku').attr('src', data.foto);
                $('#edit_slug').val(data.slug);
                $('#edit_nama_organisasi').val(data.nama_organisasi);
                $('#edit_tanggal_masuk').val(data.tanggal_masuk);
                $('#edit_tanggal_keluar').val(data.tanggal_keluar);
                $('#edit_jabatan').val(data.jabatan);
                $('#edit_tingkat_organisasi').val(data.tingkat_organisasi);
                $('#edit_tentang_organisasi').val(data.tentang_organisasi);
                $('#edit_tentang_jabatan').val(data.tentang_jabatan);
                $('#edit_no_urut').val(data.no_urut);
                $('#edit_kota').val(data.kota);
                $('#edit_provinsi').val(data.provinsi);
            })
    }

    $(document).on('submit', '#formEdit', function (e) {
        e.preventDefault();
        var slug = $('#edit_slug').val();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_edit_organisasi").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_edit_organisasi").addClass('disabled');
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
                axios.post(`${url}/api/organisasi/${slug}`, postData)
                    .then(function (response) {

                        swalWithBootstrapButtons.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil diubah.',
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                            showCancelButton: false,
                        });
                        getAllData();
                        $('#formEdit').waitMe('hide');
                        $('#editOrganisasi').modal('toggle');

                    })
                    .catch(function (error) {
                        if (error.response.status == 422) {
                            $('#formEdit').addClass('was-validated');
                            swalWithBootstrapButtons.fire({
                                title: 'Batal',
                                text: 'Ubah data dibatalkan',
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
                $("#simpan_edit_organisasi").html('Simpan');
                $("#simpan_edit_organisasi").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Ubah data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formEdit').waitMe('hide');
                $("#simpan_edit_organisasi").html('Simpan');
                $("#simpan_edit_organisasi").removeClass('disabled');
            }
        })
    });

</script>
