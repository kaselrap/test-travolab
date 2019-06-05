$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('select').select2();

    $('.form-sort-find .input-search select').on('change', function (e) {
        e.preventDefault();
        $(this).closest('.form-sort-find').submit();
    });

    $('.form-sort-find .input-search input').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $(this).closest('.form-sort-find').submit();
        }
    });
    $('.form-sort-find .submit_form').on('click', function (e) {
        e.preventDefault();

        $(this).closest('.form-sort-find').submit();
    });

    $('.sort-search i').on('click', function (e) {
        e.preventDefault();

        var name = $(this).closest('.sort-search').attr('data-name'),
            sort = $(this).attr('data-sort');

        $(this).closest('.form-sort-find').find('.order_by_name').val(name);
        $(this).closest('.form-sort-find').find('.order_by_value').val(sort);

        $(this).closest('.form-sort-find').submit();
    });
    $('.form-sort-find .filter_icon_search').on('click', function () {
        $(this).closest('.form-sort-find').submit();
    });
    $('.daterangepicker-init').daterangepicker();
});