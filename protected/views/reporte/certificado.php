<?php
$this->breadcrumbs = array(
    'Reporte' => array('/reporte'),
    'Certificado',
);

$this->submenu = array(
    array('label' => 'Certificacion de Calificaciones', 'url' => array('reporte/certificado')),
    array('label' => 'Resumen Final de Evaluacion', 'url' => array('reporte/resumen')),
);
?>



<div class="search-form">
    <?php
    $this->renderPartial('_search', array('model' => $alumno,));
    ?>
</div><!-- search-form -->


<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $matricula->search(),
        'selectableRows' => 0,
        'columns' => array(
            'id',
            'alumno.CedulaCompleta',
            'alumno.NombreCompleto',
            'semestre.temporada',
            'grado.nombre',
        ),
    ));
?>
<h3>Generar reportes</h3>

<?php echo CHtml::link('BASICA III ETAPA (7,8,9)',array('/reporte/RRDEA0303',"id"=>$alumno->id,'tp'=>1),
        array('style'=>' border: 4px outset; padding: 2px;text-decoration: none;')); ?>
    <br />
    <br />
<?php echo CHtml::link('EDUCACION MEDIA GENERAL (4,5)',array('/reporte/RRDEA0303','id'=>$alumno->id,'tp'=>2),
        array('style'=>' border: 4px outset; padding: 2px;text-decoration: none;')); ?>

 