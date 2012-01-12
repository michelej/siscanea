<?php

class MatriculaController extends Controller {

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
                'actions' => array('create', 'delete', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'delete', 'view'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($sm, $gr, $se) {
        $this->layout = '//layouts/column1';
        $model = new Matricula;
        $model->semestre_id = (int) $sm;
        $model->grado_id = (int) $gr;
        $model->seccion = (int) $se;

        if ($model->seccion == 0) {
            $model->seccion = 1;
        }
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($sm,$gr,$se) {
        $this->layout = '//layouts/column1';

        if (isset($_POST['Matricula'])) {
            $matricula = $_POST['Matricula'];
            $alumnos = explode(",", $matricula["alumno_id"]);
            foreach ($alumnos as $alumno_id) {
                $model = new Matricula;
                $model->alumno_id = $alumno_id;
                $model->semestre_id = $sm;
                $model->grado_id = $gr;
                $model->seccion = $matricula["seccion"];
                $model->save();
            }
            
        }
            $model = new Matricula;
            $model->semestre_id=$sm;
            $model->grado_id=$gr;
            if(!empty($se)){
                //$model->seccion=$se;
            }
            
            $semestre = $this->loadSemestreModel($sm);
            $alumnos=$semestre->listado_Alumnos();
        if (isset($_POST['busqueda'])) {            
            $alumnos->attributes = $_POST['Alumno'];                        
        }

        $this->render('create', array(
            'model' => $model,
            'semestre' => $semestre,
            'alumnos' => $alumnos,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            if (!empty($model->notas)) {
                foreach ($model->notas as $nota) {
                    $nota->delete();
                }
            }
            $model->delete();                
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Matricula::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadSemestreModel($id) {
        $model = Semestre::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'matricula-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
