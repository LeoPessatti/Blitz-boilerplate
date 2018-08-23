<?php

namespace blitz\app\controllers;


\blitz\vendor\core\Model::import('Post');
use \blitz\app\models\Post as Post;

class Index extends \blitz\vendor\core\Controller {

    public function actionIndex() {
        $this->log('Mais um acesso bem sucedido ʘ‿ʘ','views.txt');
//        $post = new Post();
//        $post->log("Novo post feito :D", "posts.csv");
        $this->outputPage('index::default');
    }

    public function actionPosts() {
        $post = new Post();

        $this->outputPage('index::posts', [
            'list' => $post->list()
        ]);
    }


    public function actionPost($id) {
        $post = new Post();
        
        $post->id = $id;

        $this->outputPage('index::post', [
            'infos' => $post->infos()
        ]);
    }



}
