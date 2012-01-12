<?php
$this->breadcrumbs=array(
	'Maestros'=>array('index'),
	$model->getNombreCompleto()=>array('view','id'=>$model->id),
	'Editar',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('maestro/index')),
    array('label' => 'Crear', 'url' => array('maestro/create')),
    array('label' => 'Ver', 'url' => array('maestro/view', 'id' => $model->id)),
    array('label' => 'Modificar', 'url' => array('maestro/update', 'id' => $model->id)),
    array('label' => 'Borrar', 'url' => '#', 'linkOptions' => array('submit' => array('maestro/delete', 'id' => $model->id), 'confirm' => 'Esta seguro que desea eliminar este registro?')),

);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>