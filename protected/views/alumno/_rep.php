<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'representante-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
));
    if($model->id==1){
        unset($model->cedula);
        unset($model->nombre);
        unset($model->apellidos);
    }
?>
        <h1> Datos del Representante</h1>
        <p>Si el representante ya existe solo debe introducir su cedula de identidad</p>
           
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Seleccionar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->