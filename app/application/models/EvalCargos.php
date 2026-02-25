<?php

/**
 * This is the model class for table "{{eval_cargos}}".
 *
 * The followings are the available columns in table '{{eval_cargos}}':
 * @property integer $id
 * @property string $empresa
 * @property string $nombre
 * @property string $descripcion
 * @property integer $activo
 * @property integer $id_nivel
 * @property integer $unidad
 * @property integer $area
 * @property integer $proyecto
 * @property string $pais
 * @property string $row_date
 */
class EvalCargos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_cargos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('empresa, nombre, descripcion, activo, id_nivel, unidad, area, proyecto, pais, row_date', 'required'),
			array('activo, id_nivel, unidad, area, proyecto, sid', 'numerical', 'integerOnly'=>true),
			array('empresa, nombre, pais', 'length', 'max'=>100),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, empresa, nombre, descripcion, activo, id_nivel, unidad, area, proyecto, pais, row_date, sid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	 

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'empresa' => 'Empresa',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'activo' => 'Activo',
			'id_nivel' => 'Id Nivel',
			'unidad' => 'Unidad',
			'area' => 'Area',
			'proyecto' => 'Proyecto',
			'pais' => 'Pais',
			'row_date' => 'Row Date',
			'sid' => 'Id Encuesta',
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
		$criteria->compare('empresa',$this->empresa,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('id_nivel',$this->id_nivel);
		$criteria->compare('unidad',$this->unidad);
		$criteria->compare('area',$this->area);
		$criteria->compare('proyecto',$this->proyecto);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('row_date',$this->row_date,true);
		$criteria->compare('sid',$this->sid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function primaryKey()
	{
		return 'id';
	}
	
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Niveles' => array(self::HAS_MANY, 'Nivel','id')
        );
    }
	
	
  	function addCargo($datos) {
		$iLoginID=intval(Yii::app()->session['loginID']);
  		$queryString = sprintf("INSERT INTO {{eval_cargos}} (empresa,nombre,descripcion,activo,id_nivel, unidad, area, proyecto, pais) VALUES (:empresa,:nombre,:descripcion,:activo,:id_nivel, :unidad, :area, :proyecto, :pais)");
 		
		$command = Yii::app()->db->createCommand($queryString)
														 ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR)
 														 ->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR)
 														 ->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR)
 														 ->bindParam(":unidad", $datos["unidad"], PDO::PARAM_INT)
 														 ->bindParam(":area", $datos["area"], PDO::PARAM_STR)
 														 ->bindParam(":proyecto", $datos["proyecto"], PDO::PARAM_STR)
 														 ->bindParam(":pais", $datos["pais"], PDO::PARAM_STR)
 														 ->bindParam(":activo", $datos["activo"], PDO::PARAM_INT)
 														 ->bindParam(":id_nivel", $datos["id_nivel"], PDO::PARAM_INT);
		$result = $command->query();
		if($result) { //Checked
			$id = getLastInsertID($this->tableName()); 
			 
			return $id;
		}
		else
			return -1;

	}
	
	
	function updateCargos($datos,$id)
    {
		$unidades = EvalCargos::model()->findByPk($id); 
		$unidades->nombre=$datos["nombre"];
 		$unidades->empresa=$datos["empresa"];
		$unidades->pais=$datos["pais"];
		$unidades->descripcion=$datos["descripcion"];
		$unidades->unidad=$datos["unidad"];
		$unidades->area=$datos["area"];
		$unidades->proyecto=$datos["proyecto"];
 		
 		$unidades->save(); 
		if ($unidades->getErrors())
			return "NO";
		else
			return "OK";
    }
	
	function delCargo($id) {
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "delete from {{eval_cargos}} where id=:id";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $command->query();
	 
		if($result) { //Checked
			 
			return "OK";
		}
		else
			return "NO";

	}	
	
	function delCargoUnidad($id) {
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "delete from {{eval_cargos}} where unidad=:id";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $command->query();
	 
		if($result) { //Checked
			 
			return "OK";
		}
		else
			return "NO";

	}	
	
	function delCargoArea($id) {
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		
		$iquery = "delete from {{eval_cargos}} where area=:id";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $command->query();
	 
		if($result) { //Checked
			 
			return "OK";
		}
		else
			return "NO";

	}	
	
	
	function selecCargo($id){
		 		
		$arr = array();
        $queryString = "
		SELECT 
		c.id,
 		UPPER(c.nombre) nombre,
 		c.activo
  		FROM {{eval_cargos}} c
		WHERE c.activo = 1
		AND c.id=".$id."
 		";
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
 			$data->id = $row->id;
			$data->activo = $row->activo;
 			array_push($arr, $data);
		}
 		
		return $arr;		
     }	
	
	
	
	function selecCargosActivos($id_unidad=NULL){
		$subq="";
		if($id_unidad>0){
			$subq=" and unidad=".$id_unidad;	
		}		
		$arr = array();
        $queryString = "
		SELECT 
		c.id,
		UPPER(c.empresa) empresa,
		UPPER(c.nombre) nombre,
		UPPER(c.descripcion) descripcion,
		c.activo,
		c.id_nivel,
		c.area,
		UPPER(n.nombre) nom_nivel
		FROM {{eval_cargos}} c, {{eval_niveles}} n
		WHERE c.activo = 1
		AND c.id_nivel = n.id ".$subq."
		ORDER BY nombre
		";
 		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->nombre = utf8_encode($row->nombre);
			$data->empresa = utf8_encode($row->empresa);
			$data->descripcion = utf8_encode($row->descripcion);
			$data->nom_nivel = utf8_encode($row->nom_nivel);
			$data->id = $row->id;
			$data->activo = $row->activo;
			$data->area = $row->area;
			$data->id_nivel = $row->id_nivel;			
			array_push($arr, $data);
		}
 		
		return $arr;		
     }
	
	
	function selectTiposCriteriosOfCargo($cargo){
		$arr = array();
        $queryString = "
		SELECT 
		crt.id crt_id,
		crt.nombre crt_nombre
		FROM 
		{{eval_comportamientos}} co,
		criterios cr,
		criterios_tipos crt
		WHERE co.id_cargo = ".$cargo."
		AND co.id_criterio = cr.id
		AND cr.id_tipo_criterio = crt.id
		GROUP BY
		crt.id,
		crt.nombre
		ORDER BY crt.orden
		";
 		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		
		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->crt_id = $row->crt_id;
			$data->crt_nombre = utf8_encode($row->crt_nombre);
			$data->cris = $this->selectCriteriosOfCargoTipoCri($cargo, $row->crt_id);
			array_push($arr, $data);
		}
 		
		return $arr;		
   }
   
   
	function selectCriteriosOfCargoTipoCri($cargo, $tcri){
		$arr = array();
        $queryString = "
		SELECT 
		cr.id cr_id,
		cr.nombre cr_nombre
		FROM 
		{{eval_comportamientos}} co,
		{{eval_criterios}} cr,
		criterios_tipos crt
		WHERE co.id_cargo = ".$cargo."
		AND crt.id = ".$tcri."
		AND co.id_criterio = cr.id
		AND cr.id_tipo_criterio = crt.id
		GROUP BY 
		cr.id, 
		cr.nombre
		ORDER BY cr.id
		";
        $eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
 		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->cr_id = $row->cr_id;
			$data->cr_nombre = utf8_encode($row->cr_nombre);
			$data->inds = $this->selectIndicadoresOfCargoCri($conn, $cargo, $row->cr_id);
			array_push($arr, $data);
		}
		return $arr;
	}   
   
	
	
	function selectIndicadoresOfCargoCri($cargo, $cri){
		$arr = array();
        $queryString = "
		SELECT 
		co.id co_id,
		co.nombre co_nombre
		FROM 
		{{eval_comportamientos}} co,
		{{eval_criterios}} cr
		WHERE co.id_cargo = ".$cargo."
		AND cr.id = ".$cri."
		AND co.id_criterio = cr.id
		ORDER BY co.id
		";
        $eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
 		foreach($res as $datos) {
			$row=(Object)$datos;
			$data = NULL;
			$data->co_id = $row->co_id;
			$data->co_nombre = utf8_encode($row->co_nombre);
			array_push($arr, $data);
		}
		return $arr;
	}
		
	
	
	
	
 	function join($fields, $from, $condition=FALSE, $join=FALSE, $order=FALSE)
	{
	    $user = Yii::app()->db->createCommand();
		foreach ($fields as $field)
		{
			$user->select($field);
		}

		$user->from($from);

		if ($condition != FALSE)
		{
			$user->where($condition);
		}

		if ($order != FALSE)
		{
			$user->order($order);
		}

		if (isset($join['where'], $join['on']))
		{
		    if (isset($join['left'])) {
			    $user->leftjoin($join['where'], $join['on']);
			}else
			{
			    $user->join($join['where'], $join['on']);
			}
		}

		$data = $user->queryRow();
		return $data;
	}
 	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalCargos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
