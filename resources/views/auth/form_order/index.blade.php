@extends('auth.layouts.app')
@section('title', 'Список форм заказа')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">@yield('title')</div>


                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Дата заказа</td>
                                <td>Номер заказа</td>
                                <td>Способ доставки</td>
                                <td>Способ оплаты</td>
                                <td>Имя клиента</td>
                                <td>Телефон</td>
                                <td>Email</td>
                                <td>Комментарий к заказу</td>
                                <td>Сумма заказа</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>


                            <tbody>

                            @foreach($formOrders as $formOrder)
                                <tr>
                                    <td>{{ $formOrder->id }}</td>
                                    <td>{{ $formOrder->dateOrder }}</td>
                                    <td>{{$formOrder->num_order}}</td>
                                    <td>
                                        @php echo getMethodDelivery($formOrder->delivery_method); @endphp
                                    </td>
                                    <td>
                                        @php echo getMethodPayment($formOrder->payment_method); @endphp
                                    </td>
                                    <td>{{ $formOrder->personal->name }} {{ $formOrder->personal->surname }}</td>
                                    <td>{{$formOrder->personal->phone}}</td>
                                    <td><a href="mailto:{{$formOrder->personal->email}}">{{$formOrder->personal->email}}</a></td>
                                    <td>{{$formOrder->text_order}}</td>
                                    <td>{{ $formOrder->sumOrder }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                           href="{{route('formOrder.show', $formOrder->id)}}"><i
                                                class="far fa-edit mr-2"></i>Просмотреть детально</a>
                                    </td>
                                    <td>
                                        <form action='{{route('formOrder.destroy', $formOrder->id)}}' method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash mr-2"></i>Удалить
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>


                        <div class='paginate'>
                            {{$formOrders->links()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
