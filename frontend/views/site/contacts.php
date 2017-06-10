<?php

use yii\helpers\Url;

$this->title = 'Магазин кованых элементов: телефон, адрес – Ковкаснаб';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'контакты магазина кованых элементов, элементы художественной ковки, ковка, литьё, штамповка, цены, характеристики, фото, ковкаснаб'
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Магазин кованых элементов. Здесь можно купить элементы художественной ковки по доступным ценам! Контакты, номер телефона, адрес.'
], 'meta-description');

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-other.jpg']),
    'categories' => $categories,
]) ?>

<div class="white-area">

    <div class="space-area"></div>

    <div class="contatcs container">

        <h1>Контакты</h1>

        <div class="text">


            <p><b>Адрес:</b> г. Тамбов, ул. Урожайная, д. 1а, 3 этаж</p>

            <p><b>Телефон:</b> 8-900-510-7777</p>

            <p><b>E-mail:</b> info@kovkasnab.ru</p>

            <p>
                <b>Режим работы:</b><br>

                Пн – Пт: 8:00 – 17:00<br>
                Сб (в летнее время): 8:00 – 12:00<br>
                Сб (в зимнее время): выходной<br>
                Вс: выходной
            </p>

            <p>
                <b>Как добраться на личном транспорте:</b><br>

                от перекрестка ул. Советская/бул. Энтузиастов (сквер им. Вернадского) по ул. Урожайной около 700 метров в сторону ТЭЦ;<br>
                от ТЭЦ по ул. Урожайной около 1100 метров в сторону бул. Энтузиастов.
            </p>

            <p>
                <b>Как добраться на общественном транспорте:</b><br>

                маршуртами T8, T10, А13к, А15, А21, А144, А151 до остановки “ТЭЦ”, далее пешком около 15 минут по ул. Урожайной;<br>
                маршуртами T1, А1, А18, А44, А50, А52, А55 до остановки “Бульвар строителей” далее пешком около 5 минут до ул. Урожайной и 10 минут по ул. Урожайной.
            </p>

            <p>
                <b>Реквизиты:</b><br>
                ИП Перфильев Владимир Александрович<br>
                ИНН 682968421640 ОГРНИП 316682000075189<br>
                р/с 40802810500000070287<br>
                АО "ТИНЬКОФФ БАНК"<br>
                к/с 30101810145250000974<br>
                БИК 044525974
            </p>

            <p class="map">
                <script src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=9Olfo0vlxDEx42-chC1roUzIocF6mg3T&amp;width=100%&amp;height=600&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true" async="" type="text/javascript" charset="utf-8"></script>
            </p>

        </div>

    </div>

    <div class="space-area"></div>

</div>


<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>