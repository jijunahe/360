<?php

/**
 * This is the model class for table "diagnostico".
 *
 * The followings are the available columns in table 'diagnostico':
 * @property integer $id
 * @property string $cluster
 * @property string $sector
 * @property string $ciudad
 * @property string $empresa
 * @property string $nit
 * @property string $telefono
 * @property string $celular
 * @property string $email
 * @property string $representante
 * @property string $nro
 * @property string $item
 * @property string $numeral
 * @property string $aspectos
 * @property double $cumplimiento
 * @property string $total
 * @property string $control
 * @property string $fecharegistro
 * @property string $diac
 * @property string $mesc
 * @property string $anioc
 * @property string $fecha
 */
class Diagnostico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'diagnostico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cumplimiento', 'numerical'),
			array('cluster, sector, ciudad, empresa, item, aspectos', 'length', 'max'=>500),
			array('nit, telefono, celular', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('representante', 'length', 'max'=>255),
			array('nro, anioc', 'length', 'max'=>4),
			array('numeral', 'length', 'max'=>10),
			array('total, fecharegistro, fecha', 'length', 'max'=>11),
			array('control', 'length', 'max'=>1),
			array('diac, mesc', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cluster, sector, ciudad, empresa, nit, telefono, celular, email, representante, nro, item, numeral, aspectos, cumplimiento, total, control, fecharegistro, diac, mesc, anioc, fecha', 'safe', 'on'=>'search'),
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
			'cluster' => 'Cluster',
			'sector' => 'Sector',
			'ciudad' => 'Ciudad',
			'empresa' => 'Empresa',
			'nit' => 'Nit',
			'telefono' => 'Telefono',
			'celular' => 'Celular',
			'email' => 'Email',
			'representante' => 'Representante',
			'nro' => 'Nro',
			'item' => 'Item',
			'numeral' => 'Numeral',
			'aspectos' => 'Aspectos',
			'cumplimiento' => 'Cumplimiento',
			'total' => 'Total',
			'control' => 'Control',
			'fecharegistro' => 'Fecharegistro',
			'diac' => 'Diac',
			'mesc' => 'Mesc',
			'anioc' => 'Anioc',
			'fecha' => 'Fecha',
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
		$criteria->compare('cluster',$this->cluster,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('empresa',$this->empresa,true);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('representante',$this->representante,true);
		$criteria->compare('nro',$this->nro,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('numeral',$this->numeral,true);
		$criteria->compare('aspectos',$this->aspectos,true);
		$criteria->compare('cumplimiento',$this->cumplimiento);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('control',$this->control,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('diac',$this->diac,true);
		$criteria->compare('mesc',$this->mesc,true);
		$criteria->compare('anioc',$this->anioc,true);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Diagnostico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
