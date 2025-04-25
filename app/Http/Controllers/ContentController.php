<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Parsedown;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->body = (new Parsedown())->text($request->body);
        $content->save();
        return redirect()->route('contents.index');
    }

    public function edit(Content $content)
    {
        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $content->title = $request->title;
        $content->body = (new Parsedown())->text($request->body);
        $content->save();
        return redirect()->route('contents.index');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index');
    }
}