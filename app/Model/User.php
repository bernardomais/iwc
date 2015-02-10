<?php
App::uses('AuthComponent', 'Controller/Component');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends AppModel
{
    public $name     = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo usuário é obrigatório'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo senha é obrigatório'
            )
        ),
        'role'     => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Regra inválida',
                'allowEmpty' => false
            )
        ),
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}