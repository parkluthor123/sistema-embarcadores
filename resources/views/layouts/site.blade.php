<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Sistema de Embarcadores</title>
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function formatMask(str, msk) {
            var a = str.replace(/[^\d]+/g, ''); // remove non digit chars.
            switch (msk) {
            case "CNPJ":
            a = a.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            break;
            case "CPF":
            a = a.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            break;
            case "CEP":
            a = a.replace(/(\d{5})(\d{3})/, '$1-$2');
            break;
            default:
            break;
            }
            return a;
        }
    </script>
</head>
<body>
    <main>
        @include('components.navbar')
        @yield('content')
    </main>
    <script src="{{ URL::to('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>