<?php
namespace App\Http\Controllers;
abstract class Controller
{
    protected function rupiah($value): string
    {
        return 'Rp '.number_format((float) $value, 0, ',', '.');
    }
}
