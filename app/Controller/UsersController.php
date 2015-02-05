<?php

class UsersController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow(array('login'));
        parent::beforeFilter();
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'notification');
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'notification');
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->_verifyNewPassword();
            if ($this->User->save($this->request->data)) {
                $this->_notify($this->modelClass);
                $this->redirect($this->referer());
            } else {
                $this->_notify($this->modelClass, NOTIFY_SAVE, FALSE);
            }
        } else {
            $user = $this->User->read(null, $id);
            unset($user['User']['password']);

            $this->request->data = $user;
        }
        $this->render('add');
    }

    public function login() {
        if (AuthComponent::user()) {
            $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
        }
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash('Nome de usuário e/ou senha incorreto(s)', 'notification');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function view($search) {
        $conditions = array();
        if (!is_numeric($search)) {
            $conditions['User.username'] = $search;
        } else {
            $conditions['User.id'] = $search;
        }

        $user = $this->User->find('all', array(
            'conditions' => $conditions,
        ));

        if (!empty($user)) {
            $this->set(compact('user'));
        } else {
            throw new NotFoundException('Usuário não encontrado');
        }
    }

}

