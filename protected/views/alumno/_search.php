<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
        <h1>Busqueda Avanzada</h1>
        <br />
	<div class="row">
		<?php echo $form->label($model,'cedula'); ?>
                <?php echo $form->dropDownList($model,'nacionalidad',array('V-' => 'V-', 'E-' => 'E-')); ?>
		<?php echo $form->textField($model,'cedula'); ?>
	</div>
    	

        <div class="row">
                <?php echo $form->label($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos'); ?>
	</div>

        <div class="row">
                <?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->