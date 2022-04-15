<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $element = Element::find($request->input('element_id'));
        $element->comments()->create([
            'comment' => $request->input('comment'),
            'user_id' => $request->input('user_id')
        ]);

        $element->save();

        $categories = Category::all();
        return redirect()->route('elements.oneElement', compact('categories', 'element'));
    }

    public function show($comment)
    {
        return $comment;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        $comments = CommentResource::collection(Comment::all());
        return view('comments.index', compact('comments'));
    }

    public function filterComments($element)
    {
        $comments = CommentResource::collection($element->comments);

        return compact('comments');
    }
    
    public function filterCommentsByUser($user)
    {
        $comments = CommentResource::collection($user->comments);

        return compact('comments');
    }

    public function filter(Element $element)
    {
        return view('elements.show', [
            'categories' => Category::all(),
            'element' => $element,
            'comments' => $element->comments()
        ]);
    }

    public function changeStatus(Comment $comment)
    {
        $comment->status = 1;
        $comment->save();
        $comments = CommentResource::collection(Comment::all());
        return view('comments.index', compact('comments'));
    }

    public function filterStatus($status)
    {
        return CommentResource::collection(Comment::where('status', $status)->get());
    }

    public function allComments(){
        return CommentResource::collection(Comment::all());
    }
}
