<?php

/**
 * This is the model class for table "{{eval_perfiles}}".
 *
 * The followings are the available columns in table '{{eval_perfiles}}':
 * @property integer $id
 * @property string $nombre
 * @property integer $activo
 */
class EvalPerfiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_perfiles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, activo', 'required'),
			array('activo', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, activo', 'safe', 'on'=>'search'),
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
			'activo' => 'Activo',
		);
	}
	
	function selecPerfilesActivos(){
	
		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);	
		$subq="";
		//RESTRINGE LOS PERFILES A MOSTRAR
		if(isset($dUsuario->perfil)  ){
			if($dUsuario->perfil==3){
				$subq=" and id in (2,4)";
			}
			if($dUsuario->perfil==1){
				$subq=" and id in (1,2,3,4)";
			}
			if($dUsuario->perfil==2 or $dUsuario->perfil==4){
				$subq=" and id in (-1)";
			}
 		}
	
		$arr = array();
        $queryString = "
		SELECT 
		id,
		UPPER(nombre) nombre,
		activo
		FROM {{eval_perfiles}}
		WHERE activo = 1 ".$subq."
		ORDER BY nombre
		";
    	$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
			$data->id = $row->id;
			$data->descripcion =  utf8_encode($row->descripcion);
			$data->activo =  $row->activo;
			array_push($arr, $data);
		}
		return $arr;
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
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalPerfiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
