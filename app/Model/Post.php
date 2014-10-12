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
                'Post.category_id' => $categoryId
            );
            // $orderに並べ替え条件を指定
            $order = array('Post.created ASC');
            // 条件、並べ替えパラメータなどを指定してデータを取得
            $posts = $this->find('all', array(
                                            'conditions' => $conditions,
                                            'order' => $order
                                        )
                                );

            // 取得したデータを返却
            return $posts;
        }
    }
