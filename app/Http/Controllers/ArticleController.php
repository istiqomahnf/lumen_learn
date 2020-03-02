<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Article;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\File;
use Validator;
use App\Http\Resources\ArticleCollection as ArticleResource;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->session()->get('api_token');
        $cat = Category::all();
        if ($token == null) {
            return redirect()->route('index');
        }
        return view('view', ['category'=> $cat]);
    }

    public function userRole(Request $request)
    {   
        $token = $request->session()->get('api_token');
        if ($token == null) {
            // return view('index', ['message'=>'']);
            return redirect()->route('index');
        }
        $article    = Article::with('category')->with('user')->where('article_status', 1)->get();
        return view('view_article', ['article'=>$article]); 
    }
    public function add(Request $request)
    {   
        $token = $request->session()->get('api_token');
        $cat = Category::all();
        if ($token == null) {
            return redirect()->route('index');
        }
        return view('add',['category' => $cat]);
    }

    public function create(Request $request)
    {   
        $filename = null;
        $user_id    = $request->session()->get('user_id');
        $validator  = Validator::make($request->all(), [
            'title'     => 'required',
            'desc'      => 'required',
            'category'  => 'required'
        ]);
        if ($validator->passes()) {
            if($request->file != null){
                $file       = $request->file('file');
                $filename   = time()."_".$file->getClientOriginalName();
                $filepath   = 'upload_file';
                $file->move($filepath, $filename);
            }
            // Article::create([
            //     'article_title'         => $request->title,
            //     'article_description'   => $request->desc,
            //     'category_id'           => $request->category,
            //     'article_status'        => 0,
            //     'user_id'               => $user_id,
            //     'file'                  => $filename,
            //     'date_created'          => date('Y-m-d')
            // ]);
            $article = new Article;
            $article->article_title         = $request->title;
            $article->article_description   = $request->desc;
            $article->category_id           = $request->category;
            $article->article_status        = 0;
            $article->user_id               = $user_id;
            $article->file                  = $filename;
            $article->date_created          = date('Y-m-d');

            if($article->save()){
                return response()->json(['status'=>"success"], 200);
            }else{
                return response()->json(['err'=>"error"], 200);
            }
        } else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function view(Request $request)
    {
        $article    = Article::with('category')->with('user')->get();
        $count      = Article::count();
        if($request->header('Authorization')){
            return response()->json(['result'=> $article, 
                                        'count'=> $count, 
                                        'token' => $request->header('Authorization')], 200);
        }
    }

    public function search(Request $request)
    {
        $start  = $request->start;
        $end    = $request->end;
        $article    = Article::with('category')
                                ->with('user')
                                ->whereBetween('date_created', [$start, $end])
                                ->get();
        $count      = $article->count();
        $header = $request->header('Authorization');
        return response()->json(['result'=> $article, 
                                    'count'=> $count, 
                                    'token' => $header], 200);
    }

    public function getEdit(Request $request, $id)
    {   
        $article    = Article::find($id);
        // return response()->json($article, 200);
        return new ArticleResource($article);
    }

    public function update(Request $request)
    {
        $id         = $request->id;
        $title      = $request->title;
        $desc       = $request->desc;
        $category   = $request->category;

        if($request->file != "") {
            $file       = $request->file('file');
            $filename   = time()."_".$file->getClientOriginalName();
            $filepath   = 'upload_file';
            $file->move($filepath, $filename);
            $update = Article::find($id)
                            ->update([
                                'article_title'         => $title,
                                'article_description'   => $desc,
                                'category_id'           => $category,
                                'file'                  => $filename
                            ]);
        } else{
            $update = Article::find($id)
                            ->update([
                                'article_title'         => $title,
                                'article_description'   => $desc,
                                'category_id'           => $category
                            ]);
        }
        return response()->json($update, 200);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        return response()->json($article->delete(), 200);
    }

    public function send($id)
    {
        $article = Article::find($id)->update(['article_status'=>1]);
        return response()->json($article, 200);
    }

    public function trash(Request $request)
    {
        $token = $request->session()->get('api_token');
        if ($token == null) {
            return view('index');
        }
        $article = Article::with('category')->with('user')->onlyTrashed()->paginate(2);
        return view('trash', ['article' => $article]);
    }

    public function restore_delete(Request $req)
    {
        $id = $req->id;
        $article = Article::withTrashed()->where('article_id', $id);
        if ($article->restore()) {
            return response()->json(['status' => true, 'message' => "Restore Data Success"]);
        } else{
            return response()->json(['status' => false, 'message' => "Restore Data Failed"]);
        }
    }

    public function delete_permanent($id)
    {
        $article = Article::withTrashed()->where('article_id', $id)->first();
        $filename = 'upload_file/'.$article->file;
        File::delete($filename);
        if ($article->forceDelete()) {
            return response()->json(['status' => true]);
        } else{
            return response()->json(['status' => false]);
        }
    }
}
