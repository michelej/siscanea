<?php
$this->breadcrumbs=array(
	'Representantes'=>array('index'),
	'Nuevo',
);

$this->menu=array(        
        array('label'=>'Listado General', 'url'=>array('index')),
);
?>

<h1>Datos del Representante</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>