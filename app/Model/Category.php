<?php
    class Category extends AppModel {
        public $name = 'Category';
        public $validate = array(
            'category_name' => array(
                'rule' => 'notEmpty'
            )
        );
        public $hasMany = array (
            'Post' => array(
                'className'     => 'Post',
                'foreignKey'    => 'category_id',
                'order'         => 'Post.created ASC',
            )
        );
        public function getPostsWithCategory($categoryId)
        {
            // postsデータの初期化
            $posts = array();
            // データの取得
            $posts = $this->findById($categoryId);
            return $posts;
        }
    }

