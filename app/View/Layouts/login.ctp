<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>IWC Engineering</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="author" content="scienceit">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <?php
        echo $this->Html->css('/css/bootstrap.css');
        echo $this->Html->css('/css/todc-bootstrap.css');
        echo $this->Html->css('/css/app.css');
        echo $this->Html->script('/js/vendor/modernizr.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script>
            var baseUrl = '<?php echo $this->Html->url('/', true); ?>';
        </script>
    </head>
    <body>
        <?php echo $this->Session->flash(); ?>
        <div class="page">
            <div class="body">
                <main>
                    <?php echo $this->fetch('content'); ?>
                </main>
            </div>
        </div>
        <?php
        echo $this->Html->script(array(
            '/js/vendor/jquery.js',
            '/js/bootstrap.js',
            '/js/vendor/validation.js',
            '/js/vendor/notification.js',
            '/js/app_begin.js',
        ));
        ?>
    </body>
</html>