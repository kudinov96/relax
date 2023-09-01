@extends("layouts.front")

@section("content")

    <div id="info">
        <div class="container">
            <div class="info-message">
                <span>{{ __("Вы уже сели в кресло?") }}</span>
            </div>
        </div>
    </div>

    <div id="info-text">
        <div class="container">
            <p>{{ __("Важно, чтобы в момент оплаты Вы уже сидели в кресле. В противном случае кресло не запустится") }}.</p>
            <p class="acceptance"><label><input type="checkbox" name="acceptance" value="1" checked="checked"> <span><span>{{ __("Согласен с") }} <a href="https://relaxtime.lv/garantijas-un-piegades-noteikumi/" target="_blank">{{ __("правилами использования") }}</a> {{ __("массажного кресла") }}.</span></span></label></p>
            <p><a href="{{ route("payment.redirect", ["deviceId" => $chair->device_id, "minutes" => $minutes, "costs" => $costs, "lang" => app()->getLocale()]) }}" class="btn">{{ __("Да, я сижу в кресле") }}</a></p>
        </div>
    </div>

    @include("feedback")

    @include("footer")
@endsection