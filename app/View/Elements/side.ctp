<aside>
    <nav class="sidemenu sidemenu-left">
        <div id="sidemenu-scrollbar-wrapper" class="scroll scroll-wrapper">
            <div class="scroll-scroller">
                <ul class="visible-xs">
                    <li role="presentation" class="sidemenu-header">Escolas</li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-inline glyphicon-check"></span>Euclides da conha
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-inline glyphicon-unchecked"></span>Colégio Curso Intellectus
                        </a>
                    </li>
                </ul>
                <ul class="hidden-md hidden-lg">
                    <li role="presentation" class="sidemenu-header">Módulos</li>
                    <li class="divider"></li>
                    <?php foreach($configMenu as $key => $configItems): ?>
                    	<li role="presentation" class="sidemenu-header"><?php print $key; ?></li>
						<li class="divider"></li>
                    	 <?php foreach($configItems as $key => $configItem): ?>
                    	 	 <li>
	                            <?php echo $this->Html->link($configItem['title'], $configItem['link']); ?>
	                        </li>
                    	 <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</aside>
<div class="site-overlay"></div>