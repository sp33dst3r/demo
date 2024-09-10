<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostService
{
    public function updateOrCreate($postData)
    {
        if($postData->id) {
            $post = Post::find($postData->id);
            Gate::authorize('update', $post);

        } else {
            $post = new Post();
            $post->user_id = auth()->user()->id;
        }

        $post->title = $postData->title;
        $post->content = $postData->content;

        $post->save();
    }

    public function list($data)
    {
        return Post::latest()->paginate(2);
    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        Gate::authorize('delete', $post);

        $post->delete();
    }
}
