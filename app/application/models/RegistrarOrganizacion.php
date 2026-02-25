<?php

/**
 * This is the model class for table "{{registrar_organizacion}}".
 *
 * The followings are the available columns in table '{{registrar_organizacion}}':
 * @property integer $id
 * @property string $nodosreporte
 * @property string $nombre
 * @property string $descripcion
 * @property string $estado
 * @property string $fecharegistro
 * @property string $direccion
 * @property string $ciudad
 * @property string $nit
 * @property string $telefono
 * @property string $fax
 * @property string $representantelegal
 * @property string $docidentidadrep
 * @property string $nombrecontacto
 * @property string $docidentidadcontacto
 * @property string $emailcontacto
 * @property string $actividadeconomica
 * @property integer $idtipoorganizacion
 * @property string $idarea
 * @property string $cargo
 */
class RegistrarOrganizacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{registrar_organizacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtipoorganizacion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('estado', 'length', 'max'=>8),
			array('direccion, ciudad, nit, representantelegal, docidentidadrep, nombrecontacto, docidentidadcontacto, emailcontacto, actividadeconomica, idarea, cargo', 'length', 'max'=>255),
			array('telefono, fax', 'length', 'max'=>100),
			array('nodosreporte, descripcion, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nodosreporte, nombre, descripcion, estado, fecharegistro, direccion, ciudad, nit, telefono, fax, representantelegal, docidentidadrep, nombrecontacto, docidentidadcontacto, emailcontacto, actividadeconomica, idtipoorganizacion, idarea, cargo', 'safe', 'on'=>'search'),
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
			'nodosreporte' => 'Nodosreporte',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'fecharegistro' => 'Fecharegistro',
			'direccion' => 'Direccion',
			'ciudad' => 'Ciudad',
			'nit' => 'Nit',
			'telefono' => 'Telefono',
			'fax' => 'Fax',
			'representantelegal' => 'Representantelegal',
			'docidentidadrep' => 'Docidentidadrep',
			'nombrecontacto' => 'Nombrecontacto',
			'docidentidadcontacto' => 'Docidentidadcontacto',
			'emailcontacto' => 'Emailcontacto',
			'actividadeconomica' => 'Actividadeconomica',
			'idtipoorganizacion' => 'Idtipoorganizacion',
			'idarea' => 'Idarea',
			'cargo' => 'Cargo',
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
		$criteria->compare('nodosreporte',$this->nodosreporte,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('representantelegal',$this->representantelegal,true);
		$criteria->compare('docidentidadrep',$this->docidentidadrep,true);
		$criteria->compare('nombrecontacto',$this->nombrecontacto,true);
		$criteria->compare('docidentidadcontacto',$this->docidentidadcontacto,true);
		$criteria->compare('emailcontacto',$this->emailcontacto,true);
		$criteria->compare('actividadeconomica',$this->actividadeconomica,true);
		$criteria->compare('idtipoorganizacion',$this->idtipoorganizacion);
		$criteria->compare('idarea',$this->idarea,true);
		$criteria->compare('cargo',$this->cargo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrarOrganizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
