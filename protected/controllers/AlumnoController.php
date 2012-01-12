<?php

class AlumnoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
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
                'actions' => array('create', 'update', 'index', 'delete', 'representante'),
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
        $this->layout = '//layouts/columnform';
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = '//layouts/columnform';
        $model = new Alumno;

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Alumno'])) {
            $model->attributes = $_POST['Alumno'];
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
        $this->layout = '//layouts/columnform';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Alumno'])) {
            $model->attributes = $_POST['Alumno'];
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
        $model = new Alumno('search');
        $model->unsetAttributes();

        if (isset($_GET['Alumno']))
            $model->attributes = $_GET['Alumno'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /*
     *  Asignamos o Creamos un Representante para el Alumno del ID , no se tiene
     *  un control muy estricto ya que es informacion que no era necesaria 
     *  TODO: No hay acceso al CRUD asi que no hay manera de eliminar representantes o modificar
     */

    public function actionRepresentante($id) {
        $this->layout = '//layouts/columnform';
        $alumno = $this->loadModel($id);
        $model = $alumno->representante;

        // Si existe un modelo de tipo Representante en el POST quiere decir que estoy tratando
        // con la creacion o asignacion de un representante
        if (isset($_POST['Representante'])) {
            // creo un modelo de tipo representante y obtengo los atributos desde el POST
            // pueden ser completos o solo parte de ellos, para buscarlo si ya existe
            $representante = new Representante();
            $representante->attributes = $_POST['Representante'];

            // si el representante existe se lo asigno a este alumno ID
            if ($representante->repExiste()) {
                $data = $representante->search();
                $id = $data->getKeys();
                if (count($id) == 1) {
                    $alumno->representante_id = $id;
                    $alumno->saveAttributes(array("representante_id" => $id[0]));
                    $this->redirect(array('view', 'id' => $alumno->id));
                }
                /* if (count($id) > 1) {
                  $model->representante->attributes = $_POST['Representante'];
                  $resultados = new CArrayDataProvider(Representante::model()->findAllByPk($id), array('id' => 'id',));
                  } */
            } else {
                // si no existe entones lo trato de grabar y luego se lo asigno al alumno ID                
                if ($representante->save()) {
                    $key = $representante->getPrimaryKey();
                    $alumno->saveAttributes(array("representante_id" => $key));
                    $this->redirect(array('view', 'id' => $alumno->id));
                } else {
                    // si no logre grabarlo por falta de datos redirecciono para que sigua tratando
                    // TODO : Mensaje de error aqui, porque no se logro grabar el representante
                    $this->redirect(array('view', 'id' => $alumno->id));
                }
            }
        }
        //////////////////////////////////
        // Aqui mostramos la vista "representante" donde recopilamos los datos                
        $this->render('representante', array(
            'alumno' => $alumno,
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Alumno::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'alumno-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
