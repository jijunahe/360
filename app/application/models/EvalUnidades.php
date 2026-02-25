<?php

/**
 * This is the model class for table "{{eval_unidades}}".
 *
 * The followings are the available columns in table '{{eval_unidades}}':
 * @property integer $id
 * @property string $nombre
 * @property string $codigo
 * @property string $empresa
 * @property integer $activa
 * @property string $row_date
 */
class EvalUnidades extends CActiveRecord
{

 	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_unidades}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, codigo, empresa, activa', 'required'),
			array('activa', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('codigo', 'length', 'max'=>50),
			array('empresa', 'length', 'max'=>300),
			array('nodosreporte', 'length', 'max'=>500),
			array('row_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, codigo, empresa, activa,nodosreporte, row_date', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'empresa' => 'Empresa',
			'activa' => 'Activa',
			'nodosreporte' => 'Nodos Reporte',
			'row_date' => 'Row Date',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('empresa',$this->empresa,true);
		$criteria->compare('nodosreporte',$this->nodosreporte,true);
		$criteria->compare('activa',$this->activa);
		$criteria->compare('row_date',$this->row_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	function addUnidad($datos) {
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "INSERT INTO {{eval_unidades}} (nombre,codigo,empresa,nodosreporte,activa) VALUES(:nombre, :codigo, :empresa, :activa)";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR)
														 ->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR)
														 ->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR)
														 ->bindParam(":nodosreporte", $datos["nodosreporte"], PDO::PARAM_STR)
														 ->bindParam(":activa", $datos["activa"], PDO::PARAM_INT);
		$result = $command->query();
		if($result) { //Checked
			$id = getLastInsertID($this->tableName()); //Yii::app()->db->Insert_Id(db_table_name_nq('user_groups'),'ugid');
			 
			return $id;
		}
		else
			return -1;

	}
	function findAllunidades($un){
		$subq="";
		if($un=="all"){
			$subq=' id>0';
		}else if(count($un)>0){
			$subq='id in ('.join(",",$un).')';
 		}
		if($subq!=""){
			$dat = new CDbCriteria;
			$dat->condition =$subq;
			$unidades = EvalUnidades::model()->findAll($dat);
		}else{
			$unidades=NULL;
		}
 		return $unidades;
 	}	

	
	function updateUnidad($datos,$id)
    {
		$unidades = EvalUnidades::model()->findByPk($id);
		$unidades->nombre=$datos["nombre"];
		$unidades->codigo=$datos["codigo"];
		$unidades->empresa=$datos["empresa"];
		$unidades->nodosreporte=$datos["nodosreporte"];
		$unidades->activa=$datos["activa"];
 		$unidades->save();
		if ($unidades->getErrors())
			return false;
		else
			return true;
    }
	
	function selecUnidadesActivas($id=NULL){
		$sq="";
		if($id>0){$sq=" and id=".$id;}
		$arr = array();
        $queryString = "
		SELECT 
		id,
		UPPER(nombre) nombre,
		codigo,
		UPPER(empresa) empresa,
		nodosreporte,
		activa,
		row_date
		FROM {{eval_unidades}}
		WHERE activa = 1 ".$sq."
		ORDER BY nombre
		";
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
			$data->id = $row->id;
			$data->codigo = $row->codigo;
			$data->nodosreporte =  utf8_encode($row->nodosreporte);
			$data->empresa =  utf8_encode($row->empresa);
			$data->activa =  $row->activa;
			array_push($arr, $data);
		}
 		
		return $arr;		
    }
		
	
 	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalUnidades the static model class
	 */
 
    public static function model($class = __CLASS__)
    {
        return parent::model($class);
    }	
}
