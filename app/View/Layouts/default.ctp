<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('timesheet', COMPANY_NAME.' Timesheet Application');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive.css');
    echo $this->Html->css('cupertino/jquery-ui-1.8.24.custom.css');
    echo $this->Html->css('style');

		$this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', array('block' => 'scriptBottom'));
    $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js', array('block' => 'scriptBottom'));
    $this->Html->script('bootstrap', array('block' => 'scriptBottom'));
    $this->Html->script('date', array('block' => 'scriptBottom'));
    $this->Html->script('jquery-ui-timepicker-addon', array('block' => 'scriptBottom'));
		$this->Html->script('default', array('block' => 'scriptBottom'));
    if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'dashboard') {
      $this->Html->script('user-settings', array('block' => 'scriptBottom'));
    }

		echo $this->fetch('meta');
		echo $this->fetch('css');
		// echo $this->fetch('script');
	?>
    <script type="text/javascript">
      var base_url = "<?php echo BASE_URL; ?>";
    </script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
     <!--[if IE]>
    
    <![endif]-->
</head>
<body>




    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo $cakeDescription ?></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
				<?php if($logged_in): ?>
					Welcome <?php echo $current_user['username']; ?>. <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
				<?php else: ?>
					<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
				<?php endif; ?>
            </p>
            <ul class="nav">
              <?php /**
              *<li class="active"><a href="#">Home</a></li>
              *<li><a href="#about">About</a></li>
              *<li><a href="#contact">Contact</a></li> **/ ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
          	<?php echo $this->element('sidebar'); ?>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
		  <?php echo $this->Session->flash(); ?>
		  <?php echo $this->Session->flash('auth'); ?>
          <?php echo $this->fetch('content'); ?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; <?php echo COMPANY_NAME; ?> <?php echo date("Y"); ?></p>
      </footer>

    </div><!--/.fluid-container-->

	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->fetch('scriptBottom'); ?>
</body>
</html>
