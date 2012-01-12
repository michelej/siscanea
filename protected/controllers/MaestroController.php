<?php

class MaestroController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/columnform';
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
                'actions' => array('create', 'update', 'index', 'delete', 'asignar'),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Maestro;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Maestro'])) {
            $model->attributes = $_POST['Maestro'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Maestro'])) {
            $model->attributes = $_POST['Maestro'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Maestro('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Maestro']))
            $model->attributes = $_GET['Maestro'];

        $this->render('index', array('model' => $model));
    }

    /*
     *  Le asignamos el maestro a un curso en especifico.
     *  $sm =  El año escolar
     *  $gr =  El grado 
     *  $se =  La seccion
     */

    public function actionAsignar($sm, $gr, $se) {
        // Definicion de Curso = Especifica un año escolar , una materia , su profesor respectivo
        // y una seccion.
        
        // Si existe Curso en el POST entonces significa que estamos modificando Curso
        // es decir asignando maestro a materias
        if (isset($_POST["Curso"])) {
            $cursos = $_POST["Curso"];
            foreach ($cursos as $cur) {
                $new = Curso::model()->findByPk((int) $cur["id"]);
                $new->saveAttributes(array("maestro_id" => (int) $cur["maestro_id"]));
            }
            $this->redirect(array('semestre/view', 'id' => $sm));
        }
        
        // Buscamos todas las materias que corresponden al grado  $gr
        $materias = Materia::model()->findAllByAttributes(array("grado_id" => $gr));
        $mat_ids = CHtml::listData($materias, 'id', 'id');
        // En primaria solo existe una materia general pero en secundaria existen varias,
        // luego buscamos todos los cursos de el año escolar $sm , seccion $se y materias sea una sola o una lista
        if (count($mat_ids) == 1) {
            foreach ($mat_ids as $mid) {
                $id = $mid;
            }
            $curso = Curso::model()->findAllByAttributes(array("semestre_id" => $sm, "seccion" => (int) $se, "materia_id" => (int) $id));
        } else {
            $curso = Curso::model()->findAllByAttributes(array("semestre_id" => $sm, "seccion" => (int) $se, "materia_id" => $mat_ids));
        }
        // Si no existe un curso asociado a esos parametros lo creamos
        if (empty($curso)) {
            $c = count($materias);
            for ($i = 0; $i < $c; $i++) {
                $curso[$i] = new Curso();
                $curso[$i]->maestro_id = 1;
                $curso[$i]->semestre_id = $sm;
                $curso[$i]->seccion = $se;
                $curso[$i]->materia_id = $materias[$i]->id;
                $curso[$i]->save();
            }
        }
        // Mostramos la vista de asignar 
        $this->render('asignar', array('materias' => $materias, 'curso' => $curso));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Maestro::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'maestro-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
