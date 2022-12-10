<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Models\User;
class UserTransformer extends TransformerAbstract
{

    protected array $availableIncludes = ['posts'];

    public function transform (User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'password' =>$user->password,
        ];

    }




}



?>
