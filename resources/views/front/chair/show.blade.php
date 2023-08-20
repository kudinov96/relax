@extends("layouts.front")

@section("content")
    <div id="product-info">
        <div class="container">
            <h1>Массажное кресло <span>{{ $chair->device_id }}</span></h1>
            <div class="status">
                <div>
                    Статус:
                    <span @class([
                        "ok"   => $status === 0,
                        "busy" => $status === 3,
                    ])>{{ $chair->statusHuman($status) }}</span>
                </div>
            </div>
            <div class="location"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0001 0C6.00613 0 2.75684 3.2493 2.75684 7.2432C2.75684 12.1998 9.23883 19.4763 9.5148 19.7836C9.77402 20.0723 10.2266 20.0718 10.4854 19.7836C10.7613 19.4763 17.2433 12.1998 17.2433 7.2432C17.2432 3.2493 13.994 0 10.0001 0ZM10.0001 10.8875C7.99062 10.8875 6.35586 9.25266 6.35586 7.2432C6.35586 5.23375 7.99066 3.59898 10.0001 3.59898C12.0095 3.59898 13.6443 5.23379 13.6443 7.24324C13.6443 9.2527 12.0095 10.8875 10.0001 10.8875Z" fill="#D7C6B2"/>
                </svg> t/c Domina, Stirnu iela 15, Rīga</div>
        </div>
    </div>

    @if($status === 0)
        <div id="info-text" class="info-price info-bg">
            <div class="container">
                <p>Выберите длительность массажа</p>
                @include("rates")
            </div>
        </div>
    @endif

    @if($status === 3)
        <div id="busy-info" class="info-bg">
            <div class="container">
                <p>Пожалуйста, дождитесь окончания работы кресла и обновите страницу</p>
                <p><a href="{{ route("chair.show", ["chair" => $chair]) }}" class="btn">Обновить страницу</a></p>
                <div class="feedback-wrapper">
                    <p>Заметили техническую неисправность?<br> Сообщите нам по телефону:</p>
                    <p><a href="tel:+371 267 467 04" class="phone"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.4754 12.4713C16.3121 12.4713 15.17 12.2894 14.0876 11.9317C13.5573 11.7508 12.9053 11.9168 12.5816 12.2492L10.4452 13.8619C7.96766 12.5394 6.44153 11.0138 5.13706 8.5548L6.70233 6.4741C7.109 6.06798 7.25486 5.47472 7.0801 4.91808C6.72089 3.83003 6.53841 2.6884 6.53841 1.52465C6.53846 0.683951 5.85451 0 5.01386 0H1.5246C0.683949 0 0 0.683951 0 1.5246C0 11.1607 7.83936 19 17.4754 19C18.3161 19 19 18.316 19 17.4754V13.9959C19 13.1553 18.316 12.4713 17.4754 12.4713Z" fill="#D7C6B2"></path>
                            </svg> +371 267 467 04</a></p>
                </div>
            </div>
        </div>
    @endif

    @include("why")

    @if($status === 0)
        @include("feedback")
    @endif

    @include("footer")
@endsection