<?php
$this->breadcrumbs=array(
	'Alumnos'=>array('index'),
	$model->getNombreCompleto()=>array('view','id'=>$model->id),
	'Editar',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('alumno/index')),
    array('label' => 'Crear', 'url' => array('alumno/create')),
    array('label' => 'Ver', 'url' => array('alumno/view', 'id' => $model->id)),
    array('label' => 'Modificar', 'url' => array('alumno/update', 'id' => $model->id)),
    array('label' => 'Borrar', 'url' => '#', 'linkOptions' => array('submit' => array('alumno/delete', 'id' => $model->id), 'confirm' => 'Esta seguro que desea eliminar a este Alumno?')),
    array('label' => 'Representante', 'url' => array('alumno/representante','id' => $model->id)),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>