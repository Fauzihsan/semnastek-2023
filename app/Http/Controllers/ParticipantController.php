<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class ParticipantController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
        $this->middleware('auth');
    }

    public function index()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $article = Article::all()->where('users_id', Auth::id());
        $lingkup = array(
            'Geography Information System',
            'Security Network',
            'Big Data',
            'Information System',
            'Enterprise Resource Planning',
            'Internet of Things, Cloud Computing',
            'Artificial Intelligent',
            'Soft Computing',
            'Multimedia',
            'Game',
            'Human Computer Interaction',
            'Industrial systems',
            'Manufacturing systems',
            'Systems Engineering & Ergonomics',
            'Industrial Management',
            'Supply Chain and Logistics',
            'Structure engineering',
            'Transportation engineering',
            'Project management engineering',
            'traffic engineering',
        );
        return view('participant_page', compact('name', 'email', 'article', 'lingkup'));
    }

    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'participant_category' => 'required',
            'ktm_file' => 'file|mimes:pdf',
            'title' => 'required',
            'abstract' => 'required',
            'knowledge_field' => 'required',
            'article_scope' => 'required',
            'article_file' => 'required|file|mimes:pdf',
            'correspondence' => 'required',
            'affiliate.*' => 'required',
            'first_name.*' => 'required',
            'last_name.*' => 'required',
            'email.*' => 'required|email',
        ]);

        $article = new Article;
        $article->users_id = Auth::id();
        $article->participant_category = $request->participant_category;
        if (isset($request->ktm_file)) {
            //start upload ktm
            $extension = $request->file('ktm_file')->extension();
            $ktm = 'ktm' . time() . '.' . $extension;
            $request->file('ktm_file')->storeAs('public/ktm', $ktm);
            //finish upload ktm
            $article->ktm_file = $ktm;
        }
        $article->title = $request->title;
        $article->abstract = $request->abstract;
        $article->knowledge_field = $request->knowledge_field;
        $article->article_scope = $request->article_scope;
        //start upload article
        $extension = $request->file('article_file')->extension();
        $article_file = 'article' . time() . '.' . $extension;
        $request->file('article_file')->storeAs('public/articles', $article_file);
        //finish upload article
        $article->article_file = $article_file;
        $article->correspondence = $request->correspondence;
        $article->article_status = 'pending';

        $article->save();

        //insert to author table
        $affiliate = $request->affiliate;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;

        $data = array();
        foreach ($affiliate as $key => $d) {
            $data[] = [
                'articles_id' => $article->id,
                'affiliate' => $d,
                'first_name' => $first_name[$key],
                'last_name' => $last_name[$key],
                'email' => $email[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Author::insert($data);

        $alert = array(
            'message' => 'Artikel Berhasil diunggah',
            'alert-type' => 'success'
        );
        return redirect()->route('participant')->with($alert);
    }

    public function unduh($article_file)
    {
        $file = public_path('/storage/articles/' . $article_file);
        return response()->download($file);
    }
}
