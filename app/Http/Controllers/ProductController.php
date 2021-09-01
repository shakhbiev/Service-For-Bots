<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Bot;

class ProductController extends Controller
{
    public function index(Bot $bot)
    {
        $this->authorize('check', $bot);

        $categories = $bot->categories()->whereNull('category_id')
        ->with('childrenCategories')->get();

        return Inertia::render('Product/Select', [
            'categories' => $categories,
            'bot' => [
                'id' => $bot->id,
                'name' => $bot->name,
            ],
        ]);    
    }
}
