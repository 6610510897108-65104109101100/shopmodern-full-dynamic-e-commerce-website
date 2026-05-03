<?php

namespace App\Http\Controllers;

use App\Models\Order;

final class OrderThankYouController
{
    public function __invoke(Order $order)
    {
        return view('public.thankyou', compact('order'));
    }
}