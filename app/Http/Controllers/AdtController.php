<?php

namespace App\Http\Controllers;

use App\Models\Adt;
use Illuminate\Http\Request;

class AdtController extends Controller
{
    public function adt($slug)
    {
        $adt = Adt::query()->where('slug',$slug)->first();
        return json_encode($adt);
    }
}
