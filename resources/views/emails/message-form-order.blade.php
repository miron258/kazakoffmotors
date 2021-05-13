@component('emails.layouts.message', ['formOrder'=>$formOrder])


    <p class="line-top-content-cell"></p>
    <p class="title-message-text">{{$formOrder->personal->name}}, Ваш заказ создан</p>
    <p class="message-text message-text-top">
        Ожидайте подтверждение по email о готовности заказа. В случае отсутствия <br>
        какой-либо позиции в наличии оператор магазина свяжется с Вами.
    </p>
    <p class="line-bottom-content-cell"></p>
    <p class="message-text message-text-bottom">
        <span class="title-data-order">
              Номер заказа: {{$formOrder->num_order}}
        </span>
        <span class="row-data-order row-data-order-top">
            Способ оплаты: <b>{{getMethodPayment($formOrder->payment_method)}}</b>
        </span>
        <span class="row-data-order row-data-order-bottom">
         Способ доставки: <b>{{getMethodDelivery($formOrder->delivery_method)}}</b>
        </span>
{{--        <span class="row-data-order row-data-order-bottom">--}}
{{--         Интервал доставки: <b>доставка курьером</b>--}}
{{--        </span>--}}
        @if($formOrder->delivery_method != 1)
            <span class="row-data-order row-data-order-bottom">
          Адрес доставки: <b>{{$formOrder->city}} ул.{{$formOrder->delivery->street}}, д.{{$formOrder->delivery->house_num}}
                    @if(isset($formOrder->delivery->zip_code) && !empty($formOrder->delivery->zip_code)), Почтовый индекс {{$formOrder->delivery->zip_code}} @endif
                    @if(isset($formOrder->delivery->corps) && !empty($formOrder->delivery->corps))<br>Корпус {{$formOrder->delivery->corps}} @endif
                    @if(isset($formOrder->delivery->structure) && !empty($formOrder->delivery->structure)), Строение {{$formOrder->delivery->structure}} @endif
                    @if(isset($formOrder->delivery->office) && !empty($formOrder->delivery->office)), Офис {{$formOrder->delivery->office}} @endif
            </b>
        </span>
        @endif
        <span class="row-data-order row-data-order-bottom">
          Получатель: <b>{{$formOrder->personal->name}} {{$formOrder->personal->surname}}</b>
        </span>
        <span class="row-data-order row-data-order-bottom">
          Телефон получателя: <b>{{$formOrder->personal->phone}}</b>
        </span>
    </p>
    <p class="line-bottom-data-order"></p>


    @slot('orders')
        @component('emails.layouts.orders',
        [
        'products'=>$formOrder->products,
        'formOrder'=>$formOrder,
        'url' => config('app.url')
        ])
        @endcomponent
    @endslot


@endcomponent
















