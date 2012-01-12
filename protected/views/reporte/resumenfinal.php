<?php

$this->breadcrumbs = array(
    'Reporte' => array('/reporte'),
    'Resumen',
);
$this->submenu = array(
    array('label' => 'Certificacion de Calificaciones', 'url' => array('reporte/certificado')),
    array('label' => 'Resumen Final de Evaluacion', 'url' => array('reporte/resumen')),
);
?>

En la columna Paginas seleccione el icono de la pagina que desee generar
<br />
<br />
Matricula Final Educacion Inicial (RR-DEA-07-04)
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'preescolar-grid',
    'dataProvider' => $model->estadisticas_AlumnosPreescolar(),
    'selectableRows' => 0,
    'template'=>'{items}{pager}',
    'selectionChanged' => 'function(id) {
                grado_id = $.fn.yiiGridView.getSelection(id);
                $("#Matricula_grado_id").val(grado_id);
                secc = $.fn.yiiGridView.getColumn(id,1);
                $("#Matricula_seccion").val(secc);
                }',
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(
            'class' => 'CButtonColumn',
            'header'=>'Paginas',
            'template' => '{pagina1}{pagina2}',
            'htmlOptions' => array('style'=>'width:80px'),
            'buttons'=>array(
                'pagina1'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0704",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>0))',
                ),
                'pagina2'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'visible'=>'$data["cantidad"]>20',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0704",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>1))',
                ),                
            ),
        ),
    ),
));

echo "Resumen Final de Evaluacion (RR-DEA-06-04)";

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'primaria-grid',
    'dataProvider' => $model->estadisticas_AlumnosPrimaria(),
    'selectableRows' => 0,
    'template'=>'{items}{pager}',
    'selectionChanged' => 'function(id) {
                grado_id = $.fn.yiiGridView.getSelection(id);
                $("#Matricula_grado_id").val(grado_id);
                secc = $.fn.yiiGridView.getColumn(id,1);
                $("#Matricula_seccion").val(secc);
                }',
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(
            'class' => 'CButtonColumn',
            'header'=>'Paginas',
            'template' => '{pagina1}{pagina2}',
            'htmlOptions' => array('style'=>'width:80px'),
            'buttons'=>array(
                'pagina1'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0604",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>0))',
                ),
                'pagina2'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'visible'=>'$data["cantidad"]>20',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0604",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>1))',
                ),                
            ),
        ),
    ),
));

echo "Resumen Final de Evaluacion (RR-DEA-04-03)";
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'secundaria-grid',
    'dataProvider' => $model->estadisticas_AlumnosSecundaria(),
    'selectableRows' => 0,
    'template'=>'{items}{pager}',
    'selectionChanged' => 'function(id) {
                grado_id = $.fn.yiiGridView.getSelection(id);
                $("#Matricula_grado_id").val(grado_id);
                secc = $.fn.yiiGridView.getColumn(id,1);
                $("#Matricula_seccion").val(secc);
                }',
    'columns' => array(
        array(
            'name' => 'Grado',
            'value' => '($row==0 ? $data["nombre"] : ($this->grid->dataProvider->data[$row-1]["nombre"]==$this->grid->dataProvider->data[$row]["nombre"] ? "" : $data["nombre"]))',
        ),
        array(
            'name' => 'Seccion',
            'value' => '($data["seccion"]=="" ? 1 : $data["seccion"])',
        ),
        'cantidad::Alumnos Inscritos',
        array(                        
            'class' => 'CButtonColumn',
            'header'=>'Paginas',
            'template' => '{pagina1}{pagina2}{pagina3}{pagina4}',
            'htmlOptions' => array('style'=>'width:80px'),
            'buttons'=>array(
                'pagina1'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0403",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>0))',
                ),
                'pagina2'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'visible'=>'$data["cantidad"]>13',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0403",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>1))',
                ),
                'pagina3'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'visible'=>'$data["cantidad"]>26',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0403",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>2))',
                ),
                'pagina4'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/page_white_add.png',
                    'visible'=>'$data["cantidad"]>39',
                    'url'=>'Yii::app()->createUrl("reporte/RRDEA0403",
                      array("sm"=>' . $model->id . ',"gr"=>$data["id"],"se"=>$data["seccion"],"p"=>3))',
                ),
            ),
        ),        
    ),
));
?>

