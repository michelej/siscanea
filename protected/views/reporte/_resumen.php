<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'reporte-form',
                'enableAjaxValidation' => false,
            ));
    ?>

    Seleccione el semestre y presione siguiente
    <div class="row">
        <?php echo $form->hiddenField($model, 'id', array('value' => $model->id)); ?>
        <?php echo $form->hiddenField(Matricula::model(), 'grado_id', array('value' => "")); ?>
        <?php echo $form->hiddenField(Matricula::model(), 'seccion', array('value' => "")); ?>
    </div>

    <div class="row">        
        <?php        
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'reporte-grid',
                'dataProvider' => $model->search(),
                'selectableRows' => 1,
                'template'=>'{items}{pager}',
                'selectionChanged' => 'function(id) {
                semestre_id = $.fn.yiiGridView.getSelection(id);
                $("#Semestre_id").val(semestre_id);
                }',
                'columns' => array(
                    'temporada',
                    'fechaInicio',
                    'fechaFin',
                ),
            ));
        
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Siguiente'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->