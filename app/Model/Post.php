<?php

    class Post extends AppModel {
        public $validate = array(
            'title' => array(
                'rule' => 'notEmpty'
            ),
            'body' => array(
                'rule' => 'notEmpty'
            )
        );


        /**
         * CategoryIdに紐づくPosts一覧を取得
         *
         * @param int $categoryId カテゴリId
         * @return array $posts   カテゴリIdで絞りこまれたPosts一覧
         */
        public function getPostsWithCategoryId($categoryId)
        {
            // パラメータを初期化
            $posts = array();

            // データベースからデータを取得($conditionsに条件を指定)
            $conditions = array(
                'Post.category_id' => $categoryId,
                'order' => array('Post.created ASC')
            );
            $posts = $this->find('all', $conditions);

            // 取得したデータを返却
            return $posts;
        }
    }
