<div class="users form">
<?php echo $this->BootstrapForm->create('User');?>
    <fieldset>
        <legend><?php echo __('Adicionar usuários'); ?></legend>
        <?php 
            echo $this->BootstrapForm->input('username');
            echo $this->BootstrapForm->input('password');
            echo $this->BootstrapForm->input('email');
            echo $this->BootstrapForm->input('role', array('options' => array('admin' => 'Administrador', 'user' => 'Usuário')));
        ?>
    </fieldset>
<?php echo $this->BootstrapForm->end(__('Enviar'));?>
</div>