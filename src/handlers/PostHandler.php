<?php
namespace src\handlers;

use src\models\Post;

class PostHandler
{
    public static function createPost($id_user, $type, $body)
    {
        if (!empty($id_user)) {
            Post::insert([
                'id_user' => $id_user,
                'type' => $type,
                'body' => $body,
                'created_at' => date('Y-m-d H:i:s')
            ])->execute();
        }
    }
}