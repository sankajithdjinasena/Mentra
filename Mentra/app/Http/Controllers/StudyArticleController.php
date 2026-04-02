<?php

namespace App\Http\Controllers;

use App\Models\study_article;
use Illuminate\Http\Request;

class StudyArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.artical');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|url|max:1000',
        ]);

        $article = new study_article();
        $article->title = $request->title;
        $article->url = $request->url;
        $article->save();

        return redirect()->back()->with('success', 'Article added successfully!');
    }



    public function storeuserartical(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|url|max:1000',
        ]);

        $article = new study_article();
        $article->title = $request->title;
        $article->url = $request->url;
        $article->status = 2;
        $article->save();

        return redirect()->back()->with('success', 'Article added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function index_view()
    {
        $articles = study_article::get();
        return view('admin.viewarticle', compact('articles'));
    }

    public function edit($id)
    {
        // edit
        $article = study_article::findOrFail($id);
        return view('admin.editarticle', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|url|max:1000',
        ]);

        $article = study_article::findOrFail($id);
        $article->update($request->only('title', 'url'));

        return redirect()->route('Article.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = study_article::findOrFail($id);
        $article->status = 0;
        $article->save();

        return redirect()->route('Article.index')->with('success', 'Article deleted successfully!');
    }

    public function restore($id)
    {
        $article = study_article::findOrFail($id);
        $article->status = 1;
        $article->save();

        return redirect()->route('Article.index')->with('success', 'Article restored successfully!');
    }




    public function approve($id)
{
    $article = study_article::findOrFail($id);
    $article->status = 3;
    $article->save();

    return redirect()->back()->with('success', 'Article approved successfully!');
}

public function unapprove($id)
{
    $article = study_article::findOrFail($id);
    $article->status = 2;
    $article->save();

    return redirect()->back()->with('success', 'Article unapproved successfully!');
}


}
