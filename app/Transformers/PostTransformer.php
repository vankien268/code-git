<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Models\Post;
class PostTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['user'];

    public function transform (Post $post)
    {
        return [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' =>$post->user_ids
        ];

    }

    public function includeUser(Post $post)
    {
        $user = $post->user;

        return $this->item($user, new UserTransformer());
    }




}



?>
