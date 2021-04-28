<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Post\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(Account $account, Post $post)
    {
        return $post->class()->first()->containsUser($account);
    }

    public function edit(Account $account, Post $post)
    {
        return $this->isAuthor($account, $post);
    }

    public function update(Account $account, Post $post)
    {
        return $this->isAuthor($account, $post);
    }

    public function delete(Account $account, Post $post)
    {
        $class = $post->class()->first();
        
        $isAuthor = $this->isAuthor($account, $post);
        $isSecretary = $account->isSecretary($class);
        $isLeader = $account->isLeader($class);
        
        return $isAuthor || $isSecretary || $isLeader;
    }

    private function isAuthor(Account $account, Post $post)
    {
        $isAuthor = $account->id === $post->user_id;

        return $isAuthor;
    }
}
