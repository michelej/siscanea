<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alumno-form',
	'enableAjaxValidation'=>false,
)); ?>

        <h1> Datos del Alumno</h1>
        
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
                <?php echo $form->dropDownList($model,'nacionalidad',array('V-' => 'V-', 'E-' => 'E-')); ?>
		<?php echo $form->textField($model,'cedula'); ?>
		<?php echo $form->error($model,'cedula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos'); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
                <?php echo $form->dropDownList($model,'sexo',array('M' => 'Masculino', 'F' => 'Femenino')); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_n'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => CHtml::activeName($model, 'fecha_n'),
                    'value' => $model->attributes['fecha_n'],
                    'language' => 'es',
                    'options'=>array(
                    'yearRange'=>'1980',
                    'dateFormat'=>'yy-mm-dd',
                    'changeMonth'=>true,
                    'changeYear'=>true,
                    'showAnim'=>'fold',
                        ),
                        'htmlOptions'=>array(
                        'style'=>'height:20px;'
                        ),
                    ));?>

		<?php echo $form->error($model,'fecha_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lugar_n'); ?>
		<?php echo $form->textField($model,'lugar_n'); ?>
		<?php echo $form->error($model,'lugar_n'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'entidad_federal'); ?>		
                <?php echo $form->dropDownList($model, 'entidad_federal',
                    CHtml::listData(Entidades::model()->findAll(), 'abreviatura', 'nombre')); ?>
		<?php echo $form->error($model,'entidad_federal'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textField($model,'observaciones'); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

        <div class="row">
            <br />
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
        </div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->