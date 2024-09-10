<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct(protected PostService $postService)
    {

    }

    public function index(Request $request)
    {
        $posts = $this->postService->list($request->all());

        return Inertia::render('Posts/Index', [
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        return Inertia::render('Posts/Create', [
            'post' => PostResource::make($post)
        ]);
    }

    public function store(PostRequest $postRequest)
    {
        $this->postService->updateOrCreate($postRequest);

        return to_route('posts.list');
    }

    public function delete($id)
    {
        $this->postService->delete($id);

        return to_route('posts.list');
    }
}
