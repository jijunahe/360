<?php

/**
 * This is the model class for table "{{estructura}}".
 *
 * The followings are the available columns in table '{{estructura}}':
 * @property integer $id
 * @property integer $idowner
 * @property integer $idorganizacion
 * @property integer $idpadre
 * @property integer $idnivel
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecharegistro
 *
 * The followings are the available model relations:
 * @property Organizacion $idorganizacion0
 * @property Nivel $idnivel0
 */
class Estructura extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{estructura}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idowner, idorganizacion, idpadre, idnivel', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('descripcion, fecharegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idowner, idorganizacion, idpadre, idnivel, nombre, descripcion, fecharegistro', 'safe', 'on'=>'search'),
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
			'idorganizacion0' => array(self::BELONGS_TO, 'Organizacion', 'idorganizacion'),
			'idnivel0' => array(self::BELONGS_TO, 'Nivel', 'idnivel'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idowner' => 'Idowner',
			'idorganizacion' => 'Idorganizacion',
			'idpadre' => 'Idpadre',
			'idnivel' => 'Idnivel',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'fecharegistro' => 'Fecharegistro',
		);
	}
	
	public function estructurausuario($demo=FALSE){
		
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		
		$idestructura=Estructura::getOwnerestructura($oRecord->iduseval,$demo); 
		$first=explode(",",$idestructura);
		$idpadre=$first[0];
		 
		$arrestructura=explode(",",$idestructura);
		$estructura=explode(",",$idestructura);
		for($i=0;$i<count($estructura);$i++){
			$datanodo=$estructura[$i];
			$arrat=Estructura::getDescendientes(array($datanodo),$demo);
			for($j=0;$j<count($arrat);$j++){
				if(!in_array($arrat[$j],$arrestructura)){
					array_push($arrestructura,$arrat[$j]);
				}
			}
		}

		return $arrestructura;
		
		
	}
	
	public function getDescendientes($padres,$demo){
		$arrat=$padres;
		$total=count($arrat);
		if(count($padres)>0){
			foreach($padres as $data){ 
				$criteria = new CDbCriteria;
				$criteria->condition = ' idpadre='.$data;
				$estruc = Estructura::model()->findAll($criteria);
				if(isset($estruc[0]->id)){
					foreach($estruc as $dates){
						if(!in_array($dates->id,$arrat)){
							array_push($arrat,$dates->id);
						}
 					}
					if(count($arrat)>$total){
						$arrat=Estructura::getDescendientes($arrat);
					}
				}
			} 
		}
  		return $arrat;
	}	
	
	
	
	public function getOwnerestructura($id,$demo){
		
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
 		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
		$dat = new CDbCriteria;
		$w = "idus=".$id;
		if($dUsuario->perfil==3 or $demo==TRUE ){
			$w ="id>0";
			 
			$dat->group="idestrcutura";
		}
		 
		if(isset($_GET["organizacion"]) or $demo==TRUE){
			$idorganizacion=(int)$_GET["organizacion"];
			if($demo==TRUE){
				$idorganizacion=27;
			}
			$datorg = new CDbCriteria;
			$datorg->condition = "idorganizacion=".$idorganizacion;
			$estructuras=Estructura::model()->findAll($datorg);
			$est=array(); 
			foreach($estructuras as $dato){
				array_push($est,$dato->id);
			}
			$w .=" and idestrcutura in (".join(",",$est).")"; 
			
		}  
		$dat->condition = $w ;
 		$idestructura="";
 		$estructura=Ownerxestructura::model()->findAll($dat);
		if(isset($estructura[0]->id)){
			$arrat=array();
			foreach($estructura as $d){
				array_push($arrat,$d->idestrcutura);
			}
			if(count($arrat)>0){
				$arrat=Estructura::getDescendientes($arrat);
				$idestructura=join(",",$arrat);
			}
		}
		//printVar($idestructura);
		return $idestructura;
	}	
	public function anios($estructuras,$tabla,$campo,$anio){
		$queryString = "
		SELECT ".$anio." FROM ".$tabla." where ".$campo." in (".join(",",$estructuras).") group by ".$anio." order by ".$anio." ASC"; // printVar($queryString);exit;
		$eguresult = dbExecuteAssoc($queryString);
		$rt = $eguresult->readAll();
		//printVar($respuestas);
		$anios=array();
		foreach($rt as $val){
			array_push($anios,$val[$anio]);
		}
		return $anios;
		
	}
	public function selectorestructura($tabla=NULL,$where=NULL,$demo=FALSE){
		$id=NULL;
		if(isset($_POST["organizacion"])){$id=(int)$_POST["organizacion"];}
		if(isset($_GET["organizacion"])){$id=(int)$_GET["organizacion"];}
		if($demo==TRUE){$id=27;}
		if($id>0){
 			
			$cs = Yii::app()->getClientScript();
			$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');			
			
			$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
			$data["nivel"]=Nivel::model()->findAll();
			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			
 			
 			$path=explode("www/",$_SERVER["PATH_TRANSLATED"]);
			 
			$selectorempresa=CHtml::form(array($path[1]), 'get', array('class'=>'selectorgam', 'id'=>'selectorgam','style'=>'float: left')); 
			$selectorempresa.='Organización: <select name="organizacion" >';
			$selectorempresa.='<option value="-1">Seleccione una empresa</option>';
			$criteria = new CDbCriteria;
			$idorgc=$dUsuario->id_unidad;
			if($demo==true){$idorgc=$id;}
 			$criteria->condition = ' id in ('.$idorgc.')';
			$organizaciones = Organizacion::model()->findAll($criteria);
			foreach($organizaciones as $korg){
				$selectorempresa.='<option value="'.$korg->id.'">'.$korg->nombre.'</option>';
			
			}
			$selectorempresa.='</select>';
			$selectorempresa.='</form><div style="clear:both"></div>';				
			
 			
 			$criteria = new CDbCriteria;
			$criteria->condition = ' idorganizacion='.$id;
			$modeler=Estructura::model()->findAll($criteria);
			$est=array();
			$usxorg=Organizacion::model()->getusuariosorganizacion($id);
			$control=array();
			foreach($usxorg as $data){
				$control[$data->id]=$data->alias;
			}
			$contador=0;
			foreach($modeler as $datos){ 
				$htmlus="";
				
				$tnivel=Nivel::model()->findByPk($datos->idnivel);
				$allniveles=Nivel::model()->findAll();
				
				$criteria = new CDbCriteria;
				$criteria->condition = ' idestrcutura='.$datos->id;
				$criteria->group = 'idus';
				$tusuarios = Ownerxestructura::model()->findAll($criteria);
				
				$totales=0;
				if($tabla!=NULL){
					$queryString = "
					SELECT count(*) as total FROM ".$tabla." where ".$where."=".$datos->id; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$respuestas = $eguresult->readAll();
					if(isset($respuestas[0]["total"])){
						$totales=$respuestas[0]["total"];
					}
				}
				
				
				
				
				$usuarios=array();
				
				$idnivel="";
				if((int)$datos->idnivel>0){
					$idnivel=$datos->idnivel."-";
				}
 				foreach($tusuarios as $dus){
					 array_push($usuarios,$dus->idus);
				}
 				 
				if(in_array($dUsuario->id,$usuarios) or $dUsuario->perfil==3){
					$htmlus.="<input type=\"checkbox\" name=\"nodo\" value=\"".$datos->id."\" />".$d."<br>";
				} 
				
				
				$nomnivel="";
				
				if(isset($tnivel->id)){
					$nomnivel="<div rel=\"titulo_".$tnivel->id."-".$contador."\"><b>".$tnivel->nombre."</b></div>";
					
				}
				$htmlbox="<div style=\"border:1px solid #EDEDFB;border-radius:10px\"><b>Seleccione un nivel:</b><select name=\"nivel\" name=\"".$datos->nombre."\" id=\"padre_".$idnivel.$datos->id."\" ><option value=\"-1\">Seleccione un nivel</option>";
				foreach($allniveles as $nivel){
					$htmlbox.=" <option value=\"".$nivel->id."\" >".$nivel->nombre."</option>";
					
				}
				$htmlbox.="</select></div>";				
				
				$cerrar="<input type=\"image\" src=\"".Yii::app()->baseUrl."/img/bad.gif\" style=\"float:right\"   rel=\"cerrar_".$datos->id."\" ><div style=\"clear:both\"></div>";
				$nivelhtml=$nomnivel;
				 
				 
				 
				$html=$del."<div style=\"font-style:italic;padding:5px\"><center><b>Nombre:</b>
				<div name=\"Estructura[".$idnivel.$datos->id."][nombre]\" >".$datos->nombre." ".$htmlus."</div></center>
				<div style=\"clear:both\"></div><br>
				<div style=\"border:2px solid #e3ca4b;background-color:#fff7ae;\" ><b>Nivel Organizacional:</b> ".$nivelhtml." <br>
				<b>Total registros:</b><br><div  >".$totales."</div> 
				 </div></div>";
	 
				
				$temporalobj=(object)array("v"=>$idnivel.$datos->id,"f"=>$html);
				
				
				
				$padrenivel=Estructura::model()->findByPk($datos->idpadre);
				
				$padrenivelt="";
				if(isset($padrenivel->idnivel)){
					$padrenivelt=$padrenivel->idnivel."-";
				}
				array_push($est,array($temporalobj,$padrenivelt.$datos->idpadre,""));
				$contador++;
			} 
			
			//exit;
			return array($est,1,$selectorempresa);
			//$this->_renderWrappedTemplate('estructura', 'organigramaempresa', $data);
		}
		else{
			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			$path=explode("www/",$_SERVER["PATH_TRANSLATED"]);
			 
			$selectorempresa=CHtml::form(array($path[1]), 'get', array('class'=>'selectorgam', 'id'=>'selectorgam','style'=>'float: left')); 
			$selectorempresa.='Organización: <select name="organizacion" >';
			$selectorempresa.='<option value="-1">Seleccione una empresa</option>';
			$criteria = new CDbCriteria;
			$criteria->condition = ' id in ('.$dUsuario->id_unidad.')';
			$organizaciones = Organizacion::model()->findAll($criteria);
			foreach($organizaciones as $korg){
				$selectorempresa.='<option value="'.$korg->id.'">'.$korg->nombre.'</option>';
			
			}
			$selectorempresa.='</select>';
			$selectorempresa.='</form><div style="clear:both"></div>';
			return array($selectorempresa,0);
		}
  	}	
	
	 
	
	
	
	
	
	
	public function organigramaempresa($id){
 		$data["organizaiones"]=Organizacion::model()->selecOrganizaciones();
		$data["nivel"]=Nivel::model()->findAll();
 		$oRecord = User::model()->findByPk($_SESSION['loginID']); 
		$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
 		/*$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile('https://www.gstatic.com/charts/loader.js');
		*/
		$criteria = new CDbCriteria;
		$criteria->condition = ' idorganizacion='.$id;
		$modeler=Estructura::model()->findAll($criteria);
		$est=array();
		$usxorg=Organizacion::model()->getusuariosorganizacion($id);
		$control=array();
		foreach($usxorg as $data){
			$control[$data->id]=$data->alias;
		}
		$contador=0;
		foreach($modeler as $datos){ 
			$htmlus="";
			
			$tnivel=Nivel::model()->findByPk($datos->idnivel);
			$allniveles=Nivel::model()->findAll();
			
			$criteria = new CDbCriteria;
			$criteria->condition = ' idestrcutura='.$datos->id;
			$tusuarios = Ownerxestructura::model()->findAll($criteria);
			$usuarios=array();
			
			$idnivel="";
			if((int)$datos->idnivel>0){
				$idnivel=$datos->idnivel."-";
			}
			

			foreach($tusuarios as $dus){
				$rtu=EvalUsuarios::model()->findByPk((int)$dus->idus);
				$htmlus.="<input type=\"checkbox\" name=\"usuario_".$idnivel.$datos->id."\" value=\"".$rtu->id."\" checked=\"checked\" />".$rtu->alias."<br>";
				array_push($usuarios,$rtu->id);
			}
			foreach($control as $k=>$d){
				if(!in_array($k,$usuarios)){
					$htmlus.="<input type=\"checkbox\" name=\"usuario_".$idnivel.$datos->id."\" value=\"".$k."\" />".$d."<br>";
				}
			}
			
			
			$nomnivel="";
			
			if(isset($tnivel->id)){
				$nomnivel="<div rel=\"titulo_".$tnivel->id."-".$contador."\"><b>".$tnivel->nombre."</b></div><br>";
				
			}
			$htmlbox="<div style=\"border:1px solid #EDEDFB;border-radius:10px\"><b>Seleccione un nivel:</b><select name=\"nivel\" name=\"".$datos->nombre."\" id=\"padre_".$idnivel.$datos->id."\" ><option value=\"-1\">Seleccione un nivel</option>";
			foreach($allniveles as $nivel){
				$htmlbox.=" <option value=\"".$nivel->id."\" >".$nivel->nombre."</option>";
				
			}
			$htmlbox.="</select></div>";				
			
			$cerrar="<input type=\"image\" src=\"".Yii::app()->baseUrl."/img/bad.gif\" style=\"float:right\"   rel=\"cerrar_".$datos->id."\" ><div style=\"clear:both\"></div>";
			$nivelhtml=$nomnivel;
			if($oRecord->uid==1){ 
				$nivelhtml.="<b>Agregar:</b><input type=\"image\" src=\"".Yii::app()->baseUrl."/img/add.gif\"  rel=\"event_".$idnivel.$datos->id."\"   name=\"".$datos->nombre."\" >";
			}
			$nivelhtml.="<div style=\"display:none;margin-top: -55px;\" id=\"edita_".$idnivel.$datos->id."\" class=\"datos\">".$cerrar.$htmlbox."</div>";

			$del="";
			if($contador>0 and $oRecord->uid==1){
				$del='<input type="image" src="'.Yii::app()->baseUrl.'/img/bad.gif"   style="float:right;width: 13px;"   rel="delete_'.$idnivel.$datos->id.'"  value="Eliminar"><div style="clear:both"></div>';
			}
			$html=$del."<div style=\"font-style:italic;padding:5px\"><center><b>Nombre:</b><input name=\"Estructura[".$idnivel.$datos->id."][nombre]\" type=\"text\" value=\"".$datos->nombre."\" /></center><div style=\"clear:both\"></div><br><div style=\"border:2px solid #e3ca4b;background-color:#fff7ae;\" > ".$nivelhtml." <br><b>Descripcción:</b><br><textarea name=\"Estructura[".$idnivel.$datos->id."][descripcion]\">".$datos->descripcion."</textarea><br><b>Usuarios:<br>".$htmlus."</div></div>";
 
			
			$temporalobj=(object)array("v"=>$idnivel.$datos->id,"f"=>$html);
			
			
			
			$padrenivel=Estructura::model()->findByPk($datos->idpadre);
			
			$padrenivelt="";
			if(isset($padrenivel->idnivel)){
				$padrenivelt=$padrenivel->idnivel."-";
			}
			array_push($est,array($temporalobj,$padrenivelt.$datos->idpadre,""));
			$contador++;
		} 
		
		//exit;
		return $est;
		//$this->_renderWrappedTemplate('estructura', 'organigramaempresa', $data);
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
		$criteria->compare('idowner',$this->idowner);
		$criteria->compare('idorganizacion',$this->idorganizacion);
		$criteria->compare('idpadre',$this->idpadre);
		$criteria->compare('idnivel',$this->idnivel);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecharegistro',$this->fecharegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estructura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
