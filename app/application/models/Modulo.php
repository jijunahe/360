<?php

/**
 * This is the model class for table "{{modulo}}".
 *
 * The followings are the available columns in table '{{modulo}}':
 * @property integer $id
 * @property string $jnodos
 * @property string $jsids
 * @property string $jmodelos
 * @property string $jcontroladores
 * @property string $jvistas
 * @property string $jscripts
 * @property string $jmenus
 * @property string $proyecto
 * @property string $descripcion
 * @property string $estado
 * @property integer $idtipomodulo
 * @property string $fecharegistro
 */
class Modulo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{modulo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtipomodulo', 'numerical', 'integerOnly'=>true),
			array('jnodos, jmodelos, jcontroladores, jvistas, jscripts, jmenus, proyecto, descripcion', 'length', 'max'=>255),
			array('estado', 'length', 'max'=>1),
			array('jsids, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,tipo, jnodos, jsids, jmodelos, jcontroladores, jvistas, jscripts, jmenus, proyecto, descripcion, estado, idtipomodulo, fecharegistro', 'safe', 'on'=>'search'),
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
			'jnodos' => 'Jnodos',
			'tipo' => 'Tipo',
			'jsids' => 'Jsids',
			'jmodelos' => 'Jmodelos',
			'jcontroladores' => 'Jcontroladores',
			'jvistas' => 'Jvistas',
			'jscripts' => 'Jscripts',
			'jmenus' => 'Jmenus',
			'proyecto' => 'Proyecto',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'idtipomodulo' => 'Idtipomodulo',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('jnodos',$this->jnodos,true);
		$criteria->compare('jsids',$this->jsids,true);
		$criteria->compare('jmodelos',$this->jmodelos,true);
		$criteria->compare('jcontroladores',$this->jcontroladores,true);
		$criteria->compare('jvistas',$this->jvistas,true);
		$criteria->compare('jscripts',$this->jscripts,true);
		$criteria->compare('jmenus',$this->jmenus,true);
		$criteria->compare('proyecto',$this->proyecto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('idtipomodulo',$this->idtipomodulo);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modulo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
