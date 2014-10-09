<?php
    class PostsController extends AppController {
        public $helpers = array('Html', 'Form');

        public function index()
        {
            // PostsModelから全てのポストデータを取得
            $postList = $this->Post->find('all');

            // ビューに取得したポストデータをセット('posts'という名前でビューに渡す)
            $this->set('posts', $postList);
        }

    }
