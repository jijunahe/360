<?php

/**
 * This is the model class for table "{{eval_usuarios}}".
 *
 * The followings are the available columns in table '{{eval_usuarios}}':
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $alias
 * @property string $clave
 * @property string $documento
 * @property string $email
 * @property string $pais
 * @property integer $perfil
 * @property string $id_unidad
 * @property string $id_area
 * @property integer $id_proyecto
 * @property integer $id_proceso
 * @property string $id_cargo
 * @property integer $activo
 * @property integer $idJefeOperativo
 * @property string $row_date
 * @property integer $numeroJefes
 * @property integer $idJefeFuncional
 * @property integer $idtipo
 * @property string $genero
 * @property string $fechanacimiento
 * @property integer $estadocivil
 * @property string $estrato
 * @property string $tipovivienda
 * @property integer $idnivelestudios
 * @property string $lugarresidenciaactual
 * @property string $lugardetrabajoactual
 * @property string $idprofesion
 * @property integer $anosempresa
 * @property integer $desofacemp
 * @property integer $tipocontrato
 * @property integer $htrabajoemp
 * @property integer $tiposalario
 * @property integer $personasacargo
 * @property integer $horasdiarias
 * @property string $postgrado
 * @property string $cargo
 * @property string $tarjetaprofesional
 * @property string $licencia
 * @property string $lugarcedula
 * @property string $tipotrabajador
 * @property string $profesion
 * @property string $uid_creador
 */
class EvalUsuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eval_usuarios}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' alias, clave, documento, perfil, activo', 'required'),
			array('perfil,  id_proceso, activo, idJefeOperativo, numeroJefes, idJefeFuncional, idtipo, estadocivil, idnivelestudios, anosempresa, desofacemp, tipocontrato, htrabajoemp, tiposalario, personasacargo, horasdiarias', 'numerical', 'integerOnly'=>true),
			array('nombres, apellidos, email, tarjetaprofesional, licencia', 'length', 'max'=>50),
			array('alias, clave, documento', 'length', 'max'=>20),
			array('pais', 'length', 'max'=>300),
			array('id_unidad, tipovivienda, uid_creador', 'length', 'max'=>11),
			array('id_area, id_cargo, idprofesion', 'length', 'max'=>200),
			array('genero', 'length', 'max'=>9),
			array('estrato', 'length', 'max'=>5),
			array('lugarresidenciaactual, lugardetrabajoactual, postgrado, cargo, lugarcedula, profesion', 'length', 'max'=>255),
			array('tipotrabajador', 'length', 'max'=>1),
			array('row_date, fechanacimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombres, apellidos, alias, clave, documento, email, pais, perfil, id_unidad, id_area,  id_proceso, id_cargo, activo, idJefeOperativo, row_date, numeroJefes, idJefeFuncional, idtipo, genero, fechanacimiento, estadocivil, estrato, tipovivienda, idnivelestudios, lugarresidenciaactual, lugardetrabajoactual, idprofesion, anosempresa, desofacemp, tipocontrato, htrabajoemp, tiposalario, personasacargo, horasdiarias, postgrado, cargo, tarjetaprofesional, licencia, lugarcedula, tipotrabajador, profesion, uid_creador', 'safe', 'on'=>'search'),
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
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'alias' => 'Alias',
			'clave' => 'Clave',
			'documento' => 'Documento',
			'email' => 'Email',
			'pais' => 'Pais',
			'perfil' => 'Perfil',
			'id_unidad' => 'Id Unidad',
			'id_area' => 'Id Area',
			'id_proyecto' => 'Id Proyecto',
			'id_proceso' => 'Id Proceso',
			'id_cargo' => 'Id Cargo',
			'activo' => 'Activo',
			'idJefeOperativo' => 'Id Jefe Operativo',
			'row_date' => 'Row Date',
			'numeroJefes' => 'Numero Jefes',
			'idJefeFuncional' => 'Id Jefe Funcional',
			'idtipo' => 'Idtipo',
			'genero' => 'Genero',
			'fechanacimiento' => 'Fechanacimiento',
			'estadocivil' => 'Estadocivil',
			'estrato' => 'Estrato',
			'tipovivienda' => 'Tipovivienda',
			'idnivelestudios' => 'Idnivelestudios',
			'lugarresidenciaactual' => 'Lugarresidenciaactual',
			'lugardetrabajoactual' => 'Lugardetrabajoactual',
			'idprofesion' => 'Idprofesion',
			'anosempresa' => 'Anosempresa',
			'desofacemp' => 'Desofacemp',
			'tipocontrato' => 'Tipocontrato',
			'htrabajoemp' => 'Htrabajoemp',
			'tiposalario' => 'Tiposalario',
			'personasacargo' => 'Personasacargo',
			'horasdiarias' => 'Horasdiarias',
			'postgrado' => 'Postgrado',
			'cargo' => 'Cargo',
			'tarjetaprofesional' => 'Tarjetaprofesional',
			'licencia' => 'Licencia',
			'lugarcedula' => 'Lugarcedula',
			'tipotrabajador' => 'Tipotrabajador',
			'profesion' => 'Profesion',
			'uid_creador' => 'Idus Creador',
		);
	}

	
	
	
	
	

	
	
	function selectAlias($alias){
 		$res = "";
        $queryString =sprintf("
		SELECT 
		alias
		FROM {{eval_usuarios}}
		WHERE alias LIKE BINARY %s","'".$alias."'");
        
   		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();		
		$dato="";
		foreach($res as $datos) {
 			$data= utf8_encode($row->alias);
 		}
 		if($alias==$data){
			 $res=$data;
		
		}else{
			$res = "OK";
		
		}
 		return $res;
    }
	
	function vaidausr($id){
	
		$par_id = $id;
 		$queryc = "SELECT * FROM {{users}} where uid=".(int)$_SESSION["loginID"];
		$gcrt = dbExecuteAssoc($queryc);
		$ussurvey = $gcrt->readAll();
		
		
		$queryc = "SELECT * FROM {{eval_usuarios}} where id=".(int)$ussurvey[0]["iduseval"];
		$gcrt = dbExecuteAssoc($queryc);
		$user = $gcrt->readAll();

		$msg="NO";
   		if(($user[0]["perfil"]==1 or $user[0]["perfil"]==3) or Permission::model()->getanOterpermision()){
			$msg= "OK";
 		}
		else{
			if($par_id!=false){	
				$queryc = "SELECT * FROM {{eval_usuarios}} where id=".(int)$par_id;
				$gcrt = dbExecuteAssoc($queryc);
				$user = $gcrt->readAll();
				if($ussurvey[0]["iduseval"]==$user[0]["id"]){
					$msg= "OK";
				}else{
					$msg= "No tiene permiso realizar esta acción"; 
				}
			}else{
				$msg= "No tiene permiso realizar esta acción"; 
 			}
			 
 		}
 		return $msg;
   		
	}	
	

	function modificarUsuario($data){
	
 		$Result=NULL;
		$valus = new CDbCriteria;
		$valus->condition = 'id='.$data["par_id"];
		$rus = EvalUsuarios::model()->find($valus);	
		
		 
  		if(isset($rus->id)){
  			$rus->nombres=$data["par_nombres"];
			$rus->apellidos=$data["par_apellidos"];
			$rus->clave=$data["par_clave"];
			$rus->documento=$data["par_documento"];
			$rus->email=$data["par_email"];
 			$rus->genero=$data["par_genero"];
 			$rus->id_unidad=$data["id_unidad"];
			
			if($data["par_estrato"]!=""){
			$rus->estrato=$data["par_estrato"];
			}
			if($data["par_estadocivil"]!=""){
			$rus->estadocivil=$data["par_estadocivil"];
			}
			if($data["par_tipovivienda"]!=""){
			$rus->tipovivienda=$data["par_tipovivienda"];
			}
			if($data["par_id_cargo"]!=""){
			$rus->id_cargo=$data["par_id_cargo"];
			}
			if($data["par_id_area"]!=""){
 			$rus->id_area=$data["par_id_area"];
			}
			if($data["par_tipocargo"]!=""){
			$rus->idtipo=$data["par_tipocargo"];
			}
			
			if($data["par_fn"]!=""){
			$rus->fechanacimiento=$data["par_fn"];
			} 
			if($data["par_nivelestudio"]!=""){
			$rus->idnivelestudios=$data["par_nivelestudio"];
			}
			if($data["par_lugarresidenciaactual"]!=""){
			$rus->lugarresidenciaactual=$data["par_lugarresidenciaactual"];
			} 
			if($data["par_personasacargo"]!=""){
			$rus->personasacargo=$data["par_personasacargo"];
			} 
			if($data["par_lugardetrabajoactual"]!=""){
			$rus->lugardetrabajoactual=$data["par_lugardetrabajoactual"];
			} 
			if($data["par_anosempresa"]!=""){
			$rus->anosempresa=$data["par_anosempresa"];
			}
			if($data["par_htrabajoemp"]!=""){
			$rus->htrabajoemp=$data["par_htrabajoemp"];
			}
			if($data["par_tipocontrato"]!=""){
			$rus->tipocontrato=$data["par_tipocontrato"];
			} 
			if($data["par_horasdiarias"]!=""){
			$rus->horasdiarias=$data["par_horasdiarias"];
			} 
 			
			if($data["par_tiposalario"]!=""){
			$rus->tiposalario=$data["par_tiposalario"]; 
			}
  
   
			if($data["par_idprofesion"]!=""){
			$rus->profesion=$data["par_idprofesion"]; 
			}
 			
			if($data["par_cargo"]!=""){
			$rus->cargo=$data["par_cargo"]; 
			}
 			
			
			if($data["par_postgrado"]!=""){
			$rus->postgrado=$data["par_postgrado"]; 
			}
 			
			
			if($data["par_tarjetaprofesional"]!=""){
			$rus->tarjetaprofesional=$data["par_tarjetaprofesional"]; 
			}
 			
			if($data["par_licencia"]!=""){
			$rus->licencia=$data["par_licencia"]; 
			}
 			
			if($data["par_lugarcedula"]!=""){
			$rus->lugarcedula=$data["par_lugarcedula"]; 
			}
 			
  			if($this->vaidausr(false)=="OK"){
				$rus->perfil=$data["par_perfil"];
				$rus->activo=$data["par_activo"];
				if($data["par_usr"]!=""){
				$rus->alias=$data["par_usr"];
				}
			}
 			$Result=$rus->save();
 			if($Result){
				$Result=$rus->id;
			}
 			
		}else if($this->vaidausr(false)=="OK"){
			unset($rus);
			$rus=new EvalUsuarios();
			$rus->nombres=$data["par_nombres"];
			$rus->apellidos=$data["par_apellidos"];
			$rus->clave=$data["par_clave"];
			$rus->documento=$data["par_documento"];
			$rus->email=$data["par_email"];
 			$rus->genero=$data["par_genero"];
 			$rus->perfil=$data["par_perfil"];
			$rus->activo=$data["par_activo"];
			$rus->id_unidad=$data["id_unidad"];
			$rus->uid_creador=(int)$_SESSION['loginID'];
 			if($data["par_estrato"]!=""){
			$rus->estrato=$data["par_estrato"];
			}
			if($data["par_estadocivil"]!=""){
			$rus->estadocivil=$data["par_estadocivil"];
			}
			if($data["par_tipovivienda"]!=""){
			$rus->tipovivienda=$data["par_tipovivienda"];
			}
			if($data["par_id_cargo"]!=""){
			$rus->id_cargo=$data["par_id_cargo"];
			}
			if($data["par_id_area"]!=""){
 			$rus->id_area=$data["par_id_area"];
			}
			if($data["par_tipocargo"]!=""){
			$rus->idtipo=$data["par_tipocargo"];
			}
			
			if($data["par_fn"]!=""){
			$rus->fechanacimiento=$data["par_fn"];
			} 
			if($data["par_nivelestudio"]!=""){
			$rus->idnivelestudios=$data["par_nivelestudio"];
			}
			if($data["par_lugarresidenciaactual"]!=""){
			$rus->lugarresidenciaactual=$data["par_lugarresidenciaactual"];
			} 
			if($data["par_personasacargo"]!=""){
			$rus->personasacargo=$data["par_personasacargo"];
			} 
			if($data["par_lugardetrabajoactual"]!=""){
			$rus->lugardetrabajoactual=$data["par_lugardetrabajoactual"];
			} 
			if($data["par_anosempresa"]!=""){
			$rus->anosempresa=$data["par_anosempresa"];
			}
			if($data["par_htrabajoemp"]!=""){
			$rus->htrabajoemp=$data["par_htrabajoemp"];
			}
			if($data["par_tipocontrato"]!=""){
			$rus->tipocontrato=$data["par_tipocontrato"];
			} 
			if($data["par_horasdiarias"]!=""){
			$rus->horasdiarias=$data["par_horasdiarias"];
			} 
			if($data["par_tiposalario"]!=""){
			$rus->tiposalario=$data["par_tiposalario"]; 
			}
 			
			$rus->alias=$data["par_usr"];

 			
			if($data["par_idprofesion"]!=""){
			$rus->profesion=$data["par_idprofesion"]; 
			}
  			
			if($data["par_cargo"]!=""){
			$rus->cargo=$data["par_cargo"]; 
			}
 			
			if($data["par_postgrado"]!=""){
			$rus->postgrado=$data["par_postgrado"]; 
			}
 			
 			if($data["par_tarjetaprofesional"]!=""){
			$rus->tarjetaprofesional=$data["par_tarjetaprofesional"]; 
			}
 			if($data["par_licencia"]!=""){
			$rus->licencia=$data["par_licencia"]; 
			}
			if($data["par_lugarcedula"]!=""){
			$rus->lugarcedula=$data["par_lugarcedula"]; 
			}

  			
			$rus->insert();
 			$Result = getLastInsertID("{{eval_usuarios}}");
  		}
 		 
        return $Result;
 	}	
 
 	public function selectUsuarioById($idd,$condicion=NULL){  
		$dato = null;
		$id = 0;
		$query=" u.id = ".$idd;
		if($condicion!=""){
			
			$query=$condicion;
			
		}
		
		$queryString = "
		SELECT 
		u.id,
		u.genero,
		u.fechanacimiento,
		u.estadocivil,
		u.estrato,
		u.idtipo,
		u.tipovivienda,
		UPPER(u.nombres) nombres,
		UPPER(u.apellidos) apellidos,
		u.alias,
		u.clave,
		u.documento,
		u.email,
		UPPER(u.pais) pais,
		u.perfil,
		u.id_unidad,
 		u.id_area,
		UPPER(ar.nombre) nom_area,
 		u.id_cargo,
		UPPER(c.nombre) nom_cargo,
		u.activo,
		u.idnivelestudios,
 		u.lugarresidenciaactual,
		u.lugardetrabajoactual,
 		u.anosempresa,
		u.desofacemp,
		u.tipocontrato,
		u.htrabajoemp,
		u.tiposalario,
		u.personasacargo,
		u.horasdiarias,
		u.postgrado,
		u.profesion,
		u.cargo,
		u.tarjetaprofesional,
		u.licencia,
		u.lugarcedula,
		u.tipotrabajador,
 		es.nombre nom_estadocivil,
		tc.nombre nom_tipocargo,
		tc.clasificacion clasificacion
  		FROM {{eval_usuarios}} u
		LEFT JOIN {{eval_cargos}} c
		   ON c.id = u.id_cargo
		LEFT JOIN {{estadocivil}} es
		   ON es.id = u.estadocivil
		LEFT JOIN {{tipo_cargo}} tc
		   ON tc.id = u.idtipo
		   
 		   
		LEFT JOIN {{eval_areas}} ar
		   ON ar.id = u.id_area WHERE ".$query; 
    		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();
  		if(isset($res[0])){
			unset($us);
			$us=array();
			foreach($res as $dat){
				$objt=(object)$dat;
 				if(isset($objt->id_unidad)){
					$ids=explode(",",$objt->id_unidad);
 					if(count($ids)>0){
						if(count($ids)==1 and $ids[0]>0){
							$datu = new CDbCriteria;
							$datu->select='id,nombre';
							$datu->condition = 'id in ('.join(",",$ids).')';
							$uns = EvalUnidades::model()->findAll($datu);					
							$arrun=array();
							foreach($uns as $unidades){
								array_push($arrun,$unidades->nombre);
							}
						}
					}
					$objt->nom_unidad=join(",",$arrun);
				 }
				array_push($us,$objt);
 			}
			if(!isset($us[1])){
				$us=(object)$us[0];
			}
 		}
          return $us;
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
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('id_unidad',$this->id_unidad,true);
		$criteria->compare('id_area',$this->id_area,true);
		$criteria->compare('id_proyecto',$this->id_proyecto);
		$criteria->compare('id_proceso',$this->id_proceso);
		$criteria->compare('id_cargo',$this->id_cargo,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('idJefeOperativo',$this->idJefeOperativo);
		$criteria->compare('row_date',$this->row_date,true);
		$criteria->compare('numeroJefes',$this->numeroJefes);
		$criteria->compare('idJefeFuncional',$this->idJefeFuncional);
		$criteria->compare('idtipo',$this->idtipo);
		$criteria->compare('genero',$this->genero,true);
		$criteria->compare('fechanacimiento',$this->fechanacimiento,true);
		$criteria->compare('estadocivil',$this->estadocivil);
		$criteria->compare('estrato',$this->estrato,true);
		$criteria->compare('tipovivienda',$this->tipovivienda,true);
		$criteria->compare('idnivelestudios',$this->idnivelestudios);
		$criteria->compare('lugarresidenciaactual',$this->lugarresidenciaactual,true);
		$criteria->compare('lugardetrabajoactual',$this->lugardetrabajoactual,true);
		$criteria->compare('idprofesion',$this->idprofesion,true);
		$criteria->compare('anosempresa',$this->anosempresa);
		$criteria->compare('desofacemp',$this->desofacemp);
		$criteria->compare('tipocontrato',$this->tipocontrato);
		$criteria->compare('htrabajoemp',$this->htrabajoemp);
		$criteria->compare('tiposalario',$this->tiposalario);
		$criteria->compare('personasacargo',$this->personasacargo);
		$criteria->compare('horasdiarias',$this->horasdiarias);
		$criteria->compare('postgrado',$this->postgrado,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('tarjetaprofesional',$this->tarjetaprofesional,true);
		$criteria->compare('licencia',$this->licencia,true);
		$criteria->compare('lugarcedula',$this->lugarcedula,true);
		$criteria->compare('tipotrabajador',$this->tipotrabajador,true);
		$criteria->compare('profesion',$this->profesion,true);
		$criteria->compare('uid_creador',$this->uid_creador,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalUsuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
