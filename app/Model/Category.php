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
            // 指定条件の作成
            $conditions = array(
                'Category.id' => $categoryId
            );
            // 条件を指定してデータを取得
            $posts = $this->find('all', array('conditions' => $conditions));
            return $posts;
        }
    }

