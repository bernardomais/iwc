<section>
    <header class="tullli-logo tullli-logo-large text-center">
        <h3>
            <?php echo $this->Html->link('IWC Engineering', array('controller' => 'pages', 'action' => 'display', 'home'), array('title' => 'Voltar para página principal', 'class' => 'hidden-xs hidden-sm')); ?>
        </h3>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="panel panel-default panel-login">
                    <div class="panel-body">
                        <article>
                            <?php
                                $labelType = array('class' => 'control-label'); 
                                echo $this->BootstrapForm->create('User', array('novalidate' => true, 'inputDefaults' => array('div' => array('class' => 'form-group'), 'label' => $labelType, 'error' => array('notEmpty' => __(' '), 'attributes' => array('escape' => false, 'wrap' => 'span', 'class' => 'glyphicon glyphicon-remove form-control-feedback'))), 'id' => 'course-form', 'role' => 'form')); 
                            ?>
                            <div class="form-group">
                                <?php echo $this->BootstrapForm->input('username', array('class' => array('form-control'), 'id' => 'username', 'placeHolder' => 'Nome de usuário', 'required' => true)); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->BootstrapForm->input('password', array('class' => array('form-control'), 'id' => 'password', 'placeHolder' => 'Senha', 'required' => true)); ?>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                            <a href="#" class="block block-margin text-center">Precisa de ajuda?</a>
                            <?php echo $this->BootstrapForm->end(); ?>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

