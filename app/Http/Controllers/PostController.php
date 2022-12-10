<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class PostController extends Controller
{
    protected $postTransformer;

    private $fractal;

    public function __construct(PostTransformer $postTransformer, Manager $fractal)
    {
        $this->postTransformer = $postTransformer;
        $this->fractal = $fractal;
    }

    public function index()
    {
        $posts = Post::all();
        return fractal()->collection($posts)
            ->transformWith(new PostTransformer)
            ->parseIncludes('user')
            ->toArray();
    }

}
