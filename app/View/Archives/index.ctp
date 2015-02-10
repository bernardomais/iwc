<?php
print $this->element('subheader', array(
            'header_title' => 'Gerenciar arquivos',
            'header_link_back' => array('controller' => 'pages', 'action' => 'modules-ged'),
            'header_link' => array(
                'title' => 'Adicionar',
                'url' => array('controller' => 'archives', 'action' => 'add')
            ),
));
?>
<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title pull-left">Listagem de arquivos</h3>
                <?php if (!empty($arquives)): ?>
                    <a class="btn btn-notice pull-right" title="Copiar as configurações das turmas para utilizá-las em outro período" data-toggle="modal" data-target="#modal" data-backdrop="static" href="<?php print $this->Html->url(array('controller' => 'classrooms', 'action' => 'clone_classrooms', $this->request->data['ClassroomFilter']['AcademicPeriod']['id'])); ?>">
                        <span class="glyphicon glyphicon-share"></span>
                        <span class="hidden-xs">Replicar turmas</span>
                    </a>
                <?php endif; ?>
                <div class="clearfix"></div>   
            </div>
            <div class="panel-body">
                <?php if (empty($arquives)): ?>
                    <p>Não existem dados para serem exibidos ainda.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-no-margin">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Turma</th>
                                    <th class="hidden-xs">Ambiente</th>
                                    <th class="hidden-xs">Capacidade</th>
                                    <th>Matriculados</th>
                                    <th class="hidden-xs">Trancados</th>
                                    <th><span class="sr-only">Ações</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classrooms as $classroom): $id = $classroom['Classroom']['id']; ?>
                                    <?php $linkLabel = empty($classroom['Classroom']['active']) ? 'Ativar' : 'Desativar'; ?>
                                    <tr>
                                        <td><?php print $classroom['Classroom']['active'] ? '<span class="badge label-success"> </span>' : '<span class="badge label-danger"> </span>' ; ?></td>
                                        <td>
                                            <?php echo $this->Html->link($classroom['Classroom']['name'], array('controller' => 'classrooms', 'action' => 'students', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?>
                                        </td>
                                        <td class="hidden-xs"><?php print $classroom['PhysicalSpace']['name'] ?></td>
                                        <td class="hidden-xs"><?php print $classroom['PhysicalSpace']['places_number'] ?></td>
                                        <td><?php print $classroom['Classroom']['places_used'] ?></td>
                                        <td class="hidden-xs"><?php print $classroom['Classroom']['places_locked'] ?></td>
                                        <td>
                                            <div class="dropdown pull-right">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu-<?php print $id ?>" data-toggle="dropdown">
                                                    Ações
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-<?php print $id ?>">
                                                    <li role="presentation"><?php echo $this->Html->link('Ver alunos', array('controller' => 'classrooms', 'action' => 'students', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?></li>
                                                    <li role="presentation"><?php echo $this->Html->link('Lançar notas', array('controller' => 'classrooms', 'action' => 'evaluation_select', $id), array('role' => 'menuitem', 'tabindex' => '-1', 'data-toggle' => 'modal', 'data-target' => '#modal-lg')); ?></li>
                                                    <li role="presentation"><?php echo $this->Html->link('Editar', array('controller' => 'classrooms', 'action' => 'edit', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?></li>
                                                    <li role="presentation"><a data-toggle="modal" data-target="#modal" href="<?php print $this->Html->url(array('controller' => 'classrooms', 'action' => 'before_delete', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?>">Excluir</a></li>
                                                    <li class="divider"></li>
                                                    <li role="presentation"><?php echo $this->Html->link($linkLabel, array('controller' => 'classrooms', 'action' => 'change_status', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?></li>
                                                    <li role="presentation"><?php echo $this->Html->link('Recalcular vagas', array('controller' => 'classrooms', 'action' => 'recalculate_places', $id), array('role' => 'menuitem', 'tabindex' => '-1')); ?></li>
                                                </ul>
                                            </div>  
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div class="modal clear-after fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal clear-after fade" id="modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">			
        </div>
    </div>
</div>