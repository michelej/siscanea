<?php
$this->breadcrumbs=array(
	'Representantes',
);

$this->menu=array(	
        array('label'=>'Nuevo Representante', 'url'=>array('create')),
);
?>

<h1>Representantes</h1>

<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$data = $model->search();
$data->pagination->pageSize = 40;

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' =>$data,    
    'columns' => array(
        'nacionalidad',
        'cedula',
        'apellidos',
        'nombre',
        'telefono',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
