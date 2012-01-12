<?php

$this->breadcrumbs = array(
        'Año Escolar' => array('semestre/index'),
        $semestre->temporada=>array('semestre/view','id'=>$semestre->id),
	'Calificaciones',
);

$this->menu = array(
    array('label' => 'Volver al Año Escolar', 'url' => array('semestre/view','id'=>$semestre->id)),
);
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(    
    'dataProvider' => $model,    
));
?>
