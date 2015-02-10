<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    //public $components = array('Session');
    public $components = array(
        'Session', 
        'Auth' => array(
            'flash' => array(
                'element' => 'notification',
                'key' => 'auth',
                'params' => array()
            ),
            'loginRedirect' => array('controller' => 'pages', 'action' => 'home'), 
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'), 
            'authError' => 'Você deve fazer login para ter acesso a essa área!', 
            'loginError'=> 'Combinação de usuário e senha errada!', 
            'authorize' => array('Controller'), 
        ),
    );
    
    public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true; // Admin pode acessar todas actions
        }
        return false; // Os outros usuários não podem
    }
    
    public function beforeFilter() {
        $this->Auth->allow('login', 'logout');
    }
    
    public function beforeRender() {

        $configMenu = array(
            'Sistema G.E.D.' => array(
                array('title' => 'Importar arquivos', 'link' => array('controller' => 'archives', 'action' => 'import')),
                array('title' => 'Exportar arquivos', 'link' => array('controller' => 'archives', 'action' => 'export')),
                array('divider' => true),
                array('title' => 'Gerenciar arquivos', 'link' => array('controller' => 'archives', 'action' => 'index')),
            ),
            'Administrativo' => array(
                array('title' => 'Colaboradores', 'link' => array('controller' => 'employees', 'action' => 'index')),
                array('title' => 'Empresas', 'link' => array('controller' => 'institutions', 'action' => 'index')),
                array('title' => 'Estrutura', 'link' => array('controller' => 'physical_spaces', 'action' => 'index')),
                array('title' => 'Perfis de acesso', 'link' => array('controller' => 'roles', 'action' => 'index')),
                array('title' => 'Permissões', 'link' => array('controller' => 'permissions', 'action' => 'index')),
                array('title' => 'Modelos de documentos', 'link' => array('controller' => 'document_templates', 'action' => 'index')),
                array('divider' => true),
                array('title' => 'Configurações gerais', 'link' => array('controller' => 'configurations', 'action' => 'administrative')),
            ),
            'Cadastro básico' => array(
                array('title' => 'Áreas de atuação', 'link' => array('controller' => 'branches', 'action' => 'index')),
                array('title' => 'Categoria dos projetos', 'link' => array('controller' => 'projects_categories', 'action' => 'index')),
                array('title' => 'Documentos solicitados', 'link' => array('controller' => 'document_types', 'action' => 'index')),
                array('title' => 'Níveis e Segmentos', 'link' => array('controller' => 'course_levels', 'action' => 'index')),
                array('title' => 'Tipos de produtos', 'link' => array('controller' => 'evaluation_types', 'action' => 'index')),
                array('title' => 'Tipos de interação', 'link' => array('controller' => 'interaction_types', 'action' => 'index')),
                array('title' => 'Tipos de ocorrência', 'link' => array('controller' => 'occurrences', 'action' => 'index')),
                array('title' => 'Veículos de comunicação', 'link' => array('controller' => 'communication_vehicles', 'action' => 'index')),
            )
        );

        $this->set(compact('configMenu'));
    }
}
