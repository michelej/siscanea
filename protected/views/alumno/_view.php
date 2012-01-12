<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('representante_id')); ?>:</b>
	<?php echo CHtml::encode($data->representante_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cedula')); ?>:</b>
	<?php echo CHtml::encode($data->cedula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b>
	<?php echo CHtml::encode($data->sexo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_n')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar_n')); ?>:</b>
	<?php echo CHtml::encode($data->lugar_n); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nacionalidad')); ?>:</b>
	<?php echo CHtml::encode($data->nacionalidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retirado')); ?>:</b>
	<?php echo CHtml::encode($data->retirado); ?>
	<br />

	*/ ?>

</div>