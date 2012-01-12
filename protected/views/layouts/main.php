<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>

        <div class="container" id="page">

            <div id="header-jpeg">
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Inicio', 'url' => array('site/index')),
                        array('label' => 'Reportes', 'url' => array('/reporte'),'active'=>$this->id=='reporte'?true:false,'template'=>'| {menu}'),
                        array('label' => 'Año Escolar', 'url' => array('/semestre'),'active'=>$this->id=='semestre'?true:false,'template'=>'| {menu}'),
                        array('label' => 'Alumnos', 'url' => array('/alumno'),'active'=>$this->id=='alumno'?true:false,'template'=>'| {menu}'),
                        array('label' => 'Maestros', 'url' => array('/maestro'),'active'=>$this->id=='maestro'?true:false,'template'=>'| {menu}'),
                        array('label' => 'Iniciar Sesion', 'url' => array('site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Cerrar Sesion', 'url' => array('site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->                                    
            <div id="submenu">
            <?php if (isset($this->submenu)): ?>
                
            <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' =>$this->submenu ));
                    ?>
            <?php endif ?>
            </div><!-- mainmenu -->
            
            <?php if (isset($this->breadcrumbs)): ?>
            <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    )); ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

                    <div id="footer">
                        		Copyright &copy; <?php echo date('Y'); ?> Unidad Educativa Canea<br/>
            		Todos los derechos reservados.<br/>
                        Realizado por Michel Escobar<br/>
                <?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/yii-powered.png"); ?>

            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>