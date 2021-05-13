@if(isset($products) && !empty($products))
    <table cellspacing="0" cellpadding="0" class="table-products">

        <tr class="table-products-header">
            <th class="header-th-bold">Товар</th>
            <th class="header-th-default"></th>
            <th class="header-th-default">Кол-во</th>
            <th class="header-th-default header-th-default-price">Цена</th>
            {{--            <th class="header-th-default">Сумма</th>--}}
        </tr>

        @foreach($products as $product)
            <tr class="table-products-row border-top">

                <td class="table-products-cell table-products-cell-img">
                    @if(!empty($product->productModel['pathImgThumbnail']) && isset($product->productModel))
                        <a target="_blank" class="link-product"
                           href="{{$product->productModel['fullUrl']}}">
                            <img alt="{{$product->name}}" class="img-product"
                                 src="{{$product->productModel['pathImgThumbnail']}}">
                        </a>
                    @else

                    @endif
                </td>

                <td class="table-products-cell table-products-cell-name">
                    <a class="name-product" target="_blank" href="{{$product->productModel['fullUrl']}}">{{$product->name}}</a>
                </td>
                <td class="table-products-cell table-products-cell-qty">
                    {{$product->qty}}
                </td>
                <td class="table-products-cell table-products-cell-price">
                    {{$product->price}} <span class="ruble">p</span>
                </td>
                {{--                <td class="table-products-cell table-products-cell-sum">--}}
                {{--                    {{$product->total_price}}--}}
                {{--                </td>--}}
            </tr>
        @endforeach

        <tr class="table-products-row table-products-row-foot-price border-top">
            <td colspan="3" class="td-sum-text">
                Сумма
            </td>
            <td class="td-sum-value">
                {{$formOrder->sumOrder}} <span class="ruble">p</span>
            </td>
        </tr>

        @if($formOrder->delivery_method == 2)
            <tr class="table-products-row table-products-row-foot-delivery">
                <td colspan="3" class="td-sum-text">
                    Стоимость доставки
                </td>
                <td class="td-sum-value">
                    500 <span class="ruble">p</span>
                </td>
            </tr>
        @endif


        <tr class="table-products-row table-products-row-foot-total-amount border-top border-bottom">
            <td colspan="3" class="td-text-total-amount">
                Итого к оплате
            </td>
            <td class="td-price-total-amount">
                {{$formOrder->totalAmount}} <span class="ruble">p</span>
            </td>
        </tr>

        <tr class="table-products-row table-products-row-foot-notes">
            <td colspan="4" class="td-notes">
                <div class="notes-text notes-text-top">
                    Здесь могут быть какие-либо примечания по доставке или работе интернет-магазина
                </div>
                <div class="notes-text notes-text-bottom">
                    Здесь могут быть какие-либо примечания по доставке или работе интернет-магазина
                </div>
            </td>
        </tr>


        <tr class="table-products-row table-products-row-payment-methods">
            <td colspan="4" class="td-payment-methods">
                <div class="title-payment-methods">Мы принимаем к оплате:</div>
                <ul class="list-payment-methods">
                    <li class="item-payment-method">
                        <img class="img-payment" alt="Apple Pay" src="{{$url}}/img/tpl_img/icons_payment_email/apple_pay.png">
                    </li>
                    <li class="item-payment-method">
                        <img class="img-payment" alt="Master Card" src="{{$url}}/img/tpl_img/icons_payment_email/master_card.png">
                    </li>
                    <li class="item-payment-method">
                        <img class="img-payment" alt="Visa" src="{{$url}}/img/tpl_img/icons_payment_email/visa.png">
                    </li>
                </ul>
            </td>
        </tr>


    </table>
@endisset
