<?php
    class CategoriesController extends AppController {
        public $helpers = array('Html', 'Form', 'Session');
        public $components = array('Session');

        public function index()
        {
            // CategoryModelから全てのポストデータを取得
            $categoryList = $this->Category->find('all');

            // ビューに取得したポストデータをセット('posts'という名前でビューに渡す)
            $this->set('categories', $categoryList);
        }

        public function view($categoryId = null)
        {
            // view画面描画時にカテゴリidが取得できない場合はエラー表示
            if (!$categoryId) {
                throw new NotFoundException(__('Invalid category'));
            }

            // 詳細表示するカテゴリの情報をModelから取得
            $category = $this->Category->findById($categoryId);
            if (!$category) {
                throw new NotFoundException(__('Invalid category'));
            }

            // 取得したカテゴリの情報をカテゴリの画面に引き渡す
            $this->set('category', $category);
        }

        public function add()
        {
            // addアクションにpostメソッドでリクエストが飛んできた時にはデータを保存するように試みる
            if ($this->request->is('post')) {
                $this->Category->Create();
                // データベースへ新しいカテゴリが保存できた場合は、成功のメッセージを出してindexページヘリダイレクト
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash(__('Your category has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                // データベースへの保存に失敗した場合には、失敗した旨のメッセージを表示
                $this->Session->setFlash(__('Unnable to add your post.'));
            }
        }
    }
