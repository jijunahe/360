<?php

/**
 * This is the model class for table "{{organizacion}}".
 *
 * The followings are the available columns in table '{{organizacion}}':
 * @property integer $id
 * @property string $codigo
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
 */
class Organizacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{organizacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, direccion, ciudad, nit, representantelegal, docidentidadrep, nombrecontacto, docidentidadcontacto, emailcontacto, actividadeconomica', 'length', 'max'=>255),
			array('nombre', 'length', 'max'=>200),
			array('estado,demo', 'length', 'max'=>8),
			array('telefono, fax', 'length', 'max'=>100),
			array('nodosreporte, descripcion, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,demo, codigo, nodosreporte, nombre, descripcion, estado, fecharegistro, direccion, ciudad, nit, telefono, fax, representantelegal, docidentidadrep, nombrecontacto, docidentidadcontacto, emailcontacto, actividadeconomica', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
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
			'demo' => 'demo',
		);
	}

	function findAllorganizaciones($un){
		$subq="";
		if($un=="all"){
			$subq=' id>0';
		}else if(count($un)>0){
			$subq='id in ('.join(",",$un).')';
 		}
		if($subq!=""){
			$dat = new CDbCriteria;
			$dat->condition =$subq;
			$unidades = Organizacion::model()->findAll($dat);
		}else{
			$unidades=NULL;
		}
 		return $unidades;
 	}	
	
	public function getusuariosorganizacion($id=NULL){
		if((int)$id>0){
			$idorg=$id;
		}else{
			$idorg=(int)$_POST["id"];
		}
		$criteria = new CDbCriteria;
		$criteria->condition = ' idorg='.$idorg.' and idperfil in(3,4,2,5)'; 
		$organizaciones = Usuarioxorg::model()->findAll($criteria);
		$r=array();
		foreach($organizaciones as $data){
			$usuario=EvalUsuarios::model()->findByPk($data->idusuario);
			if(isset($usuario->id)){
				array_push($r,(object)array("id"=>$usuario->id,"alias"=>$usuario->alias));
			}
		}
		if((int)$id>0){
			return $r;
		}else{
			echo json_encode($r);
		}
	}	
	
	
	public function selecOrganizaciones($id=NULL){
		//$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		//$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
		$criteria = new CDbCriteria;
		//$sel="id in (".$dUsuario->id_unidad.")";
		$sel="id>0";
		if($id>0){
			$sel=" id=".$id;
		}
		$criteria->condition = $sel.' order by nombre';
		$organizaciones = Organizacion::model()->findAll($criteria);		
		return $organizaciones;
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nodosreporte',$this->nodosreporte,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('demo',$this->demo,true);
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
 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Organizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
