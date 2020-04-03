<?php

namespace src\handlers;

use src\models\Post;
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

        print_r($users);
    }
}
