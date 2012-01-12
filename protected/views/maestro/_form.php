<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maestro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

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
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono'); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
                <?php echo $form->dropDownList($model,'estado',array('Activo' => 'Activo', 'Inactivo' => 'Inactivo')); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Grabar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->