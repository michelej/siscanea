<?php
$this->breadcrumbs = array(
        'Año Escolar' => array('semestre/index'),
        $curso[0]->semestre->temporada=>array('semestre/view','id'=>$curso[0]->semestre_id),
	'Maestros',
);

$this->submenu = array(    
    array('label' => 'Volver al Año Escolar', 'url' => array('semestre/view', 'id' => $curso[0]->semestre_id)),
);
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'maestro-form',
                'enableAjaxValidation' => false,
            ));
    ?>
   
    
    <div id="notas-grid" class="grid-view">
        <h1> <?php echo "Semestre ".$curso[0]->semestre->temporada; ?></h1>        
        <h1> <?php echo $curso[0]->materia->grado->nombre; ?></h1>
        <table class="items">
            <thead>
                <tr><th>Asignatura</th><th>Maestro</th>                    
                </tr>
            </thead>
            <tbody>
                <?php   $c=0;
                      foreach ($curso as $i=>$curs): ?>
                    <?php if($c==0){ $c++;?>
                        <tr class="odd">
                    <?php }else { $c=0;?>
                        <tr class="even">
                    <?php } ?>
                            <td><?php echo $curs->materia->asignatura->descripcion; ?></td>
                            <td><?php echo $form->dropDownList($curs, "[$i]maestro_id",
                            CHtml::listData(Maestro::model()->findAll(), 'id', 'NombreCompleto')); ?> </td>
                            <?php echo $form->hiddenField($curs, "[$i]id", array('value' => $curs->id)); ?>
                        </tr>
                        
                <?php endforeach; ?>
            </tbody>
       </table>
   </div>
    

    <div class="row buttons">
        <?php echo CHtml::submitButton('Guardar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->