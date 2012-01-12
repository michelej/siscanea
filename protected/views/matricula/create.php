<?php
$this->breadcrumbs = array(
    'Año Escolar' => array('semestre/index'),
    $semestre->temporada => array('semestre/view', 'id' => $semestre->id),
    'Matricula',
);

$this->submenu = array(
    array('label' => 'Volver al Semestre', 'url' => array('semestre/view', 'id' => $semestre->id)),
);
?>
<h3>Año Escolar <?php echo $semestre->temporada; ?></h3>
<?php echo $this->renderPartial('_form', array('model' => $model, 'semestre' => $semestre, 'alumnos' => $alumnos)); ?>

<br></br>

    <h3>Alumnos actualmente en el <?php echo $model->grado->nombre;?></h3>    
Listado de los alumnos que se encuentran actualmente inscritos a este Grado y su respectiva seccion

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'matriculas-grid',
        'emptyText'=>'No hay ninguna alumno inscrito',
        'enableSorting'=>false,
        'dataProvider' => $model->search(),
        'selectableRows' => 0,
        'columns' => array(
            'seccion',
            'alumno.CedulaCompleta',
            'alumno.NombreCompleto',
            'alumno.Sexo',
            'alumno.Edad',
            'alumno.lugar_n',
            array(
                'class' => 'CButtonColumn',
                'header' => 'Eliminar',
                'template' => '{delete}',
                'deleteButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/borrar.png',
            ),
        ),
    ));
    ?>
