<?php
    class PostsController extends AppController {
        public $helpers = array('Html', 'Form', 'Session');
        public $components = array('Session');

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

        public function add() {
            if ($this->request->is('post')) {
                $this->Post->create();
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('Your post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to add your post.'));
            }
        }
    }
