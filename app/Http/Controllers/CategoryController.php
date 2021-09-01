<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Bot;

class CategoryController extends Controller
{
    public function categories(Bot $bot)
    {
        $this->authorize('check', $bot);

        $categories = $bot->categories()->whereNull('category_id')
            ->with('childrenCategories')->get();

        return Inertia::render('Category/Index', [
            'categories' => $categories,
            'bot' => [
                'id' => $bot->id,
                'name' => $bot->name,
            ],
        ]);    
    }

    public function createCategory(Bot $bot)
    {
        $this->authorize('check', $bot);

        Request::validate([
            'name' => ['required', 'min:3'],
        ]);
 
        $bot->categories()->create([
            'name' => Request::get('name'),
        ]);

        return redirect()->back()->with('success', 'Категория добавлена!');
    }    

    public function destroy(Category $category)
    {
        $this->authorize('access', $category);

        $category->delete();
        return redirect()->back()->with('success', 'Категория удалена!');
    }    

    public function subcategories(Bot $bot, Category $category)
    {
        $this->authorize('check', $bot);
        $this->authorize('access', $category);

        $subcategories = $bot->categories()->where('category_id', $category->id)
            ->with('childrenCategories')
            ->get();
        
        return Inertia::render('Category/SubIndex', [
            'category' => $category,
            'subcategories' => $subcategories,
            'bot' => [
                'id' => $bot->id,
                'name' => $bot->name,
            ],
        ]);    
    } 
    
    public function createSubcategory(Bot $bot, Category $category)
    {
        $this->authorize('check', $bot);
        $this->authorize('access', $category);

        Request::validate([
            'name' => ['required', 'min:3'],
        ]);
 
        $category->categories()->create([
            'name' => Request::get('name'),
            'bot_id' => $bot->id,
        ]);

        return redirect()->back()->with('success', 'Подкатегория добавлена!');
    }       
}
