<?php
$this->breadcrumbs=array(
	'Maestros'=>array('index'),
	'Crear',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('maestro/index')),
    array('label' => 'Nuevo', 'url' => array('maestro/create')),
);
?>

<h1>Datos del Maestro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>