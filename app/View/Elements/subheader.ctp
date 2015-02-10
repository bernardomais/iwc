<?php
Configure::write('Layout.default.body', array('class' => 'has-nav'));
?>
<section>
    <div class="navbar navbar-masthead navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
	                <?php if (isset($header_link_back)) : ?>
                        <a href="<?php print $this->Html->url($header_link_back); ?>" title="Voltar para página anterior" class="btn btn-link navbar-btn pull-left"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    <?php endif; ?>
                    <header>
                        <h2 class="navbar-brand"><?php print $header_title ?></h2>
                    </header>
                </div>
                <div class="col-sm-5">
                    <div class="pull-right">
                        <?php if (!empty($header_link)): ?>
                            <a class="btn btn-link btn-lg" <?php print !empty($header_link['target_modal']) ? sprintf('data-toggle="modal" data-target="%s"', $header_link['target_modal']) : null ; ?> href="<?php print $this->Html->url($header_link['url']); ?>"><span class="glyphicon glyphicon-plus"></span><span class="hidden-xs">&nbsp;<?php print $header_link['title'] ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
