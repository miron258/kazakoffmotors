@component('emails.layouts.message', ['formOrder'=>''])
<h3>Мотосервис Казакофф Моторс JOB плановая работа</h3>
<p>
    На сайте Мотосервис Казакофф Моторс была произведена глобальная конвертация цен
</p>
<h2>Список сконвертированных цен у товаров</h2>
@foreach($products as $product)
    <p> Название товара: <b>{{$product->name}}</b>,<br>
        Цена товара: <b>{{$product->price}}</b><br>
        Новая цена товара: <b>{{$product->new_price}}</b>
    </p>
@endforeach
@endcomponent


