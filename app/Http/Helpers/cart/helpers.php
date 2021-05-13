<?php
if (!function_exists('getMethodDelivery')) {
    function getMethodDelivery($methodDelivery)
    {
        switch ($methodDelivery) {
            case 1:
                return 'Самовывоз';
            case 2:
                return 'Доставка курьром по Москве';
            case 3:
                return 'Почта России';
            case 4:
                return 'EMS Почта России';
            default:
                return 'Не определено';
        }

    }
}
if (!function_exists('getMethodPayment')) {
    function getMethodPayment($methodPayment)
    {
        switch ($methodPayment) {
            case 1:
                return 'Наличными';
            case 2:
                return 'Оплата картой в магазине';
            case 3:
                return 'Оплата картой на сайте';
            default:
                return 'Не определено';
        }
    }
}

if (!function_exists('format_phone')) {
    function format_phone($phone = '')
    {
        $resPhone = preg_replace("/[^0-9]/", "", $phone);
        if (strlen($resPhone) === 11) {
            $resPhone = preg_replace("/^7/", "8", $resPhone);
        }
        return $resPhone;
    }
}
