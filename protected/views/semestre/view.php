<?php
$this->breadcrumbs = array(
    'Año Escolar' => array('index'),
    $model->temporada,
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('semestre/index')),
    array('label' => 'Crear', 'url' => array('semestre/create')),
    array('label' => 'Tabla General', 'url' => array('semestre/view', 'id' => $model->id)),
    array('label' => 'Modificar Datos', 'url' => array('semestre/update', 'id' => $model->id)),
    array('label' => 'Eliminar', 'url' => '#', 'linkOptions' => array('submit' => array('semestre/delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>
<h3>Año Escolar <?php echo $model->temporada; ?></h3>

La siguiente tabla representa los grados y sus respectivas secciones , con las cantidades
de alumnos inscrita en ellas, si colocas el mouse sobre los iconos podras obtener mas informacion sobre
las funciones que desempeñan en cada columna.


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'preescolar-grid',
    'summaryText' => '',
    'dataProvider' => $model->estadisticas_AlumnosPreescolar(),
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Alumnos',
            'template' => '{view}{update}',
            'viewButtonLabel' => 'Mostrar los alumnos actualmente inscritos en este Grado/Seccion',
            'updateButtonLabel' => 'Agregar alumnos a este Grado (Matricular)',
            'viewButtonUrl' => 'Yii::app()->createUrl("matricula/view",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'viewButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/ver.png',
            'updateButtonUrl' => 'Yii::app()->createUrl("matricula/create",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'updateButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
        ),        
        array(
            'class' => 'CButtonColumn',
            'header' => 'Maestros',
            'template' => '{asignar}',
            'buttons' => array(
                'asignar' => array(
                    'label' => 'Asignar Maestros a sus respectivas asignaturas',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
                    'url' => 'Yii::app()->createUrl("maestro/asignar",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
                )
            ),
        ),
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'primaria-grid',
    'summaryText' => '',
    'dataProvider' => $model->estadisticas_AlumnosPrimaria(),
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Alumnos',
            'template' => '{view}{update}',
            'viewButtonLabel' => 'Mostrar los alumnos actualmente inscritos en este Grado/Seccion',
            'updateButtonLabel' => 'Agregar alumnos a este Grado (Matricular)',
            'viewButtonUrl' => 'Yii::app()->createUrl("matricula/view",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'viewButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/ver.png',
            'updateButtonUrl' => 'Yii::app()->createUrl("matricula/create",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'updateButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Calificaciones',
            'template' => '{update}',
            'updateButtonLabel' => 'Editar las notas de este Grado/Seccion',
            'updateButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
            'updateButtonUrl' => 'Yii::app()->createUrl("nota/update",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Maestros',
            'template' => '{asignar}',
            'buttons' => array(
                'asignar' => array(
                    'label' => 'Asignar Maestros a sus respectivas asignaturas',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
                    'url' => 'Yii::app()->createUrl("maestro/asignar",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
                )
            ),
        ),
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'secundaria-grid',
    'summaryText' => '',
    'dataProvider' => $model->estadisticas_AlumnosSecundaria(),
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Alumnos',
            'template' => '{view}{update}',
            'viewButtonLabel' => 'Mostrar los alumnos actualmente inscritos en este Grado/Seccion',
            'updateButtonLabel' => 'Agregar alumnos a este Grado (Matricular)',
            'viewButtonUrl' => 'Yii::app()->createUrl("matricula/view",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'viewButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/ver.png',
            'updateButtonUrl' => 'Yii::app()->createUrl("matricula/create",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
            'updateButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Calificaciones',
            'template' => '{update}',
            'updateButtonLabel' => 'Editar las notas de este Grado/Seccion',
            'updateButtonImageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
            'updateButtonUrl' => 'Yii::app()->createUrl("nota/update",
                array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Maestros',
            'template' => '{asignar}',
            'buttons' => array(
                'asignar' => array(
                    'label' => 'Asignar Maestros a sus respectivas asignaturas',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/icons/modificar.png',
                    'url' => 'Yii::app()->createUrl("maestro/asignar",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"]))',
                )
            ),
        ),
    ),
));
?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="info">
<?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>