<?php

/**
 * This is the model class for table "curso".
 *
 * The followings are the available columns in table 'curso':
 * @property string $id
 * @property string $materia_id
 * @property string $semestre_id
 * @property string $maestro_id
 *
 * The followings are the available model relations:
 * @property Maestro $maestro
 * @property Semestre $semestre
 * @property Materia $materia
 */
class Curso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Curso the static model class
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
		return 'curso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materia_id, semestre_id, maestro_id', 'required'),
			array('materia_id, semestre_id, maestro_id,seccion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, materia_id, semestre_id, maestro_id,seccion', 'safe', 'on'=>'search'),
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
			'maestro' => array(self::BELONGS_TO, 'Maestro', 'maestro_id'),
			'semestre' => array(self::BELONGS_TO, 'Semestre', 'semestre_id'),
			'materia' => array(self::BELONGS_TO, 'Materia', 'materia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'materia_id' => 'Materia',
			'semestre_id' => 'Semestre',
			'maestro_id' => 'Maestro',
                        'seccion' => 'Seccion',

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
		$criteria->compare('materia_id',$this->materia_id,true);
                $criteria->compare('seccion',$this->seccion,true);
		$criteria->compare('semestre_id',$this->semestre_id,true);
		$criteria->compare('maestro_id',$this->maestro_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}