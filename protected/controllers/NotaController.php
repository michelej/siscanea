<?php

class NotaController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $submenu;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'delete'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'index', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    /**
     * Muestra las notas dado los parametros Año escolar,grado y seccion 
     * 
     * @param type $sm
     * @param type $gr
     * @param type $se 
     */
    
    public function actionView($sm, $gr, $se) {
        $semestre = Semestre::model()->findByPk($sm);
        $matriculas = Matricula::model()->findAllByAttributes(array('semestre_id' => $sm, 'grado_id' => $gr, 'seccion' => $se));
        
        foreach($matriculas as $values){            
            if(!$values->verificarNotas()){
                $values->procesarNotas();
            }
        }
        $notas=$this->loadNotas($matriculas);
        $data=Nota::model()->vistaTabular($notas);  //      
        
        $this->render('view', array(
            'model' => $data,
            'semestre' => $semestre,
        ));
    }
    /**
     * Modificamos las notas dados los parametros Año escolar, grado y seccion
     * 
     * @param type $sm
     * @param type $gr
     * @param type $se 
     */

    public function actionUpdate($sm, $gr, $se) {
        $this->layout= '//layouts/column1';

        // Guardo las notas
        if(isset($_POST["Nota"])){            
            $notas=$_POST["Nota"];
            foreach($notas as $nota){
                $new=Nota::model()->findByPk((int)$nota["id"]);                
                $new->saveAttributes(array("calificacion"=>(int)$nota["calificacion"]));
            }
            $this->redirect(array('semestre/view','id'=>$sm)); //- vista tabular
        }
        
        // Busco el semestre y luego las matriculas dado los parametros $sm,$gr,$se
        $semestre = Semestre::model()->findByPk($sm);
        $matriculas = Matricula::model()->findAllByAttributes(array('semestre_id' => $sm, 'grado_id' => $gr, 'seccion' => $se));
        foreach($matriculas as $values){
            // Verifico las notas si no existen o tiene algun error las creo de nuevo
            if(!$values->verificarNotas()){
                $values->procesarNotas();
            }
        }
        unset($matriculas);
        $matriculas = Matricula::model()->findAllByAttributes(array('semestre_id' => $sm, 'grado_id' => $gr, 'seccion' => $se));
        $materias=new Materia();
        $materias->grado_id=(int)$gr;
        
        // Si no existe ninguna matricula (alumno inscrito) 
        if(empty($matriculas)){
            Yii::app()->user->setFlash('error',"ERROR: No puede realizar edicion de notas sin
                antes haber inscrito al menos un alumno en este Grado");
            $this->redirect(array('semestre/view', 'id' => $sm));  //- vista tabular
        }

        $this->render('update', array(
            'matriculas' => $matriculas,
            'semestre' => $semestre,
            'materias' =>$materias,
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Nota::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadNotas($matriculas){
         foreach($matriculas as $values){
             $matids[]=$values->id;
         }
         $model=Nota::model()->findAllByAttributes(array('matricula_id' => $matids));
         return $model;        
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nota-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
