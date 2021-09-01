<?php

namespace App\Policies;

use App\Models\Bot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BotPolicy
{
    use HandlesAuthorization;

    public function check(User $user, Bot $bot)
    {
        return $user->id === $bot->user_id
            ? Response::allow()
            : Response::deny('Чувак, это не твой бот!');
    }

    public function delete(User $user, Bot $bot)
    {
        return $user->id === $bot->user_id
            ? Response::allow()
            : Response::deny('Чувак, ты не сможешь удалить чужой бот!');
    }

  

}
