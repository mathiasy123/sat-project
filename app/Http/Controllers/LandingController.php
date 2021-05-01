<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Testimony;
use App\Models\Category;
use App\Models\Description;

class LandingController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('pages.customers.landing.index', [
            'title' => 'Beranda',
            'categories' => $categories
        ]);
    }

    public function contact() {
        return view('pages.customers.landing.contact', ['title' => 'Kontak']);
    }

    public function testimony() {
        $testimonies = Testimony::orderBy('created_at', 'desc')
                                    ->where('status', 1)
                                    ->get();

        return view('pages.customers.landing.testimony', [
            'title' => 'Testimoni',
            'testimonies' => $testimonies
        ]);
    }

    public function about() {
        $description = Description::where('status', 1)->first();

        return view('pages.customers.landing.about', [
            'title' => 'Tentang',
            'description' => $description
        ]);
    }
}
