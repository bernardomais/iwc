<h1>Adicionar Posts</h1>
<?php
    echo $this->BootstrapForm->create('Post');
    echo $this->BootstrapForm->input('title');
    echo $this->BootstrapForm->input('body', array('rows' => '3'));
    echo $this->BootstrapForm->end('Salvar');