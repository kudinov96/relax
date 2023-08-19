@extends("layouts.front")

@section("content")

    <div id="info">
        <div class="container">
            <div class="info-message">
                <span>Вы уже сели в кресло?</span>
            </div>
        </div>
    </div>

    <div id="info-text">
        <div class="container">
            <p>Важно, чтобы в момент оплаты Вы уже сидели в кресле. В противном случае кресло не запустится.</p>
            <p><a href="{{ route("chair.redirect", ["chair" => $chair, "minutes" => $minutes, "costs" => $costs]) }}" class="btn">Да, я сижу в кресле</a></p>
        </div>
    </div>

    @include("feedback")

    @include("footer")
@endsection