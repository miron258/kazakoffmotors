<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/07011c2ca686bc3ba40f57c576da1965?family=ALS+Rubl" rel="stylesheet" type="text/css"/>
</head>
<body>
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="700" align="center" cellpadding="0" cellspacing="0" role="presentation">

                <!---------------- Header message ------------------>
                <tr>
                    <td class="header">
                        {{$header}}
                    </td>
                </tr>
                <!---------------- End Header message ------------------>

            @isset($message)
                <!-- Content Message Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="700" cellpadding="0" cellspacing="0"
                                   role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{$message}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            @endisset

            @isset($orders)
                <!--------------  Orders Body ---------------->
                    <tr>
                        <td class="body body-products" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body inner-body-products" align="center" width="700" cellpadding="0"
                                   cellspacing="0"
                                   role="presentation">
                                <tr>
                                    <td class="content-cell title-products">Вы заказали</td>
                                </tr>
                                <!-- Orders content -->
                                <tr>
                                    <td class="content-cell list-orders-products">
                                        {{$orders}}
                                    </td>
                                </tr>
                                <!-- /Orders content -->
                            </table>
                        </td>
                    </tr>
                @endisset

                @isset($footer)
                    <tr>
                        <td class="body body-footer" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body inner-body-footer" align="center" width="700" cellpadding="0"
                                   cellspacing="0"
                                   role="presentation">
                                <!-- Footer content -->
                                {{$footer}}
                            </table>
                        </td>
                    </tr>
                @endisset


            </table>
        </td>
    </tr>
</table>
</body>
</html>
