<?php

/**
 * This is the model class for table "{{menuxmodulo}}".
 *
 * The followings are the available columns in table '{{menuxmodulo}}':
 * @property integer $id
 * @property integer $padreid
 * @property integer $ordenid
 * @property string $titulo
 * @property string $accion
 * @property string $estado
 * @property string $role
 * @property string $fehcaregistro
 * @property string $idorden
 * @property integer $idmodulo
 */
class Menuxmodulo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{menuxmodulo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ordenid', 'required'),
			array('padreid, ordenid, idmodulo', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>255),
			array('estado', 'length', 'max'=>1),
			array('role', 'length', 'max'=>100),
			array('idorden', 'length', 'max'=>11),
			array('accion, fehcaregistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, padreid, ordenid, titulo, accion, estado, role, fehcaregistro, idorden, idmodulo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'padreid' => 'Padreid',
			'ordenid' => 'Ordenid',
			'titulo' => 'Titulo',
			'accion' => 'Accion',
			'estado' => 'Estado',
			'role' => 'Role',
			'fehcaregistro' => 'Fehcaregistro',
			'idorden' => 'Idorden',
			'idmodulo' => 'Idmodulo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('padreid',$this->padreid);
		$criteria->compare('ordenid',$this->ordenid);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('accion',$this->accion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('fehcaregistro',$this->fehcaregistro,true);
		$criteria->compare('idorden',$this->idorden,true);
		$criteria->compare('idmodulo',$this->idmodulo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menuxmodulo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
