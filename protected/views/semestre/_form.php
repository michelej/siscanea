<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'semestre-form',
	'enableAjaxValidation'=>false,
));?>

        <h1> Datos del Año Escolar</h1>

	<?php echo $form->errorSummary($model); ?>
               
	<div class="row">
		<?php echo $form->labelEx($model,'año_inicio'); ?>                
		<?php echo $form->dropDownList($model,'año_inicio',Semestre::getAños(),
                        array('options' => array(date("Y")=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'año_inicio'); ?>
	</div>

        <div class="row">
                <br />

        </div>

        
        <div class="row">
		<?php echo $form->labelEx($model,'mes_inicio'); ?>
                <?php echo $form->dropDownList($model,'mes_inicio',Semestre::getMeses(),
                        array('options' => array('Septiembre'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'mes_inicio'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'mes_fin'); ?>
                <?php echo $form->dropDownList($model,'mes_fin',Semestre::getMeses(),
                        array('options' => array('Julio'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'mes_fin'); ?>
	</div>        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->