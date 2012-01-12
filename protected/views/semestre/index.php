<?php
$this->breadcrumbs=array(
	'Año Escolar',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('semestre/index')),
    array('label' => 'Crear', 'url' => array('semestre/create')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'semestre-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{items}{pager}',
	'columns'=>array(                
		'temporada',
                'fechaInicio',
                'fechaFin',                
		array(
                        'header'=>'Editar Año Escolar',
			'class'=>'CButtonColumn',
                        'template'=>'{view}',
                        'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/icons/ver.png',
                        'viewButtonLabel'=>'Editar',
		),
	),
));
?>
