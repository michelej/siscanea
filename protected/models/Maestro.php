<?php

/**
 * This is the model class for table "maestro".
 *
 * The followings are the available columns in table 'maestro':
 * @property string $id
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 *
 * The followings are the available model relations:
 * @property Nota[] $notas
 */
class Maestro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Maestro the static model class
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
		return 'maestro';
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
                        array('estado', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nacionalidad, cedula, nombre, apellidos, telefono,estado', 'safe', 'on'=>'search'),
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
			'cursos' => array(self::HAS_MANY, 'Curso', 'maestro_id'),
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
                        'estado' => 'Estado',
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
                $criteria->compare('estado',$this->estado,true);
                $criteria->addCondition('id>1');
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Nombre Completo
         */

        public function getNombreCompleto(){
                return $this->apellidos.' '.$this->nombre;
        }
        /*
         *  Cedula Formato V-123456
         */

        public function getCedulaCompleta(){
                return $this->nacionalidad.''.$this->cedula;
        }
}