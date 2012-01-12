<?php

/**
 * This is the model class for table "matricula".
 *
 * The followings are the available columns in table 'matricula':
 * @property string $id
 * @property string $grado_id
 * @property string $alumno_id
 * @property string $semestre_id
 * @property string $seccion
 *
 * The followings are the available model relations:
 * @property Semestre $semestre
 * @property Alumno $alumno
 * @property Grado $grado
 * @property Nota[] $notas
 */
class Matricula extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Matricula the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'matricula';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('grado_id, alumno_id, semestre_id, seccion', 'required'),
            array('grado_id, alumno_id, semestre_id, seccion', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, grado_id, alumno_id, semestre_id, seccion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'semestre' => array(self::BELONGS_TO, 'Semestre', 'semestre_id'),
            'alumno' => array(self::BELONGS_TO, 'Alumno', 'alumno_id'),
            'grado' => array(self::BELONGS_TO, 'Grado', 'grado_id'),
            'notas' => array(self::HAS_MANY, 'Nota', 'matricula_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'grado_id' => 'Grado',
            'alumno_id' => 'Alumno',
            'semestre_id' => 'Semestre',
            'seccion' => 'Seccion',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('grado_id', $this->grado_id);
        $criteria->compare('alumno_id', $this->alumno_id);
        $criteria->compare('semestre_id', $this->semestre_id);
        $criteria->compare('seccion', $this->seccion);
        $criteria->with='alumno';
        $criteria->order='ABS (cedula)';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }    
    /*
     *  Aqui verificamos que exista la cantidad correcta de notas, depende de la tabla
     *  Materia la cual contiene pares de grado y asignatura
     */
    
    public function verificarNotas() {
        if (empty($this->notas)) {
            return false;
        } else {
            $materias = CHtml::listData(Materia::model()->findAllByAttributes(array('grado_id' => $this->grado_id)), "id", "id");
            foreach ($this->notas as $nota) {
                $verificar[$nota->materia_id] = $nota->materia_id;
            }
            $diff = array_diff($materias, $verificar);
            if (!empty($diff)) {
                return false;
            } else {
                return true;
            }
        }
    }
    /*
     *   Se usa en conjunto con verificarNotas en dado caso que se encuentre algun error     *  
     */

    public function procesarNotas() {
        if (empty($this->notas)) {
            $this->crearNotas();
        } else {
            $this->eliminarNotas();
            $this->crearNotas();
        }
    }
    
    /**
     *  Eliminamos todas las notas
     */

    public function eliminarNotas() {
        foreach ($this->notas as $nota) {
            $nota->delete();
        }
    }
    /**
     *  Creamos las notas de acuerdo a la tabla de Materia
     */

    public function crearNotas() {
        $materias = Materia::model()->findAllByAttributes(array('grado_id' => $this->grado_id));
        foreach ($materias as $val) {
            $nota = new Nota;
            $nota->matricula_id = $this->id;            
            $nota->materia_id = $val->id;
            $nota->calificacion = 0;
            $nota->fecha_mes=$this->semestre->mes_fin;
            $nota->fecha_año=$this->semestre->año_fin;
            $nota->save();
        }
    }

}