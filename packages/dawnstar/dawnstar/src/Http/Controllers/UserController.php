<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Admin;
use Dawnstar\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        $admins = Admin::all();

        return view('Dawnstar::user.home', compact('users', 'admins'));
    }

    public function create()
    {
        return view('Dawnstar::user.create');
    }

    public function store()
    {
        $data = request()->all();
        unset($data['_token']);

        $data['password'] = Hash::make($data['password']);

        $file = request()->file('image');
        if ($file != null) {
            $fileName = uniqid() . "-" . $file->getClientOriginalName();
            $file->storeAs('', $fileName);
            $data['image'] = Storage::disk('public')->url($fileName);
        }

        $user = User::firstOrCreate(
            $data
        );

        if ($user->wasRecentlyCreated) {
            return redirect()->route('panel.user.index')->with('message', 'Successfully Saved');
        }
        return redirect()->back()->withErrors(['message', 'There is a record in this name and slug'])->withInput();
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('Dawnstar::user.edit', compact('user'));
    }

    public function update($id)
    {
        $user = User::find($id);
        $data = request()->all();
        unset($data['_token']);

        if(Hash::check($data['password'], $user->password)) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $file = request()->file('image');
        if ($file != null) {
            $fileName = uniqid()."-".$file->getClientOriginalName();
            $file->storeAs('', $fileName);
            $data['image'] = Storage::disk('public')->url($fileName);
        }

        $user->update($data);

        if ($user->wasChanged()) {
            return redirect()->back()->with('message', 'The update was done successfully.');
        }
        return redirect()->back()->withErrors(['message', 'Update failed.'])->withInput();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            if ($user->trashed()) {
                return redirect()->route('panel.user.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
