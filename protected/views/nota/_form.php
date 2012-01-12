<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'notas-update',
                'enableAjaxValidation' => false,
            ));
    ?>
  <?php if($matriculas[0]->grado_id>=1 && $matriculas[0]->grado_id<=6){
      echo "Tabla de Conversión: A (19 – 20)  B (16 – 18)  C (13 – 15)  D (10 – 12)  E (01 – 09)";
       }       
      ?>


  <div id="notas-grid" class="grid-view">
        <table class="items">
            <thead>
                <tr><th>Cedula</th><th>Nombre</th>
                    <?php foreach ($matriculas[0]->notas as $notas): ?>
                        <th> <?php echo $notas->materia->asignatura->abreviatura; ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>
            <tbody>
                <?php   $c=0;
                        foreach ($matriculas as $matricula): ?>
                    <?php if($c==0){ $c++;?>
                        <tr class="odd">
                    <?php }else { $c=0;?>
                        <tr class="even">
                    <?php } ?>
                                <td><?php echo $matricula->alumno->getCedulaCompleta(); ?></td>
                                <td><?php echo $matricula->alumno->getNombreCompleto(); ?></td>
                        <?php foreach ($matricula->notas as $nota): ?>
                                <td><?php echo $form->textField($nota,"[$nota->id]calificacion",array('size'=>2,'maxlength'=>2)); ?></td>
                                    <?php echo $form->hiddenField($nota, "[$nota->id]id", array('value' => $nota->id)); ?>
                        <?php endforeach; ?>
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