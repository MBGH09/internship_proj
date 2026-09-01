<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mb_Category;
use App\Models\mb_User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        
        $categories = mb_Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function adminIndex()
    {
        $categories = mb_Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        
        return view('admin.categories.create');
    }

    public function adminCreate()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
       
       $validated = $request->validate([
              'mb_cat_name' => 'required|string|max:255|unique:mb_categories,mb_cat_name',
              'mb_cat_description' => 'nullable|string',
         ],[
              'mb_cat_name.required' => 'The category name field is required.',
         ]);

        mb_Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    public function edit(mb_Category $category)
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, mb_Category $category)
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        
        $validated = $request->validate([
            'mb_cat_name' => 'required|string|max:255|unique:mb_categories,mb_cat_name,' . $category->mb_cat_id . ',mb_cat_id',
            'mb_cat_description' => 'nullable|string',
        ], [
            'mb_cat_name.required' => 'The category name field is required.',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(mb_Category $category)
    {
        // Check if user is admin
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }














    }    