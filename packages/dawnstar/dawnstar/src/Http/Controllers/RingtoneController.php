<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;
use Illuminate\Support\Facades\Storage;

class RingtoneController extends Controller
{

    public function index()
    {
        $ringtones = Ringtone::all();

        return view('Dawnstar::ringtones.home', compact('ringtones'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->where('status', 1)->get();

        $hold = array();
        foreach ($categories as $category) {
            foreach ($category->children as $child) {
                $hold[$child->id] = $category->name . ' >> ' . $child->name;
            }
        }

        return view('Dawnstar::ringtones.create', ['categories' => $hold]);
    }

    public function store()
    {
        $data = request()->except(['_token', 'file']);


        $file = request()->file('file');
        if ($file != null) {
            $fileName = uniqid() . "-" . $file->getClientOriginalName();
            $file->storeAs('ringtones', $fileName);
            $data['file'] = Storage::disk('public')->url("/ringtones/" . $fileName);
        }
        $file = request()->file('demo_file');
        if ($file != null) {
            $fileName = uniqid() . "-" . $file->getClientOriginalName();
            $file->storeAs('ringtones', $fileName);
            $data['demo_file'] = Storage::disk('public')->url("/ringtones/" . $fileName);
        }
        $ringtone = Ringtone::firstOrCreate(
            $data
        );


        if ($ringtone->wasRecentlyCreated) {
            return redirect()->route('panel.ringtone.index')->with('message', 'Successfully Saved');
        }
        return redirect()->back()->withErrors(['message', 'There is a record in this name and slug'])->withInput();
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $ringtone = Ringtone::find($id);
        $hold = Category::whereNull('parent_id')->where('status', 1)->get();

        $categories = array();
        foreach ($hold as $category) {
            foreach ($category->children as $child) {
                $categories[$child->id] = $category->name . ' >> ' . $child->name;
            }
        }

        return view('Dawnstar::ringtones.edit', compact('ringtone', 'categories'));
    }

    public function update($id)
    {
        $ringtone = Ringtone::find($id);
        $data = request()->except(['_token', 'file']);

        $file = request()->file('file');
        if ($file != null) {
            $fileName = uniqid() . "-" . $file->getClientOriginalName();
            $file->storeAs('ringtones', $fileName);
            $data['file'] = Storage::disk('public')->url("/ringtones/" . $fileName);
        }
        $file = request()->file('demo_file');
        if ($file != null) {
            $fileName = uniqid() . "-" . $file->getClientOriginalName();
            $file->storeAs('ringtones', $fileName);
            $data['demo_file'] = Storage::disk('public')->url("/ringtones/" . $fileName);
        }

        $ringtone->update($data);

        if ($ringtone->wasChanged()) {
            return redirect()->back()->with('message', 'The update was done successfully.');
        }
        return redirect()->back()->withErrors(['message', 'Update failed.'])->withInput();
    }

    public function delete($id)
    {
        $ringtone = Ringtone::find($id);
        if ($ringtone) {
            $ringtone->delete();
            if ($ringtone->trashed()) {
                return redirect()->route('panel.ringtone.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
