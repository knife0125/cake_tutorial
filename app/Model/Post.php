<?php

    class Post extends AppModel {
        public $validate = array(
            'title' => array(
                'rule' => 'noEmpty'
            ),
            'body' => array(
                'rule' => 'noEmpty'
            )
        );
    }
