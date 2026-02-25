<?php

/**
 * This is the model class for table "{{eval_areas}}".
 *
 * The followings are the available columns in table '{{eval_areas}}':
 * @property integer $id
 * @property string $nombre
 * @property integer $idunidad
 * @property integer $activa
 * @property string $row_date
 */
class EvalAreas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_areas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, idunidad, row_date', 'required'),
			array('idunidad, activa', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, idunidad, activa, row_date', 'safe', 'on'=>'search'),
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
			'idunidad' => 'Idunidad',
			'activa' => 'Activa',
			'row_date' => 'Row Date',
		);
	}

	
	
	function addArea($datos) {
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "INSERT INTO {{eval_areas}} (nombre,idunidad,activa) VALUES(:nombre,:idunidad, :activa)";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR)
		->bindParam(":idunidad", $datos["idunidad"], PDO::PARAM_INT)
														 ->bindParam(":activa", $datos["activa"], PDO::PARAM_INT);
		$result = $command->query();
		if($result) { //Checked
			$id = getLastInsertID($this->tableName()); //Yii::app()->db->Insert_Id(db_table_name_nq('user_groups'),'ugid');
			 
			return $id;
		}
		else
			return -1;

	}
		
	
	function delArea($id) {
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "delete from {{eval_areas}} where id=:id";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $command->query();
	 
		if($result) { //Checked
			 
			return "OK";
		}
		else
			return "NO";

	}
		
	
	function delAreaUnidad($id) {
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "delete from {{eval_areas}} where idunidad=:id";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $command->query();
	 
		if($result) { //Checked
			 
			return "OK";
		}
		else
			return "NO";

	}
		
		
	function updateArea($datos,$id)
    {
		$unidades = EvalAreas::model()->findByPk($id);
		$unidades->nombre=$datos["nombre"];
 		$unidades->idunidad=(int)$datos["idunidad"];
		$unidades->activa=(int)$datos["activa"];
 		$unidades->save();
		if ($unidades->getErrors())
			return false;
		else
			return true;
    }
	
		
	
	function selecArea($id){
		 
		$arr = array();
        $queryString = "
		SELECT 
		id,
		UPPER(nombre) nombre,
		idunidad,
		activa,
		row_date
		FROM {{eval_areas}}
		WHERE activa = 1 and id=".$id."
		ORDER BY nombre
		";
         
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
			$data->idunidad =  $row->idunidad;
			$data->id = $row->id;
			$data->activa =  $row->activa;
			array_push($arr, $data);
		}
 		
 		return $arr;
    }
	
	
	
	function selecAreasActivas($id_unidad=NULL){
		$subq="";
		if($id_unidad>0){
			$subq=" and idunidad=".$id_unidad;	
		}
		$arr = array();
        $queryString = "
		SELECT 
		id,
		UPPER(nombre) nombre,
		idunidad,
		activa,
		row_date
		FROM {{eval_areas}}
		WHERE activa = 1 ".$subq."
		ORDER BY nombre
		";
         
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
			$data->idunidad =  $row->idunidad;
			$data->id = $row->id;
			$data->activa =  $row->activa;
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
		$criteria->compare('idunidad',$this->idunidad);
		$criteria->compare('activa',$this->activa);
		$criteria->compare('row_date',$this->row_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalAreas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
