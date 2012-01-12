<?php
$this->breadcrumbs=array(
	'Representantes'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
        array('label'=>'Listado General', 'url'=>array('index')),
	array('label'=>'Datos del Representante ', 'url'=>array('view', 'id'=>$model->id)),
	
);
?>

<h1><?php echo $model->nombre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>