<?php

/**
 * This is the model class for table "{{ana_monedaxusuario}}".
 *
 * The followings are the available columns in table '{{ana_monedaxusuario}}':
 * @property string $id
 * @property string $idMoneda
 * @property string $idMonedaunitaria
 * @property integer $idUsuario
 * @property string $fecharegistro
 */
class AnaMonedaxusuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_monedaxusuario}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario', 'numerical', 'integerOnly'=>true),
			array('idMoneda, idMonedaunitaria', 'length', 'max'=>11),
			array('fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idMoneda, idMonedaunitaria, idUsuario, fecharegistro', 'safe', 'on'=>'search'),
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
			'idMoneda' => 'Id Moneda',
			'idMonedaunitaria' => 'Id Monedaunitaria',
			'idUsuario' => 'Id Usuario',
			'fecharegistro' => 'Fecharegistro',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idMoneda',$this->idMoneda,true);
		$criteria->compare('idMonedaunitaria',$this->idMonedaunitaria,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaMonedaxusuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
