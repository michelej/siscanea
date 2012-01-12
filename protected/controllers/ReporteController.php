<?php

class ReporteController extends Controller {

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

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'certificado', 'resumen', 'matricula', 'RRDEA0303', 'RRDEA0403', 'RRDEA0604', 'RRDEA0704'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCertificado() {
        $this->layout = '//layouts/column1';
        $alumno = new Alumno('search');
        $alumno->unsetAttributes();
        $matricula = new Matricula;
        $matricula->unsetAttributes();

        if (isset($_GET['Alumno'])) {
            $alumno->attributes = $_GET['Alumno'];
            $temp = $alumno->search();
            if ($temp->ItemCount == 1) {
                $matricula->alumno_id = $temp->Keys;
                $alumno->id = $temp->Keys[0];
                $alumno->nombre = $temp->data[0]["nombre"];
                $alumno->apellidos = $temp->data[0]["apellidos"];
                $alumno->cedula = $temp->data[0]["cedula"];
                $alumno->nacionalidad = $temp->data[0]["nacionalidad"];
            } else {
                $matricula->alumno_id = 65535;
            }
        } else {
            $matricula->alumno_id = 65535;
        }
        $this->render('certificado', array(
            'alumno' => $alumno,
            'matricula' => $matricula,
        ));
    }

    public function actionRRDEA0303($id, $tp) {
        
        $aa = array(array('A11', 'A12', 'A13', 'A14', 'A15', 'A16', 'A17'), array('A21', 'A22', 'A23', 'A24', 'A25', 'A26', 'A27'), array('A31', 'A32', 'A33', 'A34', 'A35', 'A36', 'A37'),
            array('A41', 'A42', 'A43', 'A44', 'A45', 'A46', 'A47'), array('A51', 'A52', 'A53', 'A54', 'A55', 'A56', 'A57'), array('A61', 'A62', 'A63', 'A64', 'A65', 'A66', 'A67'),
            array('A71', 'A72', 'A73', 'A74', 'A75', 'A76', 'A77'), array('A81', 'A82', 'A83', 'A84', 'A85', 'A86', 'A87'), array('A91', 'A92', 'A93', 'A94', 'A95', 'A96', 'A97'),
            array('A101', 'A102', 'A103', 'A104', 'A105', 'A106', 'A107'), array('A111', 'A112', 'A113', 'A114', 'A115', 'A116', 'A117'), array('A121', 'A122', 'A123', 'A124', 'A125', 'A126', 'A127'),
            array('A131', 'A132', 'A133', 'A134', 'A135', 'A136', 'A137'), array('A141', 'A142', 'A143', 'A144', 'A145', 'A146', 'A147'), array('A151', 'A152', 'A153', 'A154', 'A155', 'A156', 'A157'));
        $alumno = Alumno::model()->findByPk($id);

        require_once '/protected/extensions/PHPWord/PHPWord.php';
        Yii::registerAutoloader(array('PHPWord_Autoloader', 'Load'));
        $PHPWord = new PHPWord();
        $document = $PHPWord->loadTemplate('protected/extensions/PHPWord/Templates/RRDEA0303.docx');

        $document->setValue('FECHA_EXP', 'Cania, ' . date('d/m/Y'));

        $document->setValue('CEDULA', $alumno->cedulaCompleta);
        $document->setValue('APELLIDOS', strtr(strtoupper($alumno->apellidos),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
        $document->setValue('NOMBRES', strtr(strtoupper($alumno->nombre),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
        $document->setValue('LUGAR_NAC', strtr(strtoupper($alumno->lugar_n),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
        $document->setValue('FECHA_NAC', date('d/m/Y', strtotime($alumno->fecha_n)));

        $ef = Entidades::model()->findByAttributes(array('abreviatura' => $alumno->entidad_federal));
        $document->setValue('ENTIDAD', strtoupper($ef->nombre));

        if ($tp == 1) {
            $document->setValue('PLAN', 'BASICA III ETAPA');
            $document->setValue('COD1', '32011');
            $document->setValue('MENCION', 'XXXXXXXXX');
            $document->setValue('GRADO1', 'SEPTIMO');
            $document->setValue('GRADO2', 'OCTAVO');
            $document->setValue('GRADO3', 'NOVENO');
            $grados = array("7", "8", "9");
        } else {
            $document->setValue('PLAN', 'EDUCACION MEDIA GENERAL');
            $document->setValue('COD1', '31018');
            $document->setValue('MENCION', 'CIENCIAS');
            $document->setValue('GRADO1', '4TO AÑO');
            $document->setValue('GRADO2', '5TO AÑO');
            $document->setValue('GRADO3', ' ');
            $grados = array(10, 11, 65535);
        }

        $grad = array("0", "0", "0");
        for ($i = 0; $i < count($alumno->matriculas); $i++) {
            if ($alumno->matriculas[$i]->grado_id == $grados[0]) {
                $grad[0] = "1";
            }
            if ($alumno->matriculas[$i]->grado_id == $grados[1]) {
                $grad[1] = "1";
            }
            if ($alumno->matriculas[$i]->grado_id == $grados[2]) {
                $grad[2] = "1";
            }
        }

        for ($i = 0; $i < 3; $i++) {
            if ($grad[$i] == "0") {
                switch ($i) {
                    case 0:
                        $p = "A";
                        break;
                    case 1:
                        $p = "B";
                        break;
                    case 2:
                        $p = "C";
                        break;

                    default:
                        break;
                }
                $actual = $aa[0][0][0];
                for ($x = 0; $x < count($aa); $x++) {
                    $aa[$x] = str_replace($actual, $p, $aa[$x]);
                }

                for ($j = 0; $j < 15; $j++) {
                    $document->setValue($aa[$j][0], "***********************");
                    $document->setValue($aa[$j][1], "***");
                    $document->setValue($aa[$j][2], "************");
                    $document->setValue($aa[$j][3], "*");
                    $document->setValue($aa[$j][4], "****");
                    $document->setValue($aa[$j][5], "***");
                    $document->setValue($aa[$j][6], "******");
                }
            }
        }

        foreach ($alumno->matriculas as $matricula) {
            $flag = 0;
            if ($matricula->grado_id == $grados[0]) {
                $flag = 1;
                $actual = $aa[0][0][0];
                for ($i = 0; $i < count($aa); $i++) {
                    $aa[$i] = str_replace($actual, "A", $aa[$i]);
                }
            }
            if ($matricula->grado_id == $grados[1]) {
                $flag = 1;
                $actual = $aa[0][0][0];
                for ($i = 0; $i < count($aa); $i++) {
                    $aa[$i] = str_replace($actual, "B", $aa[$i]);
                }
            }
            if ($matricula->grado_id == $grados[2]) {
                $flag = 1;
                $actual = $aa[0][0][0];
                for ($i = 0; $i < count($aa); $i++) {
                    $aa[$i] = str_replace($actual, "C", $aa[$i]);
                }
            }

            if ($flag == 1) {
                $i = 0;
                for ($j = 0; $j < 15; $j++) {
                    if (isset($matricula->notas[$j])) {
                        $document->setValue($aa[$i][0], strtoupper($matricula->notas[$j]->materia->asignatura->Nombre));
                        $document->setValue($aa[$i][1], $matricula->notas[$j]->calificacion);
                        $document->setValue($aa[$i][2], $matricula->notas[$j]->EnLetras);
                        $document->setValue($aa[$i][3], "F"); //** ojo T-E ??
                        $document->setValue($aa[$i][4], $matricula->notas[$j]->NumeroMes);  // MES
                        $document->setValue($aa[$i][5], $matricula->notas[$j]->fecha_año);  // AÑO
                        $document->setValue($aa[$i][6], "1"); // NUMERO DEL PLANTEL
                        $i++;
                    } else {
                        $document->setValue($aa[$i][0], "***********************");
                        $document->setValue($aa[$i][1], "***");
                        $document->setValue($aa[$i][2], "************");
                        $document->setValue($aa[$i][3], "*");
                        $document->setValue($aa[$i][4], "****");
                        $document->setValue($aa[$i][5], "***");
                        $document->setValue($aa[$i][6], "******");
                        $i++;
                    }
                }
            }
        }
        $document->save('protected/extensions/PHPWord/REPORTE.docx');

        $file = 'protected/extensions/PHPWord/REPORTE.docx';
        header('Content-Description: File Transfer');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function actionResumen() {
        $this->layout = '//layouts/columnform';
        $model = new Semestre();
        
        if (isset($_POST["Semestre"])) {                
            $model->id = $_POST["Semestre"]["id"];
            if(!empty($model->id)){
            $this->render('resumenfinal', array('model' => $model));
            }else{
            $this->render('resumen', array('model' => $model));
            }
        } else {
            $this->render('resumen', array('model' => $model));
        }
    }

    public function actionRRDEA0403($sm, $gr, $se, $p) {
        $pagina = $p * 13;  //--

        $criteria = new CDbCriteria;
        $criteria->compare('grado_id', $gr);
        $criteria->compare('semestre_id', $sm);
        $criteria->compare('seccion', $se);
        $criteria->with = 'alumno';
        $criteria->order = 'ABS (cedula)';

        $matricula = Matricula::model()->findAll($criteria);
        require_once '/protected/extensions/PHPWord/PHPWord.php';
        Yii::registerAutoloader(array('PHPWord_Autoloader', 'Load'));
        $PHPWord = new PHPWord();
        $document = $PHPWord->loadTemplate('protected/extensions/PHPWord/Templates/RRDEA0403.docx');

        $document->setValue('TEMPO', $matricula[0]->semestre->temporada);
        $document->setValue('FECHA', strtoupper($matricula[0]->semestre->fechaFin));
        $document->setValue('GRADO', $matricula[0]->grado->nombre);

        $dbCommand = Yii::app()->db->createCommand("
           SELECT COUNT(*) as count FROM `matricula` WHERE semestre_id='" . $sm . "' AND grado_id='" . $gr . "'  GROUP BY `seccion`
            ");

        $data = $dbCommand->queryAll();
        if (count($data)==1) {
            $seccion = "U";
        } else {
            if ($matricula[0]->seccion == 1) {
                $seccion = "A";
            }
            if ($matricula[0]->seccion == 2) {
                $seccion = "B";
            }
            if ($matricula[0]->seccion == 3) {
                $seccion = "C";
            }
        }

        $document->setValue('SECCION', $seccion); // SECCION

        $cantidad = count($matricula);
        $total = $cantidad - $pagina;
        if ($total > 13) {
            $total = 13;
        }
        $document->setValue('NUMPAGINA', $total);  //ALUMNOS EN LA PAGINA
        $document->setValue('NUMTOTAL', $cantidad);  // TOTAL ALUMNOS

        if ($gr >= 7 && $gr <= 9) {
            $document->setValue('PLAN', 'BASICA III ETAPA');
            $document->setValue('COD', '32011');
            $document->setValue('MENCION', 'XXXXXXXXX');
        }
        if ($gr >= 10 && $gr <= 11) {
            $document->setValue('PLAN', 'EDUCACION MEDIA GENERAL');
            $document->setValue('COD', '31018');
            $document->setValue('MENCION', 'CIENCIAS');
        }



        for ($i = 0; $i < 14; $i++) {
            if (isset($matricula[0]->notas[$i])) {
                $document->setValue('M' . ($i + 1), $matricula[0]->notas[$i]->materia->asignatura->abreviatura);
            } else {
                $document->setValue('M' . ($i + 1), '*');
            }
        }
        $c = 1;
        for ($i = $pagina; $i < ($pagina + 13); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue('CED' . $c, $matricula[$i]->alumno->CedulaCompleta);
            } else {
                $document->setValue('CED' . $c, "*****************");
            }
            $c++;
        }


        $c = 1;
        $ee = array(array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0));
        for ($i = $pagina; $i < ($pagina + 13); $i++) {
            for ($j = 0; $j < 14; $j++) {
                if (isset($matricula[$i]->notas[$j])) {
                    if ($matricula[$i]->notas[$j]->calificacion == 0) {
                        $document->setValue($c, "*");
                    } else {
                        $document->setValue($c, $matricula[$i]->notas[$j]->calificacion);
                        $ee[0][$j]++;
                        if ($matricula[$i]->notas[$j]->calificacion >= 10) {
                            $ee[1][$j]++;
                        }
                    }
                } else {
                    $document->setValue($c, '*');
                }
                $c++;
            }
        }
        //*********
        $lim = count($matricula[0]->notas);
        for ($i = 0; $i < $lim; $i++) {
            $document->setValue("C" . ($i + 1), $ee[0][$i]);
            $document->setValue("C" . ($i + 15), "0");
            $document->setValue("C" . ($i + 29), $ee[1][$i]);
            $document->setValue("C" . ($i + 43), $ee[0][$i] - $ee[1][$i]);
        }
        for ($i = $lim; $i < 14; $i++) {
            $document->setValue("C" . ($i + 1), "*");
            $document->setValue("C" . ($i + 15), "*");
            $document->setValue("C" . ($i + 29), "*");
            $document->setValue("C" . ($i + 43), "*");
        }



        //*****
        $c = 0;
        for ($i = $pagina; $i < ($pagina + 13); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue("A" . $c, strtr(strtoupper($matricula[$i]->alumno->apellidos),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("A" . ($c + 1), strtr(strtoupper($matricula[$i]->alumno->nombre),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("A" . ($c + 2), strtr(strtoupper($matricula[$i]->alumno->lugar_n),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("A" . ($c + 3), $matricula[$i]->alumno->entidad_federal); // OJO ENTIDAD FEDERAL 2 LETRAS
                $document->setValue("A" . ($c + 4), $matricula[$i]->alumno->sexo);
                $document->setValue("A" . ($c + 5), date("d", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue("A" . ($c + 6), date("m", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue("A" . ($c + 7), date("Y", strtotime($matricula[$i]->alumno->fecha_n)));
            } else {
                $document->setValue("A" . $c, "*************");
                $document->setValue("A" . ($c + 1), "*************");
                $document->setValue("A" . ($c + 2), "*************");
                $document->setValue("A" . ($c + 3), "*"); // OJO ENTIDAD FEDERAL 2 LETRAS
                $document->setValue("A" . ($c + 4), "*");
                $document->setValue("A" . ($c + 5), "*");
                $document->setValue("A" . ($c + 6), "*");
                $document->setValue("A" . ($c + 7), "*");
            }
            $c = $c + 8;
        }
        //*******
        $materias = Materia::model()->findAllByAttributes(array("grado_id" => $gr));
        $mat_ids = CHtml::listData($materias, 'id', 'id');
        $curso = Curso::model()->findAllByAttributes(array("semestre_id" => $sm, "materia_id" => $mat_ids));

        $c = 1;
        for ($i = 0; $i < 15; $i++) {
            if (isset($curso[$i])) {
                $document->setValue("B" . $c, strtr(strtoupper($curso[$i]->materia->asignatura->Nombre),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("B" . ($c + 1), strtr(strtoupper($curso[$i]->maestro->NombreCompleto),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("B" . ($c + 2), strtoupper($curso[$i]->maestro->CedulaCompleta));
            } else {
                $document->setValue("B" . $c, "**************");
                $document->setValue("B" . ($c + 1), "**************");
                $document->setValue("B" . ($c + 2), "**************");
            }
            $c = $c + 3;
        }

        $document->save('protected/extensions/PHPWord/REPORTE.docx');
        $file = 'protected/extensions/PHPWord/REPORTE.docx';
        header('Content-Description: File Transfer');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function actionRRDEA0604($sm, $gr, $se, $p) {
        $pagina = $p * 20;  //--

        $criteria = new CDbCriteria;
        $criteria->compare('grado_id', $gr);
        $criteria->compare('semestre_id', $sm);
        $criteria->compare('seccion', $se);
        $criteria->with = 'alumno';
        $criteria->order = 'ABS (cedula)';

        $matricula = Matricula::model()->findAll($criteria);
        require_once '/protected/extensions/PHPWord/PHPWord.php';
        Yii::registerAutoloader(array('PHPWord_Autoloader', 'Load'));
        $PHPWord = new PHPWord();
        $document = $PHPWord->loadTemplate('protected/extensions/PHPWord/Templates/RRDEA0604.docx');

        $document->setValue('PLAN', 'EDUCACION PRIMARIA');
        $document->setValue('COD', '21000');
        $document->setValue('TEMPO', $matricula[0]->semestre->temporada);
        $document->setValue('FECHA', strtoupper($matricula[0]->semestre->fechaFin));
        $document->setValue('GR', $matricula[0]->grado->nombre);


        //****
        $materias = Materia::model()->findAllByAttributes(array("grado_id" => $gr));
        $curso = Curso::model()->findAllByAttributes(array("semestre_id" => $sm,"seccion"=>$se, "materia_id" => $materias[0]->id));

        $document->setValue('MAESTRO', $curso[0]->maestro->NombreCompleto);
        $document->setValue('MAESTROCI', $curso[0]->maestro->CedulaCompleta);

        $dbCommand = Yii::app()->db->createCommand("
           SELECT COUNT(*) as count FROM `matricula` WHERE semestre_id='" . $sm . "' AND grado_id='" . $gr . "'  GROUP BY `seccion`
            ");

        $data = $dbCommand->queryAll();
        if (count($data)==1) {
            $seccion = "U";
        } else {
            if ($matricula[0]->seccion == 1) {
                $seccion = "A";
            }
            if ($matricula[0]->seccion == 2) {
                $seccion = "B";
            }
            if ($matricula[0]->seccion == 3) {
                $seccion = "C";
            }
        }

        $document->setValue('SE', $seccion); // SECCION
        $cantidad = count($matricula);
        $total = $cantidad - $pagina;
        if ($total > 13) {
            $total = 13;
        }
        $document->setValue('NUM', $total);  //ALUMNOS EN LA PAGINA
        $document->setValue('TOT', $cantidad);  // TOTAL ALUMNOS

        $c = 1;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue("AA" . $c, $matricula[$i]->alumno->CedulaCompleta);
                $document->setValue("AA" . ($c + 1), $matricula[$i]->alumno->lugar_n);
                $document->setValue("BB" . $c, strtr(strtoupper($matricula[$i]->alumno->apellidos),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("BB" . ($c + 1), strtr(strtoupper($matricula[$i]->alumno->nombre),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
            } else {
                $document->setValue("AA" . $c, "************");
                $document->setValue("AA" . ($c + 1), "************");
                $document->setValue("BB" . $c, "****************");
                $document->setValue("BB" . ($c + 1), "****************");
            }
            $c = $c + 2;
        }

        $c = 0;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue($c, $matricula[$i]->alumno->entidad_federal);
                $document->setValue($c + 1, $matricula[$i]->alumno->sexo);
                $document->setValue($c + 2, date("d", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue($c + 3, date("m", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue($c + 4, date("Y", strtotime($matricula[$i]->alumno->fecha_n)));
            } else {
                $document->setValue($c, "*");
                $document->setValue($c + 1, "*");
                $document->setValue($c + 2, "*");
                $document->setValue($c + 3, "*");
                $document->setValue($c + 4, "*");
            }
            $c = $c + 5;
        }

        //********
        $le = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T");
        $acu = array(0, 0, 0, 0, 0);
        $a = 0;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {
                $nota = $matricula[$i]->notas[0]->calificacion;
                if ($nota >= 19) {
                    $document->setValue($le[$a] . "1", "X");
                    $acu[0]++;
                } else {
                    $document->setValue($le[$a] . "1", "*");
                }
                if ($nota >= 16 && $nota <= 18) {
                    $document->setValue($le[$a] . "2", "X");
                    $acu[1]++;
                } else {
                    $document->setValue($le[$a] . "2", "*");
                }
                if ($nota >= 13 && $nota <= 15) {
                    $document->setValue($le[$a] . "3", "X");
                    $acu[2]++;
                } else {
                    $document->setValue($le[$a] . "3", "*");
                }
                if ($nota >= 10 && $nota <= 12) {
                    $document->setValue($le[$a] . "4", "X");
                    $acu[3]++;
                } else {
                    $document->setValue($le[$a] . "4", "*");
                }
                if ($nota >= 1 && $nota <= 9) {
                    $document->setValue($le[$a] . "5", "X");
                    $acu[4]++;
                } else {
                    $document->setValue($le[$a] . "5", "*");
                }
            } else {
                $document->setValue($le[$a] . "1", "*");
                $document->setValue($le[$a] . "2", "*");
                $document->setValue($le[$a] . "3", "*");
                $document->setValue($le[$a] . "4", "*");
                $document->setValue($le[$a] . "5", "*");
            }
            $a++;
        }

        $document->setValue("U1", $acu[0]);
        $document->setValue("U2", $acu[1]);
        $document->setValue("U3", $acu[2]);
        $document->setValue("U4", $acu[3]);
        $document->setValue("U5", $acu[4]);

        $document->save('protected/extensions/PHPWord/REPORTE.docx');
        $file = 'protected/extensions/PHPWord/REPORTE.docx';
        header('Content-Description: File Transfer');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function actionRRDEA0704($sm, $gr, $se, $p) {
        $pagina = $p * 20;  //--

        $criteria = new CDbCriteria;
        $criteria->compare('grado_id', $gr);
        $criteria->compare('semestre_id', $sm);
        $criteria->compare('seccion', $se);
        $criteria->with = 'alumno';
        $criteria->order = 'ABS (cedula)';

        $matricula = Matricula::model()->findAll($criteria);
        require_once '/protected/extensions/PHPWord/PHPWord.php';
        Yii::registerAutoloader(array('PHPWord_Autoloader', 'Load'));
        $PHPWord = new PHPWord();
        $document = $PHPWord->loadTemplate('protected/extensions/PHPWord/Templates/RRDEA0704.docx');

        $document->setValue('TEMPO', $matricula[0]->semestre->temporada);
        $document->setValue('FECHA', strtoupper($matricula[0]->semestre->fechaFin));

        //****
        $materias = Materia::model()->findAllByAttributes(array("grado_id" => $gr));
        $curso = Curso::model()->findAllByAttributes(array("semestre_id" => $sm, "seccion"=>$se,"materia_id" => $materias[0]->id));

        $document->setValue('MAESTRO', $curso[0]->maestro->NombreCompleto);
        $document->setValue('MAESTROCI', $curso[0]->maestro->CedulaCompleta);

        $dbCommand = Yii::app()->db->createCommand("
           SELECT COUNT(*) as count FROM `matricula` WHERE semestre_id='" . $sm . "' AND grado_id='" . $gr . "'  GROUP BY `seccion`
            ");
        $data = $dbCommand->queryAll();

        

        if (count($data)==1) {
            $seccion = "U";            
        } else {            
            if ($matricula[0]->seccion == 1) {
                $seccion = "A";
            }
            if ($matricula[0]->seccion == 2) {
                $seccion = "B";
            }
            if ($matricula[0]->seccion == 3) {
                $seccion = "C";
            }
        }

        $document->setValue('SECCION', $seccion); // SECCION
        $cantidad = count($matricula);
        $total = $cantidad - $pagina;
        if ($total > 13) {
            $total = 13;
        }
        $document->setValue('NUM', $total);  //ALUMNOS EN LA PAGINA
        $document->setValue('TOTAL', $cantidad);  // TOTAL ALUMNOS

        $c = 0;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue($c, $matricula[$i]->alumno->CedulaCompleta);
                $document->setValue($c + 1, $matricula[$i]->alumno->lugar_n);
                $document->setValue($c + 2, $matricula[$i]->alumno->entidad_federal);
                $document->setValue($c + 3, $matricula[$i]->alumno->sexo);
                $document->setValue($c + 4, date("d", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue($c + 5, date("m", strtotime($matricula[$i]->alumno->fecha_n)));
                $document->setValue($c + 6, date("Y", strtotime($matricula[$i]->alumno->fecha_n)));
            } else {
                $document->setValue($c, "*********");
                $document->setValue($c + 1, "********");
                $document->setValue($c + 2, "*");
                $document->setValue($c + 3, "*");
                $document->setValue($c + 4, "*");
                $document->setValue($c + 5, "*");
                $document->setValue($c + 6, "*");
               
            }
            $c = $c + 7;
        }

        $c = 0;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {
                $document->setValue("AA" . $c, strtr(strtoupper($matricula[$i]->alumno->apellidos),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
                $document->setValue("AA" . ($c + 1), strtr(strtoupper($matricula[$i]->alumno->nombre),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"));
            } else {
                $document->setValue("AA" . $c, "************");
                $document->setValue("AA" . ($c + 1), "************");              
            }
            $c = $c + 2;
        }

        //********
        $le = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T");
        $acu = array(0, 0, 0, 0, 0,0,0);
        $a = 0;
        for ($i = $pagina; $i < ($pagina + 20); $i++) {
            if (isset($matricula[$i])) {

                // HACKKK el mes 7 deberia buscar en que mes finaliza el semestre JULIO=7
                $fech=date("m-d-Y",strtotime("7-1-".$matricula[$i]->semestre->año_fin));
                $fecha=$matricula[$i]->alumno->fecha_n;
                list($Y,$m,$d) = explode("-",$fecha);
                $edad=( date("md", strtotime($fech)) < $m.$d ? date("Y", strtotime($fech))-$Y-1 : date("Y", strtotime($fech))-$Y );
                $meses=7-date("m",strtotime($matricula[$i]->alumno->fecha_n));                
                if($meses<0){
                    $meses=12+$meses;
                }                

                if ($edad == 0) {
                    $document->setValue($le[$a] . "1", "X");
                    $acu[0]++;
                } else {
                    $document->setValue($le[$a] . "1", "*");
                }
                if ($edad ==1) {
                    $document->setValue($le[$a] . "2", "X");
                    $acu[1]++;
                } else {
                    $document->setValue($le[$a] . "2", "*");
                }
                if ($edad == 2) {
                    $document->setValue($le[$a] . "3", "X");
                    $acu[2]++;
                } else {
                    $document->setValue($le[$a] . "3", "*");
                }
                if ($edad == 3) {
                    $document->setValue($le[$a] . "4", "X");
                    $acu[3]++;
                } else {
                    $document->setValue($le[$a] . "4", "*");
                }
                if ($edad == 4) {
                    $document->setValue($le[$a] . "5", "X");
                    $acu[4]++;
                } else {
                    $document->setValue($le[$a] . "5", "*");
                }
                if ($edad == 5) {
                    $document->setValue($le[$a] . "6", "X");
                    $acu[5]++;
                } else {
                    $document->setValue($le[$a] . "6", "*");
                }
                if ($edad >= 6) {
                    $document->setValue($le[$a] . "7", "X");
                    $acu[6]++;
                } else {
                    $document->setValue($le[$a] . "7", "*");
                }
            } else {
                $document->setValue($le[$a] . "1", "*");
                $document->setValue($le[$a] . "2", "*");
                $document->setValue($le[$a] . "3", "*");
                $document->setValue($le[$a] . "4", "*");
                $document->setValue($le[$a] . "5", "*");
                $document->setValue($le[$a] . "6", "*");
                $document->setValue($le[$a] . "7", "*");
            }
            $a++;
        }

        $document->setValue("U1", $acu[0]);
        $document->setValue("U2", $acu[1]);
        $document->setValue("U3", $acu[2]);
        $document->setValue("U4", $acu[3]);
        $document->setValue("U5", $acu[4]);
        $document->setValue("U6", $acu[5]);
        $document->setValue("U7", $acu[6]);

        



        $document->save('protected/extensions/PHPWord/REPORTE.docx');
        $file = 'protected/extensions/PHPWord/REPORTE.docx';
        header('Content-Description: File Transfer');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function actionMatricula() {
        $this->render('matricula');
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'alumno-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}