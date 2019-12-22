<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('Dawnstar::category.home', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->where('status', 1)->pluck('name', 'id');
        return view('Dawnstar::category.create', compact('parents'));
    }

    public function store()
    {
        $data = request()->all();
        unset($data['_token']);

        $category = Category::firstOrCreate(
            $data
        );

        if ($category->wasRecentlyCreated) {
            return redirect()->route('panel.category.index')->with('message', 'Successfully Saved');
        }
        return redirect()->back()->withErrors(['message', 'There is a record in this name and slug'])->withInput();
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $parents = Category::whereNull('parent_id')->where('status', 1)->pluck('name', 'id');

        return view('Dawnstar::category.edit', compact('category', 'parents'));
    }

    public function update($id)
    {
        $category = Category::find($id);
        $data = request()->all();
        unset($data['_token']);

        $category->update($data);

        if ($category->wasChanged()) {
            return redirect()->back()->with('message', 'The update was done successfully.');
        }
        return redirect()->back()->withErrors(['message', 'Update failed.'])->withInput();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            if ($category->trashed()) {
                return redirect()->route('panel.category.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
