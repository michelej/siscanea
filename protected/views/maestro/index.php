<?php
$this->breadcrumbs=array(
	'Maestros',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('maestro/index')),
    array('label' => 'Crear', 'url' => array('maestro/create')),
);
?>

<?php
$data = $model->search();
$data->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' =>$data,
    'selectableRows' => 0,
    'summaryText'=>'Mostrando ({start}-{end}) de {count} Maestros',    
    'columns' => array(
        array(
            'header'=>'Cedula',
            'value'=>'$data->CedulaCompleta',
        ),
        array(
            'header'=>'Apellidos y Nombre',
            'value'=>'$data->NombreCompleto',
        ),
        'estado',
        array(
            'header'=>'Operaciones Basicas',
            'class' => 'CButtonColumn',            
            'viewButtonLabel'=>'Ver Datos',
            'updateButtonLabel'=>'Modificar Datos',
            'deleteButtonLabel'=>'Eliminar',
            'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/icons/ver.png',
            'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/icons/modificar.png',
            'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/icons/borrar.png',
        ),
    ),
)); ?>
