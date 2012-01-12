<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'matricula-form',
                'enableAjaxValidation' => false,
            ));
    ?>
    

    <hr>
    <h1>Buscar Alumno</h1>
    <br />
    
    <div class="row">
        <?php echo $form->label($alumnos, 'cedula'); ?>
        <?php echo $form->dropDownList($alumnos, 'nacionalidad', array('V-' => 'V-', 'E-' => 'E-')); ?>
        <?php echo $form->textField($alumnos, 'cedula'); ?>
    </div>
    
    
    <div class="row">
        <?php echo $form->label($alumnos, 'nombre'); ?>
        <?php echo $form->textField($alumnos, 'nombre'); ?>
    </div>
    
    
    <div class="row">
        <?php echo $form->label($alumnos, 'apellidos'); ?>
        <?php echo $form->textField($alumnos, 'apellidos'); ?>
    </div>
    

    <div class="row buttons">
        <?php echo CHtml::submitButton('Buscar', array('name' => 'busqueda')); ?>        
    </div>

    <hr>

    <div class="row">
        <?php //echo $form->hiddenField($model, 'semestre_id', array('value' => $semestre->id)); ?>
        <?php echo $form->hiddenField($model, 'alumno_id', array('value' => "")); ?>

        <?php //echo $form->labelEx($model, 'grado_id'); ?>
        <?php /* echo $form->dropDownList($model, 'grado_id',
          CHtml::listData(Grado::model()->findAll(), 'id', 'nombre')); */ ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'seccion'); ?>
        <?php echo $form->dropDownList($model, 'seccion',
                array('1' => 'Seccion 1', '2' => 'Seccion 2', '3' => 'Seccion 3')); ?>
        <?php echo CHtml::submitButton('Inscribir', array('name' => 'inscribir')); ?>
    </div>

    <div class="row">
     Listado de alumnos que actualmente no se encuentan inscritos en ninguna Grado , para poder inscribir a un alumno
     seleccionelo de la lista de abajo (se pueden seleccionar multiples) luego seleccione la Seccion a la que van a pertenecer
     y proceda a presionar Inscribir
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'alumnos-grid',
            'dataProvider' => $alumnos->searchIds(),
            'selectableRows' => 2,
            'enableSorting'=>false,
            'selectionChanged' => 'function(id) {
                alumno_id = $.fn.yiiGridView.getSelection(id);
                $("#Matricula_alumno_id").val(alumno_id);                
                }',
            'columns' => array(
                'CedulaCompleta',
                'NombreCompleto',
                'Sexo',
                'Edad',
                'lugar_n',
            ),
        ));
        ?>
    </div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->

