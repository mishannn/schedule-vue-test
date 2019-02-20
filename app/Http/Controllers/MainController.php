<?php

namespace App\Http\Controllers;

class MainController extends Controller {
    public function home() {
        return view('home');
    }

    public function any() {
        return abort(404);
    }

    public function apiAny() {
        return response([
            'success' => false,
            'error' => 'Метод не найден',
        ], 400);
    }
}