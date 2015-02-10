<!DOCTYPE html>
<?php $layoutAttr = Configure::read('Layout.default'); ?>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>IWC Engineering</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="author" content="ScienceIt">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="canonical" href="http://scienceit.com.br" />
        <script>
            var baseUrl = '<?php echo $this->Html->url('/', true); ?>';
        </script>
        <style>
            .datepicker{z-index:1151 !important;}
            .ui-selectmenu-menu.ui-front.ui-selectmenu-open{z-index:1152 !important;}
            .popover{z-index:1153 !important;}
            .editable-pre-wrapped {
                white-space: inherit !important;
            }
        </style>
        <style type="text/css">
            #evaluation-scheme-graphic-representation {
                width: 100%;
                height: 600px;
            }
        </style>
        <?php
        echo $this->Html->css('/css/bootstrap.css');
        echo $this->Html->css('/css/todc-bootstrap.css');
        echo $this->Html->css('/css/todc-bootstrap-extras.css');
        echo $this->Html->css('/css/jquery-ui.css');
        echo $this->Html->css('/css/dynamiTags.css');
        echo $this->Html->css('/css/app.css');
        echo $this->Html->css('/css/vis.css');
        echo $this->Html->script('/js/vendor/modernizr.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body <?php echo!empty($layoutAttr['body']['class']) ? sprintf('class="%s"', $layoutAttr['body']['class']) : false; ?>>
        <?php echo $this->element('verify_connection'); ?>
        <?php echo $this->Session->flash(); ?>
        <?php // echo $this->element('side'); ?>
        <div class="page">
            <header role="banner">
                <?php echo $this->element('top_bar'); ?>
            </header>
            <main>
                <?php echo $this->fetch('content'); ?>
            </main>
            <?php //echo $this->element('footer'); ?>
        </div>
        <?php
        echo $this->Html->script(array(
            '/js/vendor/jquery.js',
            '/js/vendor/jquery-ui.js',
            'https://www.google.com/jsapi',
            '/js/bootstrap.js',
            '/js/vendor/raphael.js',
            '/js/vendor/livicons.js',
            '/js/vendor/icons-support.js',
            '/js/vendor/icons.js',
            '/js/vendor/notification.js',
            '/js/vendor/datepicker.js',
            '/js/vendor/typeahead.js',
            '/js/vendor/handlebars.js',
            //'/js/vendor/bootstrap-typeahead.js',
            '/js/vendor/tagsinput.js',
            '/js/vendor/select2.js',
            '/js/vendor/validation.js',
            '/js/vendor/editable.js',
            '/js/vendor/jquery.dynamiTags.js',
            '/js/vendor/datatable.js',
            '/js/vendor/datatable-responsive.js',
            '/js/vendor/html5Loader.js',
            '/js/vendor/mask.js',
            '/js/vendor/moment.js',
            '/js/vendor/fullcalendar.js',
            '/js/vendor/fullcalendar-br.js',
            '/js/vendor/vis.js',
            '/js/ckeditor/ckeditor.js',
            '/js/app.js',
        ));
        ?>
    </body>
</html>
