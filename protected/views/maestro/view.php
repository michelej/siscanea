<?php
$this->breadcrumbs=array(
	'Maestros'=>array('index'),
	$model->getNombreCompleto(),
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('maestro/index')),
    array('label' => 'Crear', 'url' => array('maestro/create')),
    array('label' => 'Ver', 'url' => array('maestro/view', 'id' => $model->id)),
    array('label' => 'Modificar', 'url' => array('maestro/update', 'id' => $model->id)),
    array('label' => 'Borrar', 'url' => '#', 'linkOptions' => array('submit' => array('maestro/delete', 'id' => $model->id), 'confirm' => 'Esta seguro que desea eleminar este registro?')),
    
);
?>

<h1>Datos del Maestro</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		array(
                    'label'=>'Cedula',
                    'value'=>$model->nacionalidad.' '.$model->cedula,
                ),
                'apellidos',
		'nombre',
                'telefono',
                'estado',
	),
)); ?>
