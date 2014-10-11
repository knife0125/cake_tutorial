<?php

    class CategoriesController extends AppController {
        public $uses = array('Category','Post');
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

            // カテゴリと紐づくPosts一覧を取得
            // $posts = $this->Post->getPostsWithCategoryId($categoryId);
            $data = $this->Category->getPostsWithCategory($categoryId);

            // 取得したカテゴリの情報をカテゴリの画面に引き渡す
            $this->set('data', $data);
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

        public function edit($categoryId = null)
        {
            // 編集画面描画時に編集対象のカテゴリのidがなかった場合にはエラーを表示
            if (!$categoryId) {
                throw new NotFoundException(__('Invalid post'));
            }

            // 編集対象のカテゴリの情報をデータベースから取得(データベースに編集対象データがなければエラーを表示)
            $category = $this->Category->findById($categoryId);
            if (!$category) {
                throw new NotFoundException(__('Invalid post'));
            }

            // リクエストメソッドがpost, putいずれかであれば、カテゴリの更新処理を実行
            if ($this->request->is(array('post', 'put'))) {
                $this->Category->categoryId = $categoryId;
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash(__('Your category has been updated.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your category.'));
            }

            if (!$this->request->data) {
                $this->request->data = $category;
            }
        }

        public function delete($categoryId)
        {
            // 削除リクエストが、getメソッドで投げられてきた場合にはエラーを表示
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }

            // 指定したカテゴリの削除に成功したら、成功メッセージを表示してカテゴリ一覧ページへ遷移
            if ($this->Category->delete($categoryId)) {
                $this->Session->setFlash(__('The category with categoryId: %s has been deleted.', h($categoryId)));
                return $this->redirect(array('action' => 'index'));
            }
        }

    }
