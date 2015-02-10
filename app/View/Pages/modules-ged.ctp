<?php
print $this->element('subheader', array(
            'header_title' => 'Gerenciamento Eletrônico de Documentos',
            'header_link_back' => array('controller' => 'pages', 'action' => 'display'),
));
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('folder.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>
                                    Importar arquivos
                                </h3>
                            </header>
                            <p class="hidden-sm">Importe os arquivos com os dados <br/>disponíveis para o projeto</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php echo $this->Html->url(array('controller' => 'archives', 'action' => 'import')); ?>">Importar</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-6 col-md-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('documents.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>
                                    Exportar arquivos
                                </h3>
                            </header>
                            <p class="hidden-sm">Recupere arquivos a partir dos dados <br/>cadastrados nos projetos</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php echo $this->Html->url(array('controller' => 'archives', 'action' => 'export')); ?>">Exportar</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-sm-6 col-md-4">
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <?php print $this->Html->image('valuation.svg', array('width' => '96', 'height' => '96')); ?>
                            <header>
                                <h3>
                                    Gerenciar arquivos
                                </h3>
                            </header>
                            <p class="hidden-sm">Gerencie os arquivos que <br/>formarão seus projetos</p>
                        </div>
                        <div class="panel-footer text-center">
                            <a class="btn btn-white" href="<?php echo $this->Html->url(array('controller' => 'archives', 'action' => 'index')); ?>">Gerenciar</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
