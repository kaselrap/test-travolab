<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Бронирование экскурсии</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{mix('css/main-contact.css')}}">
    <style>
        /**
        select 2 custom style
         */
        .select2-container {
            width: 100%!important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 50%;
            transform: translateY(-50%);
        }
        .select2-container--default .select2-selection--single {
            height: 62px;
            border: 0;
            border-radius: 30px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 62px;
        }
        .select2-container--default .select2-selection--single,
        .select2-results {
            outline: none;
        }
    </style>
</head>
<body>
@auth
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administration') }}">Administration Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endauth
<div class="container-contact100">

    <div class="wrap-contact100">
        <form id="requestForm" class="contact100-form validate-form">
				<span class="contact100-form-title">
					Бронирование экскурсии
				</span>

            <div class="wrap-input100 validate-input" data-validate="Введите ваше имя">
                <input class="input100" type="text" name="name" placeholder="Имя">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Пожалуйста введите ваш email: e@a.x">
                <input class="input100" type="text" name="email" placeholder="E-mail">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100">
                <input class="input100" type="text" name="phone" placeholder="Телефон по которому с вами можно будет связаться">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100">
                <select name="place_id" class="select2">
                    <option value="-1" disabled>Выберите место проведения</option>
                    @foreach(\App\Model\Place::all() as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                </select>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100">
                <textarea class="input100" name="message" placeholder="Дополнительная информация"></textarea>
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn apply_form">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Отправить запрос на бронирование
						</span>
                </button>
            </div>
        </form>
    </div>
</div>



<div id="dropDownSelect1"></div>

<script src="{{mix('js/contact-script.js')}}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
<script>
    $(document).on('click', '.apply_form', function (e) {
        e.preventDefault();

        $.ajax({
            url : '{{route('request.apply')}}',
            type: 'post',
            data: $('#requestForm').serialize(),
            success: function (response) {
                if (response.success) {
                    swal({
                        icon: 'success',
                        title: 'Запрос отправлен успешно',
                        text: 'Ваш запрос успешно отправлен, с вами свяжется специалист'
                    }).then(() => {
                        document.getElementById('requestForm').reset();
                        $('[name="place_id"]').val(-1).trigger('change');
                    });
                }
                if (response.failure) {
                    swal({
                        icon: 'error',
                        title: 'Ошибка',
                        text: response.errors[0]
                    });
                }
            },
            errors: function (message) {
                console.log(message);
                swal({
                    icon: 'danger',
                    title: message.message,
                    text: message.errors[0]
                });
            }
        });
    });
</script>
</body>
</html>
