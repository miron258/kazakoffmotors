@component('emails.layouts.message', ['formOrder'=>$formOrder])
    <h3>Заявка с формы заказа запчасти Мотосервиса Казакофф Моторс</h3>
    <p><b>Запчасть:</b> {{ $formOrder->spart }}</p>
    <p><b>Имя:</b> {{  $formOrder->name }}</p>
    <p><b>Email:</b> {{  $formOrder->email }}</p>
    <p><b>Номер телефона:</b> {{  $formOrder->phone }}</p>
@endcomponent
