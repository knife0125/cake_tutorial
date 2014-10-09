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

        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Post->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }
            $this->set('post', $post);
        }

    }
