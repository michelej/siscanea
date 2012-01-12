<?php
$this->breadcrumbs=array(
	'Año Escolar'=>array('index'),
	$model->temporada=>array('view','id'=>$model->id),
	'Renombrar',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('semestre/index')),
    array('label' => 'Nuevo', 'url' => array('semestre/create')),
    array('label' => 'Tabla General', 'url' => array('semestre/view', 'id' => $model->id)),
    array('label' => 'Modificar Datos', 'url' => array('semestre/update', 'id' => $model->id)),
    array('label' => 'Eliminar', 'url' => '#', 'linkOptions' => array('submit' => array('semestre/delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    

);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>