<?php

namespace app\controllers;

use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex()
    {
        $posts = [
            ['id' => 1, 'title' => 'Post 1'],
            ['id' => 2, 'title' => 'Post 2'],
            ['id' => 3, 'title' => 'Post 3'],
        ];

        return $this->render('index', [
            'posts' => $posts
        ]);
    }
}