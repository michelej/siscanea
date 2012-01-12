<?php
$this->breadcrumbs = array(
        'Año Escolar' => array('semestre/index'),
        $semestre->temporada=>array('semestre/view','id'=>$semestre->id),
	'Calificaciones',
);

$this->submenu = array(
    array('label' => 'Volver al Semestre', 'url' => array('semestre/view', 'id' => $semestre->id)),
);
?>
<h3> <?php echo $matriculas[0]->grado->nombre; ?></h3>

<?php echo $this->renderPartial('_form', array('matriculas'=>$matriculas)); ?>

<?php    
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'matriculas-grid',
        'dataProvider' => $materias->search(),
        'selectableRows' => 0,
        'template'=>'{items}{pager}',
        'htmlOptions' => array('style'=>'width:400px;'),
        'columns' => array(
            'asignatura.descripcion',
            'asignatura.abreviatura',
        ),
    ));
?>