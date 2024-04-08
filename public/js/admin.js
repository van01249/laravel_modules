$(document).ready(function () {
    let currentUrl = window.location.pathname;

    //active sidebar
    $('.nav-link').each(function () {
        $(this).parents('.nav-item').removeClass('menu-open');
        $(this).removeClass('active');
        let link = $(this).attr('href');
        if (currentUrl == link) {
            $(this).addClass('active');
            $(this).parents('.nav-item').addClass('menu-is-opening menu-open');
            $(this).parents('.nav-item').find('.nav-treeview').css({ display: 'block' });
        }
    });

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $(function () {
        $('.btn_delete').on('click', function () {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let url = $(this).attr('data-href');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    dataType: 'json',
                    success: function (data) {
                        if (data.result) {
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            }
        })

        $('.logout').on('click', function () {
            if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                let url = $(this).attr('href');
                console.log('url:', url)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    success: function (data) {
                        if (data.result) {
                            console.log(data)
                            window.location.reload();
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            }
        })
    })
})