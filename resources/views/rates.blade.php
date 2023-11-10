@foreach(rates() as $key => $value)
    <p><a href="{{ route("chair.ready", ["deviceId" => $chair->device_id, "minutes" => $key, "costs" => $value, "lang" => app()->getLocale()]) }}" @class(["btn", "hot" => $key === 20])>{{ $key }} {{ __("минут") }} - €{{ $value }}.00</a></p>
@endforeach
