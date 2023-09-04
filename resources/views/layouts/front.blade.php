<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR busy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @vite(['resources/css/style.css'])
</head>
<body>
<div id="page">
    <header>
        <div class="container">
            <div class="branding">
                <a href="{{ route("chair.show", ["deviceId" => $chair->device_id, "lang" => app()->getLocale()]) }}"><img src="{{ asset("images/logo.svg") }}" width="149" height="44" alt=""></a>
            </div>
            <div class="lang">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->currentLocale() }}
                    </button>
                    <ul class="dropdown-menu" data-popper-placement="bottom-start">
                        @foreach(otherLangs() as $lang)
                            <li><a class="dropdown-item" href="{{ url()->current() . '?' . http_build_query(["lang" => $lang]) }}">{{ $lang }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </header>

    @yield("content")
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkbox = document.querySelector('input[name="acceptance"]');
        var link = document.querySelector('.btn');

        if (checkbox) {
            function checkCheckboxState() {
                if (checkbox.checked) {
                    link.classList.remove('disabled-link');
                } else {
                    link.classList.add('disabled-link');
                }
            }

            checkCheckboxState();

            checkbox.addEventListener('change', checkCheckboxState);
        }
    });
</script>
</body>
</html>