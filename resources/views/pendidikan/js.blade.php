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


    function data_pendidikan(data) {
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            $('#tbody_pendidikan').append("<tr>\
                        			<td class='text-center'>" + ++i + "</td>\
                        			<td>" + value.nama_pendidikan + "</td>\
                        			<td>" + value.tanggal_masuk + "</td>\
                        			<td class='text-center'>" + value.tanggal_keluar + "</td>\
                        			<td class='text-center'><img src='" + value.logo +
                "' alt='user image' width='40%' class='rounded mx-auto d-block open-img' data-bs-toggle='modal' data-bs-target='#ModalFoto' data-imgku='" +
                value.logo + "'></td>\
                        			<td class='text-center'><button type='button' title='Edit data' data-slug='" + value.slug +
                "' class='btn btn-icon btn-warning waves-effect waves-light BtnEdit'><i class='fa-solid fa-pencil'></i></button>&nbsp;<button type='button' title='Hapus data' data-slug='" +
                value.slug +
                "' class='btn btn-icon btn-danger waves-effect waves-light' id='BtnHapus'><span class='fa-regular fa-trash-can'></span></button>&nbsp;<button type='button' title='Detail data' data-slug='" +
                value.slug + "' class='btn btn-icon btn-primary waves-effect waves-light' id='BtnDetail'><span class='fa-solid fa-circle-info'></span></button></td>\
                        			</tr>");

                                });
    }



    function getAllData() {
        $('#tbody_pendidikan').empty();
        loading($('#loading'));
        axios.get(`${url}/api/pendidikan`)
            .then(function (res) {
                data_pendidikan(res.data.data)
                $('#loading').waitMe('hide');
            })
    }

    $(document).on('click', '.open-img', function (e) {
        e.preventDefault();
        var img = $(this).data('imgku');
        $('#imgku').attr('src', img);
    });

    function resetpendidikan() {
        $('form#formTambah').trigger('reset');
        $('form#formTambah').removeClass('was-validated');
    }

    $(document).on('click', '.BtnTambah', function (e) {
        e.stopPropagation();
        resetpendidikan();
        $('#addPendidikan').modal('show');
    });

    $(document).on('click', '#BtnDetail', function (e) {
        e.stopPropagation();
        let slug = $(this).data('slug')
        $('#detailPendidikan').modal('show');
        getDetailData(slug);
    });

    function getDetailData(slug) {
        loading($('#detailPendidikan'));
        axios.get(`${url}/api/pendidikan/${slug}`)
            .then(function (res) {
                $('#detailPendidikan').waitMe('hide');
                let data = res.data.data;
                $('.fotoku').attr('src', data.logo);
                $('.nama_pendidikan').html(data.nama_pendidikan);
                $('.tanggal_masuk').html(data.tanggal_masuk);
                $('.tanggal_keluar').html(data.tanggal_keluar);
                $('.nilai').html(data.nilai);
                $('.jurusan').html(data.jurusan);
                $('.kota').html(data.kota);
                $('.provinsi').html(data.provinsi);
                $('.alamat').html(data.alamat_pendidikan);
            })
    }

    $(document).on('submit', '#formTambah', function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_pendidikan").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_pendidikan").addClass('disabled');
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
                axios.post(`${url}/api/pendidikan`, postData)
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
                        $('#addPendidikan').modal('toggle');

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
                $("#simpan_pendidikan").html('Simpan');
                $("#simpan_pendidikan").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formTambah').waitMe('hide');
                $("#simpan_pendidikan").html('Simpan');
                $("#simpan_pendidikan").removeClass('disabled');
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
                axios.delete(`${url}/api/pendidikan/${slug}`).then(function (r) {
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

    function reseteditpendidikan() {
        $('form#formEdit').trigger('reset');
        $('form#formEdit').removeClass('was-validated');
    }


    $(document).on('click', '.BtnEdit', function (e) {
        e.stopPropagation();
        reseteditpendidikan();
        let slug = $(this).data('slug')
        $('#editPendidikan').modal('show');
        getEditData(slug);
    });


    function getEditData(slug) {
        loading($('#editPendidikan'));
        axios.get(`${url}/api/pendidikan/${slug}`)
            .then(function (res) {
                $('#editPendidikan').waitMe('hide');
                let data = res.data.data;
                // $('#fotoku').attr('src', data.foto);
                $('#edit_slug').val(data.slug);
                $('#edit_nama_pendidikan').val(data.nama_pendidikan);
                $('#edit_tanggal_masuk').val(data.tanggal_masuk);
                $('#edit_tanggal_keluar').val(data.tanggal_keluar);
                $('#edit_jurusan').val(data.jurusan);
                $('#edit_nilai').val(data.nilai);
                $('#edit_provinsi').val(data.provinsi);
                $('#edit_kota').val(data.kota);
                $('#edit_no_urut').val(data.no_urut);
                $('#edit_alamat_pendidikan').val(data.alamat_pendidikan);
            })
    }

    $(document).on('submit', '#formEdit', function (e) {
        e.preventDefault();
        var slug = $('#edit_slug').val();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_edit_pendidikan").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_edit_pendidikan").addClass('disabled');
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
                axios.post(`${url}/api/pendidikan/${slug}`, postData)
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
                        $('#editPendidikan').modal('toggle');

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
                $("#simpan_edit_pendidikan").html('Simpan');
                $("#simpan_edit_pendidikan").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Ubah data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formEdit').waitMe('hide');
                $("#simpan_edit_pendidikan").html('Simpan');
                $("#simpan_edit_pendidikan").removeClass('disabled');
            }
        })
    });

</script>
