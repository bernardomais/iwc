<?php

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuário salvo com sucesso'), 'notification');
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash(__('O usuário não pode ser criado. Tente novamente!'), 'notification');
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
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
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
        $this->render('add');
    }
    
    /*public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }*/

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

    /*public function view($search) {
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
    }*/
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) 
            throw new NotFoundException(__('Usuário inválido'));
        
        $this->set('user', $this->User->read(null, $id));
    }
    
    /**
     * Marca como inativo na coluna `active` da tbl `users`
     * @param type $id
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function delete($id = null) {
        if (!$this->request->is('post'))
            throw new MethodNotAllowedException();
        
        $this->User->id = $id;
        if (!$this->User->exists()) 
            throw new NotFoundException(__('Usuário inválido'));
        
        $this->Post->read(null, $id);
        $this->Post->set('active', '0');
        if ($this->User->save()) {
            $this->Session->setFlash(__('Usuário apagado'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Erro ao excluir usuário, tente novamente'));
        $this->redirect(array('action' => 'index'));
    }

} 