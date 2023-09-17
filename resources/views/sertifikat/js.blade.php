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
        getKategori();
    });


    function data_sertifikat(data) {
        var rows = '';
        var i = 0;
        $.each(data, function (key, value) {
            $('#ListKategori').append(`<li class="nav-item p-1">
                                                <button type="button" class="btn btn-primary btn-sm DetailSertifikat" data-id="${value.slug}" role="tab">${value.nama_kategori}</button>
                                            </li>`);
                                });
    }


    function getKategori() {
        $('#ListKategori').empty();
        loading($('#loading'));
        axios.get("api/kategori")
            .then(function (res) {
                data_sertifikat(res.data.data)
                $('#loading').waitMe('hide');
            })
    }

    function getAllData(slug) {

        var url = "{{ route('get_sertifikat', ['slug' => ':slug']) }}";
            url = url.replace(':slug', slug);
        'use strict';
        var ListSertifikat = $("#ListSertifikat").DataTable({
            dom: 'Bfrtip',
            responsive: false,
            scrollX: true,
            autoWidth: false,
            bDestroy: true,
            ajax: url,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'nama_sertifikat',
                    name: 'nama_sertifikat'
                },
                {
                    data: 'tahun_sertifikat',
                    name: 'tahun_sertifikat',
                    className: 'text-center'
                },
                {
                    data: 'tentang_sertifikat',
                    name: 'tentang_sertifikat',
                    className: 'text-center'
                },
                {
                    data: 'file',
                    name: 'file',
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




    $(document).on('click', '.DetailSertifikat', function (e) {
        e.stopPropagation();
        let slug_bahasa = $(this).data("id")
        getAllData(slug_bahasa)
    });




    function resetsertifikat() {
        $('form#formTambah').trigger('reset');
        $('form#formTambah').removeClass('was-validated');
    }

    $(document).on('click', '.BtnTambah', function (e) {
        e.stopPropagation();
        resetsertifikat();
        $('#addsertifikat').modal('show');
    });


    // INI UNTUK TAMBAH
    $(document).on('submit', '#formTambah', function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_sertifikat").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_sertifikat").addClass('disabled');
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
                axios.post('/api/sertifikat', postData)
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
                        $('#addsertifikat').modal('toggle');

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
                $("#simpan_sertifikat").html('Simpan');
                $("#simpan_sertifikat").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formTambah').waitMe('hide');
                $("#simpan_sertifikat").html('Simpan');
                $("#simpan_sertifikat").removeClass('disabled');
            }
        })
    });

    $(document).on('click', '.open-pdf', function (e) {
        e.preventDefault();
        var pdf = $(this).data('pdfku');
        $('#pdfku').attr('src', pdf);
    });





    $(document).on('click', '#BtnDetail', function (e) {
        e.stopPropagation();
        let slug = $(this).data('slug')
        $('#detailprojek').modal('show');
        getDetailData(slug);
    });

    function getDetailData(slug) {
        loading($('#detailprojek'));
        axios.get(`${url}/api/projek/${slug}`)
            .then(function (res) {
                $('#detailprojek').waitMe('hide');
                let data = res.data.data;
                $('.fotoku').attr('src', data.foto);
                $('.nama_projek').html(data.nama_projek);
                $('.tahun_pembuatan').html(data.tahun_pembuatan);
                $('.tentang_projek').html(data.tentang_projek);
                $('.no_urut').html(data.no_urut);
            })
    }



    $('body').on('click', '#BtnHapus', function (e) {
        e.preventDefault();
        let slug = $(this).data('slug')
        //    let del = url + '/api/projek/' + id
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
                axios.delete(`${url}/api/sertifikat/${slug}`).then(function (r) {
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

    function reseteditprojek() {
        $('form#formEdit').trigger('reset');
        $('form#formEdit').removeClass('was-validated');
    }


    $(document).on('click', '#BtnEdit', function (e) {
        e.stopPropagation();
        reseteditprojek();
        let slug = $(this).data('slug')
        $('#editprojek').modal('show');
        getEditData(slug);
    });


    function getEditData(slug) {
        loading($('#editprojek'));
        axios.get(`${url}/api/projek/${slug}`)
            .then(function (res) {
                $('#editprojek').waitMe('hide');
                let data = res.data.data;
                // $('#fotoku').attr('src', data.foto);
                $('#edit_slug').val(data.slug);
                $('#edit_nama_projek').val(data.nama_projek);
                $('#edit_tahun_pembuatan').val(data.tahun_pembuatan);
                $('#edit_tentang_projek').val(data.tentang_projek);
                $('#edit_no_urut').val(data.no_urut);
                let id_program = data.id_bhs_pemograman;
                $('.dipilih option[value="'+id_program+'"]').prop("selected", true);
            })
    }

    $(document).on('submit', '#formEdit', function (e) {
        e.preventDefault();
        var slug = $('#edit_slug').val();
        var form = $(this)[0];
        var postData = new FormData(form);
        // get form action url
        $("#simpan_edit_projek").html(
            '<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...'
        );
        $("#simpan_edit_projek").addClass('disabled');
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
                axios.post(`${url}/api/projek/${slug}`, postData)
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
                        $('#editprojek').modal('toggle');

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
                $("#simpan_edit_projek").html('Simpan');
                $("#simpan_edit_projek").removeClass('disabled');

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: 'Simpan data dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                    showCancelButton: false,
                })
                $('#formEdit').waitMe('hide');
                $("#simpan_edit_projek").html('Simpan');
                $("#simpan_edit_projek").removeClass('disabled');
            }
        })
    });

</script>
