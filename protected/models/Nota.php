<?php

/**
 * This is the model class for table "nota".
 *
 * The followings are the available columns in table 'nota':
 * @property string $id
 * @property string $matricula_id 
 * @property string $materia_id
 * @property string $calificacion
 * @property string $fecha
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Materia $materia
 * @property Maestro $maestro
 * @property Matricula $matricula
 */
class Nota extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Nota the static model class
     */
    public $nota_temp;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'nota';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('matricula_id, materia_id', 'required'),
            array('matricula_id, materia_id, calificacion,fecha_año', 'length', 'max' => 10),
            array('fecha_mes', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, matricula_id, materia_id, calificacion, fecha_año, fecha_mes', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'materia' => array(self::BELONGS_TO, 'Materia', 'materia_id'),            
            'matricula' => array(self::BELONGS_TO, 'Matricula', 'matricula_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'matricula_id' => 'Matricula',            
            'materia_id' => 'Materia',
            'calificacion' => 'Calificacion',
            'fecha_año' => 'Año',
            'fecha_mes' => 'Mes',
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

        $criteria->compare('id', $this->id, false);
        $criteria->compare('matricula_id', $this->matricula_id, true);        
        $criteria->compare('materia_id', $this->materia_id, true);
        $criteria->compare('calificacion', $this->calificacion, true);
        $criteria->compare('fecha_año', $this->fecha_año, true);
        $criteria->compare('fecha_mes', $this->fecha_mes, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
    
    /*
     *  Transforma la nota de numero a letra 
     */

    public function getEnLetras(){
        switch ($this->calificacion) {
            case 0:
                return "PENDIENTE";
                break;
            case 1:
                return "UNO";
                break;
            case 2:
                return "DOS";
                break;
            case 3:
                return "TRES";
                break;
            case 4:
                return "CUATRO";
                break;
            case 5:
                return "CINCO";
                break;
            case 6:
                return "SEIS";
                break;
            case 7:
                return "SIETE";
                break;
            case 8:
                return "OCHO";
                break;
            case 9:
                return "NUEVE";
                break;
            case 10:
                return "DIEZ";
                break;
            case 11:
                return "ONCE";
                break;
            case 12:
                return "DOCE";
                break;
            case 13:
                return "TRECE";
                break;
            case 14:
                return "CATORCE";
                break;
            case 15:
                return "QUINCE";
                break;
            case 16:
                return "DIECISEIS";
                break;
            case 17:
                return "DIECISIETE";
                break;
            case 18:
                return "DIECIOCHO";
                break;
            case 19:
                return "DIECINUEVE";
                break;
            case 20:
                return "VEINTE";
                break;

            default:                
                break;
        }
    }
    /**
     * Se usa para generar una tabla que agrupe a cada alumno y todas sus notas 
     * de manera que se puedan editar mas facilmente
     * 
     * @param type $notas
     * @return CArrayDataProvider 
     */
    public function vistaTabular($notas) {
        $cant = count($notas);
        $c=1;
        for ($i = 0; $i < $cant; $i++) {            
            $fila["cedula"] = $notas[$i]->matricula->alumno->getCedulaCompleta();
            $fila["nombre"] = $notas[$i]->matricula->alumno->getNombreCompleto();
            $matid = $notas[$i]->matricula_id;
            $count = $notas[$i]->count("matricula_id='$matid'");            
            for ($j = $i; $j < $count*$c; $j++) {                
                $materia = $notas[$j]->materia->asignatura->abreviatura;
                $fila[$materia] = $notas[$j]->calificacion;
            }
            $data[$notas[$i]->matricula_id] = $fila;
            unset($j);
            $i = $i + ($count-1);
            $c++;
        }        
        
        return new CArrayDataProvider($data, array(
            "id" => "matricula",
            'pagination' => array('pageSize' => count($data)),
        ));
    }
    /*
     *  Devuelve el mes en Letras
     */

    public function getNumeroMes(){
        $mes=array("Enero"=>1,"Febrero"=>2,"Marzo"=>3,"Abril"=>4,"Mayo"=>5,"Junio"=>6,"Julio"=>7,
            "Agosto"=>8,"Septiembre"=>9,"Octubre"=>10,"Noviembre"=>11,"Diciembre"=>12);
        return $mes[$this->fecha_mes];
    }

}