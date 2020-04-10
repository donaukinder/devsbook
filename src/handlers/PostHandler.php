<?php

namespace src\handlers;

use src\models\Post;
use src\models\User;
use src\models\UserRelation;

class PostHandler
{
    public static function createPost($id_user, $type, $body)
    {
        $body = trim($body);
        if (!empty($id_user) && !empty($body)) {
            Post::insert([
                'id_user' => $id_user,
                'type' => $type,
                'body' => $body,
                'created_at' => date('Y-m-d H:i:s')
            ])->execute();
        }
    }

    public static function getHomeFeed($id_user)
    {
        $user_list = UserRelation::select()->where('user_from', $id_user)->get();
        $users = [];
        foreach ($user_list as $user_item) {
            $users[] = $user_item['user_to'];
        }
        $users[] = $id_user;

        $postList = Post::select()
            ->where('id_user', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->get();

        $posts = [];
        foreach ($postList as $postItem) {
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->body = $postItem['body'];
            $newPost->created_at = $postItem['created_at'];

            $newUser = User::select()
                ->where('id', $postItem['id_user'])
                ->one();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];

            $posts[] = $newPost;
        }
        return $posts;
    }
}
