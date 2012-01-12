<?php

/**
 * This is the model class for table "asignatura".
 *
 * The followings are the available columns in table 'asignatura':
 * @property string $id
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Materia[] $materias
 */
class Asignatura extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Asignatura the static model class
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
		return 'asignatura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion', 'required'),
			array('descripcion', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, descripcion', 'safe', 'on'=>'search'),
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
			'materias' => array(self::HAS_MANY, 'Materia', 'asignatura_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Un hack para poder abreviar un poco algunas de las materias y que asi se ajusten 
         * mejor a las tablas
         */

        public function getNombre(){
            if(strlen($this->descripcion)>26){
                $orig=array("Educacion","Instruccion","economica","Venezuela");
                $resu=array("Educ.","Instruc.","Eco.","Vnzl");
                return str_replace($orig, $resu, $this->descripcion);
            }else{
                return $this->descripcion;
            }
        }        
}