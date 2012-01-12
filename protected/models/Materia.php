<?php

/**
 * This is the model class for table "materia".
 *
 * The followings are the available columns in table 'materia':
 * @property string $id
 * @property string $asignatura_id
 * @property string $grado_id
 *
 * The followings are the available model relations:
 * @property Grado $grado
 * @property Asignatura $asignatura
 * @property Nota[] $notas
 */
class Materia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Materia the static model class
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
		return 'materia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asignatura_id, grado_id', 'required'),
			array('asignatura_id, grado_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asignatura_id, grado_id', 'safe', 'on'=>'search'),
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
			'grado' => array(self::BELONGS_TO, 'Grado', 'grado_id'),
			'asignatura' => array(self::BELONGS_TO, 'Asignatura', 'asignatura_id'),			
                        'cursos' => array(self::HAS_MANY, 'Curso', 'materia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'asignatura_id' => 'Asignatura',
			'grado_id' => 'Grado',
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
		$criteria->compare('asignatura_id',$this->asignatura_id,true);
		$criteria->compare('grado_id',$this->grado_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}