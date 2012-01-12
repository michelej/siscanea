<?php

/**
 * This is the model class for table "representante".
 *
 * The followings are the available columns in table 'representante':
 * @property string $id
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 *
 * The followings are the available model relations:
 * @property Alumno[] $alumnos
 */
class Representante extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Representante the static model class
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
		return 'representante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nacionalidad, cedula, nombre, apellidos', 'required'),
			array('nacionalidad', 'length', 'max'=>2),
			array('cedula', 'length', 'max'=>20),
                        array('cedula', 'numerical'),
			array('nombre', 'length', 'max'=>45),
			array('apellidos', 'length', 'max'=>40),
			array('telefono', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nacionalidad, cedula, nombre, apellidos, telefono', 'safe', 'on'=>'search'),
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
			'alumnos' => array(self::HAS_MANY, 'Alumno', 'representante_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nacionalidad' => 'N',
			'cedula' => 'Cedula',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'telefono' => 'Telefono',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('telefono',$this->telefono,true);
                $criteria->addCondition('id>1');
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        // Los alumnos de este representante
        public function listado_Alumnos(){
                return new CArrayDataProvider($this->alumnos, array('id'=>'id',));
        }
        /*
         *  Nombre Completo del representante
         */

        public function getNombreCompleto(){
                return $this->apellidos.' '.$this->nombre;
        }
        /*
         *  Cedula en formato V-2123456
         */

        public function getCedulaCompleta(){
                return $this->nacionalidad.''.$this->cedula;
        }
        /*
         * Verifico si este representante ya existe en la BD, solo se verifica
         * si existe la cedula
         */              
        public function repExiste(){
                 return $this->exists('nacionalidad = :nacionalidad AND cedula = :cedula',
                   array(':cedula'=>$this->cedula,':nacionalidad'=>$this->nacionalidad));
        }
        /*public function repExiste(){
                 return $this->exists('nacionalidad = :nacionalidad AND cedula = :cedula OR nombre = :nombre OR apellidos = :apellidos',
                   array(':cedula'=>$this->cedula,':nombre'=>$this->nombre,':apellidos'=>$this->apellidos,':nacionalidad'=>$this->nacionalidad));
        }*/

}