<?php

namespace App\Http\Controllers;

use App\Models\CLient;
use App\Services\MyFatoorahServices;
use Illuminate\Http\Request;

class MyFatoorahController extends Controller
{
    private $myFatoorahServices;
    public function __construct(MyFatoorahServices $myFatoorahServices)
    {
        $this->myFatoorahServices = $myFatoorahServices;
    }

    public function payOrder(){
//        $client = CLient::first();
        $data = [
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '100',
            'CustomerName'       => 'name',
            'CustomerMobile'     => '1234567890',
            'CustomerEmail'      => 'email@gmail.com',
            'CallBackUrl'        => 'http://127.0.0.1:8000/api/payment-callback',
            'ErrorUrl'           => 'http://127.0.0.1:8000/api/payment-error',
            'Language'           => 'en', //or 'ar'
            'DisplayCurrencyIso' => 'EGP',
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

        $this->myFatoorahServices->sendPayment($data);
    }

    public function paymentCallback(Request $request)
    {
        dd($request);
    }

    public function paymentError(Request $request)
    {
        echo 'error';
    }
}
