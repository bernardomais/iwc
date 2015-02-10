<h1>Posts do Blog</h1>
<?php echo $this->Html->link('Adicionar Post', array('controller' => 'posts', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Data de Criação</th>
    </tr>
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></td>
        <td><?php echo $post['Post']['created']; ?></td>
        <td>
            <?php echo $this->BootstrapForm->postLink('Apagar', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('confirm' => 'Vc tem certeza?')); ?>
            <?php echo $this->Html->link('Editar', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>