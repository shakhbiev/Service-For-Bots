<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Bot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Category $category)
    {   
        $user_id = DB::table('bots')->where('id', $category->bot_id)->value('user_id');

        return $user->id === $user_id
            ? Response::allow()
            : Response::deny('Чувак, это не твоя категория!');
    } 
  
}
