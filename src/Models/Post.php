<?php

namespace Artur\Twitter\Models;

use Artur\Twitter\Core\Database;
use Artur\Twitter\Helpers\Auth;
use DateTime;

class Post
{

    private const TABLE = 'posts';

    public $user_id;
    public $tweet;
    public $created_at;

    public User $user;

    public function save()
    {
        $data = [
            'user_id' => "'" . Auth::getUser()->id . "'",
            'tweet' => "'" . $this->tweet . "'",
            'created_at' => "NOW()",
        ];
        Database::insert(self::TABLE, $data);
    }

    public static function allTweet(): array
    {
        $sql = "
            SELECT
                posts.user_id,
                posts.tweet,
                posts.created_at,
                u.username
            FROM
                posts
            JOIN 
                users u ON u.id = posts.user_id
            ORDER BY 
                posts.created_at desc;
            ";

        $result = Database::query($sql);
        $tweets = [];
        if (!$result) {
            return [];
        }
        foreach ($result as $data) {
            $post = new self();
            $post->user_id = $data['user_id'];
            $post->tweet = $data['tweet'];
            $post->created_at = $data['created_at'];
            $user = new User();
            $user->username = $data['username'];

            $post->user = $user;
            $tweets[] = $post;
        }
        return $tweets;
    }

    public function dateFormat()
    {
        $date = new DateTime($this->created_at);
        $today = new DateTime('today');
        $yesterday = new DateTime('yesterday');

        if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
            return $date->format('H:i');
        } elseif ($date->format('Y-m-d') === $yesterday->format('Y-m-d')) {
            return 'вчера';
        } else {
            return $date->format('d.m.Y H:i');
        }
    }

    
}
