<?php

/**
 * This is the model class for table "{{ana_organizacion}}".
 *
 * The followings are the available columns in table '{{ana_organizacion}}':
 * @property integer $id
 * @property string $nombre
 * @property string $nit
 * @property string $estado
 * @property integer $id_ciudad
 * @property integer $id_region
 * @property integer $id_pais
 * @property string $fechacreacion
 * @property integer $idUsuario
 * @property string $telefono
 * @property string $nombrerepresentante
 * @property string $email
 */
class AnaOrganizacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ana_organizacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ciudad, id_region, id_pais, idUsuario', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('nit, nombrerepresentante, email', 'length', 'max'=>100),
			array('estado', 'length', 'max'=>1),
			array('telefono', 'length', 'max'=>50),
			array('fechacreacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, nit, estado, id_ciudad, id_region, id_pais, fechacreacion, idUsuario, telefono, nombrerepresentante, email', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'nit' => 'Nit',
			'estado' => 'Estado',
			'id_ciudad' => 'Id Ciudad',
			'id_region' => 'Id Region',
			'id_pais' => 'Id Pais',
			'fechacreacion' => 'Fechacreacion',
			'idUsuario' => 'Id Usuario',
			'telefono' => 'Telefono',
			'nombrerepresentante' => 'Nombrerepresentante',
			'email' => 'Email',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('id_ciudad',$this->id_ciudad);
		$criteria->compare('id_region',$this->id_region);
		$criteria->compare('id_pais',$this->id_pais);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('nombrerepresentante',$this->nombrerepresentante,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnaOrganizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
