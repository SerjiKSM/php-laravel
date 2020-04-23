<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App;

class SendEmailController extends Controller
{
    public function sendEmail()
    {
        $productService = App::make('App\Services\ProductService');
        $orderProducts = $productService->getOrderProductsWithoutPaginate()->get();

        $data = array(
            'name' => 'Ser',
            'message' => 'Report Order Products!',
            'orderProducts' => $orderProducts,
        );

        Mail::to(config('app.mail_send_to'))
            ->cc(config('app.mail_send_cc'))
            ->bcc(config('app.mail_send_bcc'))
            ->send(new SendMail($data));

        return back()->with('success', 'Report data is sent!');
    }
}
