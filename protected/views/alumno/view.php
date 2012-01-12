<?php
$this->breadcrumbs = array(
    'Alumnos' => array('index'),
    $model->getNombreCompleto(),
);

$this->submenu = array(
    array('label' => 'Listado', 'url' => array('alumno/index')),
    array('label' => 'Crear', 'url' => array('alumno/create')),
    array('label' => 'Ver', 'url' => array('alumno/view', 'id' => $model->id)),
    array('label' => 'Modificar', 'url' => array('alumno/update', 'id' => $model->id)),
    array('label' => 'Borrar', 'url' => '#', 'linkOptions' => array('submit' => array('alumno/delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Representante', 'url' => array('alumno/representante', 'id' => $model->id)),
);
?>

<h2>Datos del Alumno</h2>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label' => 'Cedula',
            'value' => $model->CedulaCompleta,
        ),
        'apellidos',
        'nombre',
        array(
            'label' => 'Sexo',
            'value' => $model->Sexo,
        ),
        array(
            'label' => 'Fecha de Nacimiento',
            'value' => Yii::app()->dateFormatter->formatDateTime(strtotime($model->fecha_n), 'long', null),
        ),
        array(
            'label' => 'Edad',
            'value' => $model->Edad,
        ),
        'lugar_n',
        'entidad_federal',
        'observaciones',
        'retirado',
    ),
)); ?>
<br />
<br />
<h2>Datos del Representante</h2>

<?php
if ($model->representante_id == 1) {
    $model->representante->nacionalidad = "";
    $model->representante->cedula = "";
    $model->representante->nombre = "";
    $model->representante->apellidos = "";

    echo "El alumno no tiene un Representante asignado";
} else {
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model->representante,
        'attributes' => array(
            array(
                'label' => 'Cedula',
                'value' => $model->representante->getCedulaCompleta(),
            ),
            'apellidos',
            'nombre',
        ),
    ));
}
?>