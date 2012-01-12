<?php

/**
 * This is the model class for table "alumno".
 *
 * The followings are the available columns in table 'alumno':
 * @property string $id
 * @property string $representante_id
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $apellidos
 * @property string $nombre
 * @property string $sexo
 * @property string $fecha_n
 * @property string $lugar_n
 * @property string $observaciones
 * @property string $retirado
 * @property string $entidad_federal
 *
 * The followings are the available model relations:
 * @property Representante $representante
 * @property Matricula[] $matriculas
 */
class Alumno extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Alumno the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alumno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('representante_id, nacionalidad, cedula, apellidos, nombre, sexo, fecha_n, retirado', 'required'),
			array('representante_id', 'length', 'max'=>10),
			array('nacionalidad, retirado', 'length', 'max'=>2),
			array('cedula', 'length', 'max'=>25),
                        array('cedula', 'numerical'),
			array('apellidos', 'length', 'max'=>40),
			array('nombre, lugar_n', 'length', 'max'=>45),
                        array('fecha_n','date','format'=>'yyyy-mm-dd','message'=>'Seleccione la fecha del Calendario'),
			array('sexo', 'length', 'max'=>1),
			array('observaciones', 'length', 'max'=>60),
			array('entidad_federal', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, representante_id, nacionalidad, cedula, apellidos, nombre, sexo, fecha_n, lugar_n, observaciones, retirado, entidad_federal', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'representante' => array(self::BELONGS_TO, 'Representante', 'representante_id'),
			'matriculas' => array(self::HAS_MANY, 'Matricula', 'alumno_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'representante_id' => 'Representante',
			'nacionalidad' => 'N',
			'cedula' => 'Cedula',
			'apellidos' => 'Apellidos',
			'nombre' => 'Nombres',
			'sexo' => 'Sexo',
			'fecha_n' => 'Fecha Nacimiento',
			'lugar_n' => 'Lugar Nacimiento',
			'observaciones' => 'Observaciones',
			'retirado' => 'Retirado',
			'entidad_federal' => 'Entidad Federal',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                
		$criteria->compare('id',$this->id);
		$criteria->compare('representante_id',$this->representante_id,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('fecha_n',$this->fecha_n,true);
		$criteria->compare('lugar_n',$this->lugar_n,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('retirado',$this->retirado,true);
		$criteria->compare('entidad_federal',$this->entidad_federal,true);
                $criteria->order='ABS (cedula)';

                //$criteria->addInCondition("id", $this->id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>'40',
                        ),
		));
	}

        public function searchIds()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                
                $criteria->compare('nacionalidad',$this->nacionalidad,true);
                $criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->addInCondition("id", $this->id);		

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>'10',
                        ),
		));
	}     
        /*
         *  Nombre Completo del Alumno         
         */
        public function getNombreCompleto(){
                return $this->apellidos.' '.$this->nombre;
        }
        /*
         *  Cedula del Alumno en formato V-123456
         */        
        public function getCedulaCompleta(){
                return $this->nacionalidad.''.$this->cedula;
        }
        /*
         *  Calculamos la Edad del Alumno
         */
        public function getEdad(){
                $fecha=$this->fecha_n;
                list($Y,$m,$d) = explode("-",$fecha);
                return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );                
        }
        /*
         *   El sexo del Alumno en formato Masculino / Femenino 
         */
        public function getSexo(){
                if($this->sexo=="M"){
                    return "Masculino";
                }else{
                    return "Femenino";
                }
        }
}