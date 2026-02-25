<?php
/*
* LimeSurvey
* Copyright (C) 2011 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
*/

class User extends LSActiveRecord
{
    /**
    * @var string Default value for user language
    */
    public $lang='auto';

    
    /**
    * Returns the static model of Settings table
    *
    * @static
    * @access public
    * @param string $class
    * @return User
    */
    public static function model($class = __CLASS__)
    {
        return parent::model($class);
    }

    /**
    * Returns the setting's table name to be used by the model
    *
    * @access public
    * @return string
    */
    public function tableName()
    {
        return '{{users}}';
    }

    /**
    * Returns the primary key of this table
    *
    * @access public
    * @return string
    */
    public function primaryKey()
    {
        return 'uid';
    }

    /**
    * Defines several rules for this table
    *
    * @access public
    * @return array
    */
    public function rules()
    {
        return array(
        array('users_name, password, email', 'required'),
        array('email', 'email'),
        );
    }

    /**
    * Returns all users
    *
    * @access public
    * @return string
    */
    public function getAllRecords($condition=FALSE)
    {
        $criteria = new CDbCriteria;

        if ($condition != FALSE)
        {
            foreach ($condition as $item => $value)
            {
                $criteria->addCondition($item.'='.Yii::app()->db->quoteValue($value));
            }
        }

        $data = $this->findAll($criteria);

        return $data;
    }
    /**
    * 
    * 
    * @param mixed $postuserid
    */
    function parentAndUser($postuserid)
    {
        $user = Yii::app()->db->createCommand()
        ->select('a.users_name, a.full_name, a.email, a.uid,  b.users_name AS parent, a.iduseval')
        ->limit(1)
        ->where('a.uid = :postuserid')
        ->from("{{users}} a")
        ->leftJoin('{{users}} AS b', 'a.parent_id = b.uid')
        ->bindParam(":postuserid", $postuserid, PDO::PARAM_INT)
        ->queryRow();
        return $user;
    }

    /**
    * Returns onetime password
    *
    * @access public
    * @return string
    */
    public function getOTPwd($user)
    {
        $this->db->select('uid, users_name, password, one_time_pw, dateformat, full_name, htmleditormode, iduseval');
        $this->db->where('users_name',$user);
        $data = $this->db->get('users',1);

        return $data;
    }

    /**
    * Deletes onetime password
    *
    * @access public
    * @return string
    */
    public function deleteOTPwd($user)
    {
        $data = array(
        'one_time_pw' => ''
        );
        $this->db->where('users_name',$user);
        $this->db->update('users',$data);
    }

    /**
    * Creates new user
    *
    * @access public
    * @return string
    */
    public static function insertUser($new_user, $new_pass,$new_full_name,$parent_user,$new_email,$iduseval)
    {
        $oUser = new self;
        $oUser->users_name = $new_user;
        $oUser->password = hash('sha256', $new_pass);
        $oUser->full_name = $new_full_name;
        $oUser->parent_id = $parent_user;
        $oUser->lang = 'auto';
        $oUser->email = $new_email;
        $oUser->iduseval = $iduseval;
        if ($oUser->save())
        {
            return $oUser->uid;
        }
        else{
            return false;
        }
    }
		
    public static function insertUserNative($new_user, $new_pass,$new_full_name,$parent_user,$new_email,$iduseval)
	{	
	//error_reporting(E_ALL); ini_set('display_errors', '1');
	
		$iLoginID=intval(Yii::app()->session['loginID']);
 		$lang="auto";
		$new_pass=hash('sha256', $new_pass);
		$iquery = "INSERT INTO {{users}} (users_name,password,full_name,parent_id,lang,email,iduseval) VALUES(:users_name,:password,:full_name,:parent_id,:lang,:email,:iduseval)";
		$command = Yii::app()->db->createCommand($iquery)->bindParam(":users_name", $new_user, PDO::PARAM_STR)
														 ->bindParam(":password", $new_pass, PDO::PARAM_STR)
														 ->bindParam(":full_name", $new_full_name, PDO::PARAM_STR)
														 ->bindParam(":parent_id", $parent_user, PDO::PARAM_INT)
														 ->bindParam(":lang", $lang, PDO::PARAM_STR)
														 ->bindParam(":email",$new_email, PDO::PARAM_STR)
														 ->bindParam(":iduseval", $iduseval, PDO::PARAM_INT);
		$result = $command->query();
		if($result) { //Checked
			$id = getLastInsertID("{{users}}"); //Yii::app()->db->Insert_Id(db_table_name_nq('user_groups'),'ugid');
			 
			return $id;
		}
		else
			return false;

	}	
	

    /**
	 * This method is invoked before saving a record (after validation, if any).
	 * The default implementation raises the {@link onBeforeSave} event.
	 * You may override this method to do any preparation work for record saving.
	 * Use {@link isNewRecord} to determine whether the saving is
	 * for inserting or updating record.
	 * Make sure you call the parent implementation so that the event is raised properly.
	 * @return boolean whether the saving should be executed. Defaults to true.
	 */
    public function beforeSave()
    {
         // Postgres delivers bytea fields as streams :-o - if this is not done it looks like Postgres saves something unexpected
        if (gettype($this->password)=='resource')
        {
            $this->password=stream_get_contents($this->password,-1,0); 
        }
        return parent::beforeSave();
    }
    
    
    /**
    * Delete user
    *
    * @param int $iUserID The User ID to delete
    * @return mixed
    */
    function deleteUser($iUserID)
    {
        $iUserID= (int)$iUserID;
        $oUser=$this->findByPk($iUserID);
        return (bool) $oUser->delete();
    }

    /**
    * Returns user share settings
    *
    * @access public
    * @return string
    */
    public function getShareSetting()
    {
        $this->db->where(array("uid"=>$this->session->userdata('loginID')));
        $result= $this->db->get('users');
        return $result->row();
    }

    /**
    * Returns full name of user
    *
    * @access public
    * @return string
    */
    public function getName($userid)
    {
        static $aOwnerCache = array();
        
        if (array_key_exists($userid, $aOwnerCache)) {
            $result = $aOwnerCache[$userid];
        } else {
            $result = Yii::app()->db->createCommand()->select('full_name')->from('{{users}}')->where("uid = :userid")->bindParam(":userid", $userid, PDO::PARAM_INT)->queryAll();
            $aOwnerCache[$userid] = $result;
        }
        
        return $result;
    }
    
    public function getuidfromparentid($parentid)
    {
        return Yii::app()->db->createCommand()->select('uid')->from('{{users}}')->where('parent_id = :parent_id')->bindParam(":parent_id", $parentid, PDO::PARAM_INT)->queryRow();
    }
    /**
    * Returns id of user
    *
    * @access public
    * @return string
    */
    public function getID($sUserName)
    {
        $oUser = User::model()->findByAttributes(array(
            'users_name' => $sUserName
        ));
        if ($oUser)
        {
            return $oUser->uid;
        }
    }

    /**
    * Updates user password hash
    * 
    * @param int $iUserID The User ID
    * @param string $sPassword The clear text password
    */
    public function updatePassword($iUserID, $sPassword)
    {
        return $this->updateByPk($iUserID, array('password' => hash('sha256', $sPassword)));
    }

    /**
    * Adds user record
    *
    * @access public
    * @return string
    */
    public function insertRecords($data)
    {

        return $this->db->insert('users',$data);
    }
	
	public function validarrole(){
		$id=Yii::app()->user->id;
		$user=User::model()->findByPk($id);
		$role=NULL;
		if((isset($user->iduseval) and (int)$user->iduseval>0) and $user->uid!=1){
			$usval=AnaUsuario::model()->findByPk($user->iduseval);
			if(isset($usval->id)){
				$role=$usval->perfil;
			}
		}else if($user->uid==1){
			$role=1;
		}
 	}

    /**
    * Returns User ID common in Survey_Permissions and User_in_groups
    *
    * @access public
    * @return CDbDataReader Object
    */
    public function getCommonUID($surveyid, $postusergroupid)
    {
        $query2 = "SELECT b.uid FROM (SELECT uid FROM {{permissions}} WHERE entity_id = :surveyid AND entity = 'survey') AS c RIGHT JOIN {{user_in_groups}} AS b ON b.uid = c.uid WHERE c.uid IS NULL AND b.ugid = :postugid";
        return Yii::app()->db->createCommand($query2)->bindParam(":surveyid", $surveyid, PDO::PARAM_INT)->bindParam(":postugid", $postusergroupid, PDO::PARAM_INT)->query(); //Checked
    }


	public function relations()
	{
		return array(
			'permissions' => array(self::HAS_MANY, 'Permission', 'uid')
		);
	}
}
