<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $oldestPhoto = Photo::orderBy('year', 'asc')->first();
        $minYear = $oldestPhoto ? $oldestPhoto->year : 1826;
        $currentYear = date('Y');

        return view('welcome', ['min' => $minYear, 'max' => $currentYear]);
    }

    public function search(int $from, int $to) {
        return new JsonResponse(Photo::where('year', '>=', $from)->where('year', '<=', $to)->get());
    }
}
