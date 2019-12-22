<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Question;
use Dawnstar\Models\Tag;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::with('user')
            ->withCount('answers')
            ->withCount('comments')
            ->withCount('like')
            ->withCount('dislike')
            ->get();

        return view('Dawnstar::question.home', compact('questions'));
    }

    public function create()
    {
        $tags = Tag::where('status', 1)->get()->pluck('name', 'id');
        return view('Dawnstar::question.create', compact('tags'));
    }

    public function store()
    {
        $data = request()->all();
        $tags_id = $data['tags_id'];

        unset($data['_token']);
        unset($data['tags_id']);


        $data['share_link'] = shareLink($data['name']);

        $data['user_id'] = auth()->id();

        $question = Question::firstOrCreate(
            $data
        );

        $question->tags()->attach($tags_id);

        if ($question->wasRecentlyCreated) {
            return redirect()->route('panel.question.index')->with('message', 'Successfully Saved');
        }
        return redirect()->back()->withErrors(['message', 'There is a record in this name and slug'])->withInput();
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $question = Question::find($id);
        $tags = Tag::where('status', 1)->get()->pluck('name', 'id');
        $selected_tags = $question->tags()->get()->pluck('id')->toArray();

        return view('Dawnstar::question.edit', compact('question', 'tags', 'selected_tags'));
    }

    public function update($id)
    {
        $question = Question::find($id);
        $data = request()->all();
        $tags_id = $data['tags_id'];

        unset($data['_token']);
        unset($data['tags_id']);

        $question->update($data);

        $selected_tags = $question->tags()->get()->pluck('id')->toArray();

        $question->tags()->detach($selected_tags);
        $question->tags()->attach($tags_id);

        if ($question->wasChanged()) {
            return redirect()->back()->with('message', 'The update was done successfully.');
        }
        return redirect()->back()->withErrors(['message', 'Update failed.'])->withInput();
    }

    public function delete($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->delete();
            if ($question->trashed()) {
                return redirect()->route('panel.question.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
