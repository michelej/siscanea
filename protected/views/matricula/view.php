<?php
$this->breadcrumbs=array(
	'Año Escolar' => array('semestre/index'),
        $model->semestre->temporada=>array('semestre/view','id'=>$model->semestre->id),
	'Matricula',
);

$this->submenu = array(
    array('label' => 'Volver Año Escolar', 'url' => array('semestre/view', 'id' => $model->semestre->id)),
);
?>

<h1>Alumnos Inscritos en el <?php echo $model->grado->nombre; ?> Seccion <?php echo $model->seccion; ?></h1>

<?php
    $data = $model->search();
    $data->pagination->pageSize = 40;
    
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'semestre-grid',
    'dataProvider' => $data,
    'columns' => array(
        array(
            'name'=>"Cedula",
            'value'=>'$data->alumno->CedulaCompleta',
        ),
        'alumno.apellidos',
        'alumno.nombre',
        array(
            'name' => 'Sexo',
            'value' => '$data->alumno->Sexo',
        ),
        array(
            'name' => 'Fecha de Nacimiento',
            'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->alumno->fecha_n), "long", null)',
        ),
        array(
            'name' => 'Edad',
            'value' => '$data->alumno->Edad',
        ),
        'alumno.lugar_n',        
        array(
            'class'=>'CButtonColumn',
            'header'=>'Eliminar',
            'template'=>'{delete}',
        ),
    ),

));
?>