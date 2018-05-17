<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gigatize</title>
</head>
<body>
<div id="app">
    <router-link tag="li" to="/">
        <a>Home</a>
    </router-link>
    <router-link tag="li" to="/profile">
        <a>Profile</a>
    </router-link>
    <router-view></router-view>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script>
    /*axios.get('/api/user')
        .then(response => {
            console.log(response.data);
        });*/
</script>
</body>
</html>
