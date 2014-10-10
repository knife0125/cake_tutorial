<?php
    class CategoriesController extends AppController {

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
    }
