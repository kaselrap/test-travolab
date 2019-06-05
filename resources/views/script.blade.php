<script>
    $(document).ready(function () {
        const checkboxes = document.querySelectorAll('[type=checkbox]')
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', (event) => {
                if (event.target.checked) {
                    event.target.value = 1;
                } else {
                    event.target.value = 0;
                }
            })
        })

        $(document).on('.checkbox', 'click', function () {
            console.log("kjnkjnjk");
            console.log($(this).val(1 - $(this).val()));
        });

        $('.save-model').on('click', function (e) {
            e.preventDefault();

            var url = $(this).attr('href'),
                form = $(this).closest('form');
            $.ajax({
                url: url,
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {
                        swal({
                            icon: 'success',
                            title: 'Успешно',
                            text: 'Успешно сохранено'
                        }).then(() => {
                            window.location.href = $('.return-back').attr('href');
                        });
                    }
                    if (response.failure) {
                        swal({
                            icon: 'error',
                            title: 'Ошибка',
                            text: response.errors[0]
                        });
                    }
                }
            });
        });
        $('.delete-model').on('click', function (e) {
            e.preventDefault();

            var url = $(this).attr('href'),
                tr = $(this).closest('tr');

            swal({
                title: "Вы уверены?",
                text: "После удаления, вы не сможете получить доступ!",
                icon: "warning",
                buttons: true,
                confirmButtonText: 'Да!',
                cancelButtonText: "Отмена!",
                dangerMode: true
            }).then((accept) => {
                if (accept) {
                    $.ajax({
                        url: url,
                        success: function (response) {
                            if (response.success) {
                                swal({
                                    icon: 'success',
                                    title: 'Успешно',
                                    text: 'Успешно удалено'
                                }).then(() => {
                                    tr.remove();
                                });
                            }
                        }
                    });
                }
            });
        })
    });
</script>