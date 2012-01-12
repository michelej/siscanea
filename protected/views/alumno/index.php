<?php
$this->breadcrumbs = array(
    'Alumnos',
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('alumno/index')),
    array('label' => 'Crear', 'url' => array('alumno/create')),    
);
?>
<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->search(),
        'selectableRows' => 0,
        'summaryText'=>'Mostrando ({start}-{end}) de {count} Alumnos',    
        'enableSorting'=>false,
        'columns' => array(
            'CedulaCompleta',
            'NombreCompleto',
            'Sexo',
            'Edad',
            array(
                'name' => 'Fecha de Nacimiento',
                'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->fecha_n),"long",null)',
            ),
            'lugar_n',
            'entidad_federal',
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
    ));
?>

