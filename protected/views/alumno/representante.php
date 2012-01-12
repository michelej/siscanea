<?php
$this->breadcrumbs=array(
	'Alumnos'=>array('index'),
	$alumno->getNombreCompleto()=>array('view','id'=>$alumno->id),
	'Representante',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('alumno/index')),
    array('label' => 'Crear', 'url' => array('alumno/create')),
    array('label' => 'Ver', 'url' => array('alumno/view', 'id' => $alumno->id)),
    array('label' => 'Modificar', 'url' => array('alumno/update', 'id' => $alumno->id)),
    array('label' => 'Borrar', 'url' => '#', 'linkOptions' => array('submit' => array('alumno/delete', 'id' => $alumno->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Representante', 'url' => array('alumno/representante','id' => $alumno->id)),
);
?>

<?php echo $this->renderPartial('_rep', array('model'=>$model)); ?>


<?php
/*if(isset($resultados)){
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $resultados,
        'selectableRows' => 0,
        'columns' => array(
            array(
            'name' => 'Cedula',
            'value' => '$data->CedulaCompleta',
            ),                        
            'apellidos',
            'nombre',
        ),
    ));
}*/
?>
