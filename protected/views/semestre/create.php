<?php
$this->breadcrumbs=array(
	'Año Escolar'=>array('index'),
	'Nuevo',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('semestre/index')),
    array('label' => 'Nuevo', 'url' => array('semestre/create')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>