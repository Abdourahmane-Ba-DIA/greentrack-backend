<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EcoTip;
use Illuminate\Http\Request;

class EcoTipController extends Controller
{
    public function index()
    {
        $tips = EcoTip::orderBy('created_at', 'desc')->get();
        return response()->json($tips);
    }

    public function show($id)
    {
        $tip = EcoTip::findOrFail($id);
        return response()->json($tip);
    }

    public function byCategory($category)
    {
        $tips = EcoTip::where('category', $category)->orderBy('created_at', 'desc')->get();
        return response()->json($tips);
    }
}
