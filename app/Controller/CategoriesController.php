<?php
    class CategoriesController extends AppController {

        public function index()
        {
            // CategoryModelから全てのポストデータを取得
            $categoryList = $this->Category->find('all');

            // ビューに取得したポストデータをセット('posts'という名前でビューに渡す)
            $this->set('categories', $categoryList);
        }
    }
