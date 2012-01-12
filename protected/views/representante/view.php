<?php
$this->breadcrumbs=array(
	'Representantes'=>array('index'),
	$model->nombre,
);

$this->menu=array(        
        array('label'=>'Listado General', 'url'=>array('index')),	
	array('label'=>'Modificar Representante', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Representante', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminarlo?')),
	
);
?>

<h1>Datos del Representante</h1>

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
	),
)); ?>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' =>$model->listado_Alumnos(),
    'columns' => array(
         array(
            'header'=>'Cedula',
            'value'=>'$data->representante->nacionalidad." ".$data->representante->cedula',
        ),
        'apellidos',
        'nombre',
        array(
            'class'=>'CButtonColumn',
            'template' => '{view}',
            'viewButtonUrl'=>'Yii::app()->createUrl("alumno/view", array("id"=>$data["id"]))')
    ),
)); ?>
