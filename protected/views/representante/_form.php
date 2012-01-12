<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'representante-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
                <?php echo $form->dropDownList($model,'nacionalidad',array('V-' => 'V-', 'E-' => 'E-')); ?>
		<?php echo $form->textField($model,'cedula',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cedula'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->