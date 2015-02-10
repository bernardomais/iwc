<?php
print $this->element('subheader', array(
            'header_title' => 'Módulos',
));
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('reports.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>Sistema G.E.D.</h3>
                            </header>
                            <p class="hidden-sm">Gerar, controlar, armazenar, compartilhar e recuperar informações existentes em documentos</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php print $this->Html->url(array('controller' => 'pages', 'action' => 'modules-ged')); ?>" title="Ir para os módulos de Gerenciamento Eletrônico de Documentos">Entrar</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('administration.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>Administrativo</h3>
                            </header>
                            <p class="hidden-sm">Organize colaboradores, fornecedores e a estrutura física de sua empresa</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php print $this->Html->url(array('controller' => 'pages', 'action' => 'modules-administrative')); ?>" title="Ir para os módulos administrativos">Entrar</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('settings.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>Cadastro básico</h3>
                            </header>
                            <p class="hidden-sm">Configure as informações básicas para que seu sistema funcione plenamente</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php print $this->Html->url(array('controller' => 'pages', 'action' => 'modules-basic')); ?>" title="Ir para os módulos de cadastro básico">Entrar</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
