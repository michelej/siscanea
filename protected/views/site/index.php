<?php $this->pageTitle=Yii::app()->name; ?>
<?php
$mod=Alumno::model()->findAll();
$alumnos=count($mod);
$mod=  Representante::model()->findAll();
$representantes=count($mod);
$mod=Maestro::model()->findAll();
$maestros=count($mod)-1;
$mod=Semestre::model()->findAll();
$semestre=count($mod);
$mod=Matricula::model()->findAll();
$matriculas=count($mod);
$mod=Nota::model()->findAll();
$notas=count($mod);
?>


<h1>Bienvenido al <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

Actualmente el sistema maneja las siguientes estadisticas

<div id="general-grid" class="grid-view" style="width:300px;margin-left:100px">
        <table class="items">            
            <tbody>
                <tr class="odd">
                    <td>
                        Alumnos
                    </td>
                    <td>
                        <?php echo $alumnos;?>
                    </td>
                </tr>
                <tr class="even">
                    <td>
                        Maestros
                    </td>
                    <td>
                        <?php echo $maestros;?>
                    </td>
                </tr>
                <tr class="odd">
                    <td>
                        Años Escolares
                    </td>
                    <td>
                        <?php echo $semestre;?>
                    </td>
                </tr>
                <tr class="even">
                    <td>
                        Matriculas
                    </td>
                    <td>
                        <?php echo $matriculas;?>
                    </td>
                </tr>
                 <tr class="odd">
                    <td>
                        Calificaciones
                    </td>
                    <td>
                        <?php echo $notas;?>
                    </td>
                </tr>
            </tbody>
       </table>
   </div>
