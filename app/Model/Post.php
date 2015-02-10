<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Post extends AppModel
{
    public $name = 'Post';
    
    public $validate = array(
        'title' => array('rule' => 'notEmpty'),
        'body'  => array('rule' => 'notEmpty'),
    );
    
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }
}