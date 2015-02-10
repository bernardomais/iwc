<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostsController extends AppController
{
    public $helpers = array('Html', 'Form');
    public $name    = 'Posts';
    
    public function isAuthorized($user) {
        if (parent::isAuthorized($user)) {
            if ($this->action === 'add') {
                // Todos os usuários registrados podem criar posts
                return true;
            }
            if (in_array($this->action, array('edit', 'delete'))) {
                $postId = (int) $this->request->params['pass'][0];
                return $this->Post->isOwnedBy($postId, $user['id']);
            }
        }
        return false;
    }
    
    public function index()
    {
        $this->set('posts', $this->Post->find('all'));
    }
    
    public function view($id = null)
    {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
    
    public function add()
    {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
           if ($this->Post->save($this->request->data)) {
               $this->Session->setFlash(__('Post salvo com sucesso'), 'notification');
               $this->redirect(array('controller' => 'posts', 'action' => 'index'));
           } 
        }
    }
    
    public function edit($id = null) 
    {
        $this->Post->id = $id;
        if (!$this->Post->exists())
            throw new NotFoundException('Nenhum post foi encontrado');
        
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Post atualizado com sucesso');
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
        }
        $this->render('add');
    }
    
    public function delete($id)
    {
        if (!$this->request->is('post'))
            throw new MethodNotAllowedException();
        
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('O post com id ' . $id . ' foi apagado');
            $this->redirect(array('controller' => 'posts', 'action' => 'display'));
        }
    }
}