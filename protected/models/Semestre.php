<?php

/**
 * This is the model class for table "semestre".
 *
 * The followings are the available columns in table 'semestre':
 * @property string $id
 * @property string $temporada
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $año_inicio
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Matricula[] $matriculas
 */
class Semestre extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Semestre the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'semestre';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('año_inicio,año_fin', 'length', 'max' => 10),
            array('mes_inicio,mes_fin', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, año_inicio, año_fin,mes_inicio,mes_fin', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'matriculas' => array(self::HAS_MANY, 'Matricula', 'semestre_id'),
            'cursos' => array(self::HAS_MANY, 'Curso', 'semestre_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'año_inicio' => 'Año de Inicio',
            'mes_inicio' => 'Mes de Inicio',
            'año_fin' => 'Año de Finalizacion',
            'mes_fin' => 'Mes de Finalizacion',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('año_inicio', $this->año_inicio, true);
        $criteria->compare('año_fin', $this->año_fin, true);
        $criteria->compare('mes_inicio', $this->mes_inicio, true);
        $criteria->compare('mes_fin', $this->mes_fin, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
    /**
     *  Genera un listado de los alumnos que no se encuentran actualmente matriculados a
     *  este año escolar
     */
    
    public function listado_Alumnos() {
        $sql = 'SELECT DISTINCT id FROM alumno
              LEFT JOIN (SELECT alumno_id, grado_id, semestre_id, seccion FROM matricula WHERE semestre_id =  ' . $this->id . ') AS matri
              ON alumno.id=matri.alumno_id WHERE matri.alumno_id IS NULL';
        $alumnos_id = CHtml::listData(Yii::app()->db->createCommand($sql)->query(), 'id', 'id');

        $alumno = new Alumno();
        $alumno->id = $alumnos_id;

        return $alumno;        
    }
    /**
     * Genera estadisticas de la cantidad de alumnos que se encuentran matriculados
     * en este año escolar y los agrupo por grado y seccion, NO SE USA
     */
    
    public function estadisticas_Alumnos() {
        $sql = 'SELECT id,nombre,seccion, COUNT( grado_id ) as cantidad FROM (SELECT grado.id, grado.nombre,
           matricula.grado_id, matricula.seccion, matricula.semestre_id FROM grado
           LEFT JOIN matricula ON matricula.grado_id = grado.id
           AND matricula.semestre_id ="' . $this->id . '") as tabla GROUP BY id,seccion';


        // 33 hack 3 seccion * 11 grados
        $dataProvider = new CSqlDataProvider($sql, array(
                    'totalItemCount' => 33,
                    'pagination' => array(
                        'pageSize' => 33,
                    ),
                ));
        return $dataProvider;
    }
    
    /**
     * Genera estadisticas de la cantidad de alumnos que se encuentran matriculados
     * en este año escolar de los grados 1 al 6
     */

    public function estadisticas_AlumnosPrimaria() {
        $sql = 'SELECT id,nombre,seccion, COUNT( grado_id ) as cantidad FROM (SELECT grado.id, grado.nombre,
           matricula.grado_id, matricula.seccion, matricula.semestre_id FROM grado
           LEFT JOIN matricula ON matricula.grado_id = grado.id
           AND matricula.semestre_id ="' . $this->id . '") as tabla WHERE id IN (1,2,3,4,5,6) GROUP BY id,seccion';


        // 33 hack 3 seccion * 11 grados
        $dataProvider = new CSqlDataProvider($sql, array(
                    'totalItemCount' => 33,
                    'pagination' => array(
                        'pageSize' => 33,
                    ),
                ));
        return $dataProvider;
    }
    /**
     * Genera estadisticas de la cantidad de alumnos que se encuentran matriculados
     * en este año escolar de los grados 7 a 11 (7,8,9,4,5)
     */    

    public function estadisticas_AlumnosSecundaria() {
        $sql = 'SELECT id,nombre,seccion, COUNT( grado_id ) as cantidad FROM (SELECT grado.id, grado.nombre,
           matricula.grado_id, matricula.seccion, matricula.semestre_id FROM grado
           LEFT JOIN matricula ON matricula.grado_id = grado.id
           AND matricula.semestre_id ="' . $this->id . '") as tabla WHERE id IN (7,8,9,10,11) GROUP BY id,seccion';


        // 33 hack 3 seccion * 11 grados
        $dataProvider = new CSqlDataProvider($sql, array(
                    'totalItemCount' => 33,
                    'pagination' => array(
                        'pageSize' => 33,
                    ),
                ));
        return $dataProvider;
    }
    /**
     * Genera estadisticas de la cantidad de alumnos que se encuentran matriculados
     * en este año escolar de los grados 12 (preescolar)
     */

    public function estadisticas_AlumnosPreescolar() {
        $sql = 'SELECT id,nombre,seccion, COUNT( grado_id ) as cantidad FROM (SELECT grado.id, grado.nombre,
           matricula.grado_id, matricula.seccion, matricula.semestre_id FROM grado
           LEFT JOIN matricula ON matricula.grado_id = grado.id
           AND matricula.semestre_id ="' . $this->id . '") as tabla WHERE id=12 GROUP BY id,seccion';


        // 33 hack 3 seccion * 11 grados
        $dataProvider = new CSqlDataProvider($sql, array(
                    'totalItemCount' => 33,
                    'pagination' => array(
                        'pageSize' => 33,
                    ),
                ));
        return $dataProvider;
    }
    
    /**
     *  Se usa para mostrar el rango de años desde el actual +-15 años, para el
     *  momento de crear un nuevo semestre
     */

    public static function getAños() {
        $actual = date("Y");
        $inicio = $actual - 15;
        for ($i = 0; $i < 15 * 2; $i++) {
            $años[$inicio + $i] = $inicio + $i;
        }
        return $años;
    }
    /**
     *  array con los Meses del año
     * 
     */

    public static function getMeses() {
        return array("Enero" => "Enero", "Febrero" => "Febrero", "Marzo" => "Marzo", "Abril" => "Abril",
            "Mayo" => "Mayo", "Junio" => "Junio", "Julio" => "Julio", "Agosto" => "Agosto", "Septiembre" => "Septiembre",
            "Octubre" => "Octubre", "Noviembre" => "Noviembre", "Diciembre" => "Diciembre");
    }
    
    /**
     *  Concatena el mes y el año para formar una fecha
     * 
     */

    public function getFechaInicio() {
        return $this->mes_inicio . ' ' . $this->año_inicio;
    }
    
    /**
     *  Concatena el mes y el año para formar una fecha
     * 
     */

    public function getFechaFin() {
        return $this->mes_fin . ' ' . $this->año_fin;
    }
    
    /**
     *  Concatena dos años para formar una temporada , los años escolares se 
     *  describen en temporadas 
     */

    public function getTemporada() {
        return $this->año_inicio . ' - ' . $this->año_fin;
    }

}