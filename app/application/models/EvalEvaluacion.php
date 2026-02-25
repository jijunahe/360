<?php

/**
 * This is the model class for table "{{eval_evaluacion}}".
 *
 * The followings are the available columns in table '{{eval_evaluacion}}':
 * @property integer $id
 * @property integer $idus
 * @property integer $idorg
 * @property string $tipoeval
 * @property string $estado
 * @property string $vistaverificacion
 * @property string $vistaseguimiento
 * @property string $vistaadicional
 * @property string $fecha
 * @property string $nombreempresa
 * @property string $direccionempresa
 * @property string $ciudaddepartamento
 * @property string $nit
 * @property string $telefono
 * @property string $fax
 * @property string $representantelegal
 * @property string $docrepresentante
 * @property string $nombrecontacto
 * @property string $doccontacto
 * @property string $emailcontacto
 * @property string $actividadeconomica
 * @property string $fecharegistro
 * @property string $fechaactualizacion
 * @property string $alcance
 * @property string $jsonsut
 * @property string $jsonequipo
 */
class EvalEvaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_evaluacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idus, idorg', 'numerical', 'integerOnly'=>true),
			array('tipoeval, emailcontacto', 'length', 'max'=>100),
			array('estado, vistaverificacion, vistaseguimiento, vistaadicional', 'length', 'max'=>1),
			array('nombreempresa, representantelegal, nombrecontacto', 'length', 'max'=>500),
			array('direccionempresa, ciudaddepartamento, fax, actividadeconomica', 'length', 'max'=>255),
			array('nit, docrepresentante, doccontacto', 'length', 'max'=>50),
			array('telefono', 'length', 'max'=>20),
			array('fecha, fecharegistro, fechaactualizacion, alcance, jsonsut, jsonequipo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idus, idorg, tipoeval, estado, vistaverificacion, vistaseguimiento, vistaadicional, fecha, nombreempresa, direccionempresa, ciudaddepartamento, nit, telefono, fax, representantelegal, docrepresentante, nombrecontacto, doccontacto, emailcontacto, actividadeconomica, fecharegistro, fechaactualizacion, alcance, jsonsut, jsonequipo', 'safe', 'on'=>'search'),
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
			'idus' => 'Idus',
			'idorg' => 'Idorg',
			'tipoeval' => 'Tipoeval',
			'estado' => 'Estado',
			'vistaverificacion' => 'Visita de verificación',
			'vistaseguimiento' => 'Visitade seguimiento',
			'vistaadicional' => 'Visita adicional',
			'fecha' => 'Fecha',
			'nombreempresa' => 'Nombre de la empresa',
			'direccionempresa' => 'Dirección de la empresa',
			'ciudaddepartamento' => 'Ciudad y Departamento',
			'nit' => 'Nit',
			'telefono' => 'Teléfono de contacto',
			'fax' => 'Fax',
			'representantelegal' => 'Representante legal',
			'docrepresentante' => 'Doc. ident',
			'nombrecontacto' => 'Nombre contacto',
			'doccontacto' => 'Doc. ident',
			'emailcontacto' => 'e-mail contacto',
			'actividadeconomica' => 'Actividad económica',
			'fecharegistro' => 'Fecharegistro',
			'fechaactualizacion' => 'Fechaactualizacion',
			'alcance' => 'Alcance del programa',
			'jsonsut' => 'jsonsut',
			'jsonequipo' => 'equipo',
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
		$criteria->compare('idus',$this->idus);
		$criteria->compare('idorg',$this->idorg);
		$criteria->compare('tipoeval',$this->tipoeval,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('vistaverificacion',$this->vistaverificacion,true);
		$criteria->compare('vistaseguimiento',$this->vistaseguimiento,true);
		$criteria->compare('vistaadicional',$this->vistaadicional,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('nombreempresa',$this->nombreempresa,true);
		$criteria->compare('direccionempresa',$this->direccionempresa,true);
		$criteria->compare('ciudaddepartamento',$this->ciudaddepartamento,true);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('representantelegal',$this->representantelegal,true);
		$criteria->compare('docrepresentante',$this->docrepresentante,true);
		$criteria->compare('nombrecontacto',$this->nombrecontacto,true);
		$criteria->compare('doccontacto',$this->doccontacto,true);
		$criteria->compare('emailcontacto',$this->emailcontacto,true);
		$criteria->compare('actividadeconomica',$this->actividadeconomica,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);
		$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);
		$criteria->compare('alcance',$this->alcance,true);
		$criteria->compare('jsonsut',$this->jsonsut,true);
		$criteria->compare('jsonequipo',$this->jsonequipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalEvaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
