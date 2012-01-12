<?php
$this->breadcrumbs=array(
	'Reporte'=>array('/reporte'),
	'Resumen',
);
$this->submenu = array(
    array('label' => 'Certificacion de Calificaciones', 'url' => array('reporte/certificado')),
    array('label' => 'Resumen Final de Evaluacion', 'url' => array('reporte/resumen')),
);
?>
<?php   echo $this->renderPartial('_resumen',array('model'=>$model)); ?>

