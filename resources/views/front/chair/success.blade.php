@extends("layouts.front")

@section("content")

    <div id="info">
        <div class="container">
            <div class="info-message">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M35.3832 6.44044C35.0549 3.37001 32.6299 0.945031 29.5595 0.616685C21.8746 -0.205236 14.1243 -0.205236 6.43949 0.616685C3.36977 0.944328 0.944084 3.37001 0.616441 6.44044C-0.20548 14.1253 -0.20548 21.8755 0.616441 29.5604C0.944787 32.6308 3.36977 35.0558 6.4402 35.3842C14.1251 36.2061 21.8753 36.2061 29.5602 35.3842C32.6306 35.0558 35.0556 32.6308 35.3839 29.5604C36.2058 21.8755 36.2058 14.1253 35.3839 6.44044H35.3832ZM15.2662 24.5058L9.32501 18.5534L10.94 16.9271L15.2662 21.2526L25.0357 11.4943L26.6732 13.1093L15.2655 24.5058H15.2662Z" fill="#38B22D"></path>
                </svg>
                <span>Платеж получен</span>
            </div>
        </div>
    </div>

    <div id="success-info">
        <div class="container">
            <p>Желаем Вам приятного массажа!</p>
            <p>Длительность массажа:</p>
            <p><span>{{ $minutes }}</span> минут</p>
        </div>
    </div>

    <div id="pause-info">
        <div class="container">
            <div class="pause-wrapper">
                <p>Чтобы поставить кресло на паузу и встать, Вы можете нажать на кнопку на правом подлокотнике кресла</p>
                <p><svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="100" height="100" rx="5" fill="#2A2A2A"></rect>
                        <rect x="34" y="25" width="11" height="50" rx="5.5" fill="#F7515B"></rect>
                        <rect x="55" y="25" width="11" height="50" rx="5.5" fill="#F7515B"></rect>
                    </svg></p>
                <p>Снова активировать кресло после паузы вы можете нажав на ту же кнопку. Однако учтите, что пока кресло стоит на паузе, время Ваше время массажа продолжает идти.</p>
            </div>
        </div>
    </div>

    <div id="for-home">
        <div class="container">
            <p>А вы знали, что такое кресло можно купить домой?</p>
            <p>Преимущества регулярного использования кресла дома</p>
            <ul>
                <li>Улучшение иммунитета</li>
                <li>Повышение тонуса кожи</li>
                <li>Улучшение качества сна</li>
                <li>Расслабление мышц</li>
                <li>Облегчение болей в суставах</li>
                <li>Укрепление нервной системы</li>
            </ul>
            <p><a href="#" class="btn">Узнать подробнее</a></p>
        </div>
    </div>

    @include("feedback")

    @include("footer")
@endsection