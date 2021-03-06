<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AbulQasem Zaragoza</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="app" class="content">
        <v-app>
            <router-view></router-view>
        </v-app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
</body>

</html>
