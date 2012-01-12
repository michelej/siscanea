<?php
$this->breadcrumbs=array(
	'Alumnos'=>array('index'),
	'Crear',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('alumno/index')),
    array('label' => 'Crear', 'url' => array('alumno/create')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>