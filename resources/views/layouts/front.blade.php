<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR busy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    @vite(['resources/css/style.css'])
</head>
<body>
<div id="page">
    <header>
        <div class="container">
            <div class="branding">
                <a href="index.html"><img src="images/logo.svg" width="149" height="44" alt=""></a>
            </div>
            <div class="lang">
                <a href="#">LV</a>
            </div>
        </div>
    </header>

    @yield("content")

    @include("footer")
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>