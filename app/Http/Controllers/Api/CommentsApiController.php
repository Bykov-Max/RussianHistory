<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Element;
use Illuminate\Http\Request;

class CommentsApiController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(Request $request)
    {
        return Comment::create($request->only(['comment', 'user_id', 'element_id']));
    }

    public function show($comment)
    {
        if ($comment->status) {

            return $comment;
        }
        else{
            return "Комментарий был заблокирован";
        }
    }

    public function update(Request $request, $comment)
    {
        return $comment->update($request->only(['comment']));
    }


    public function destroy($comment)
    {
        $comment->delete();
        return ['status' => 'delete'];
    }

    public function showComments(Element $element){
        return CommentResource::collection($element->comments);
    }

    public function filterStatus($status)
    {
        return CommentResource::collection(Comment::where('status', $status)->get());
    }
}
