<?php $user = @AuthComponent::user(); ?>
<div class="tullli-bar sendToBack navbar-fixed-top hidden-print">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-3">
                <div class="tullli-logo pull-left">
                    <h1>
                        <?php echo $this->Html->link('IWC Engineering', array('controller' => 'pages', 'action' => 'display'), array('title' => 'Voltar para página principal')); ?>
                    </h1>
                </div>
            </div>
            <div class="hidden-xs col-sm-5">
                <div class="hidden-xs hidden-sm"><?php echo $this->element('search', array('id_rand' => rand())); ?></div>
            </div>
            <div class="col-xs-9 pull-right col-sm-4 col-md-4">
                <div class="tullli-bar-links pull-right">
                    <a href="<?php echo $this->Html->url(array('controller' => 'projects', 'action' => 'add')); ?>" class="btn btn-danger">
                        <span class="glyphicon glyphicon-plus"></span>
                        <span class="hidden-xs hidden-sm hidden-md">Projetos</span>
                    </a>
                    <div class="btn-group">
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-th"></span>', array('controller' => 'pages', 'action' => 'display'), array('escape' => false, 'class' => array('btn', 'btn-white'))) ?>
                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                            <span class="caret down"></span>
                            <span class="sr-only">Lista de módulos</span>
                        </button>
                        <ul class="dropdown-menu pull-right dropdown-scrollable" role="menu">
                            <?php foreach ($configMenu as $key => $configItems): ?>
                                <li class="dropdown-submenu dropdown-menu-left">
                                    <a tabindex="-1" href="#"><?php echo $key; ?></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php foreach ($configItems as $key => $configItem): ?>
                                            <?php if (!empty($configItem['divider'])): ?>
                                                <li class="divider"></li>                                           
                                            <?php else: ?>
                                                <li role="presentation">
                                                    <?php echo $this->Html->link($configItem['title'], $configItem['link']); ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <?php print $this->Html->link('Minha conta', array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php print $this->Html->link('Sair', array('controller' => 'users', 'action' => 'logout')); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tullli-bar navbar-fixed-top visible-xs visible-sm hidden-print">
    <div class="container-fluid">
        <?php print $this->element('search', array('id_rand' => rand())); ?>
    </div>
</div>