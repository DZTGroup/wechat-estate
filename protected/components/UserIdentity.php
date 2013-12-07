<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

        $user=User::model()->findBySql("select * from User where name=:name and pass=:pass",array(':name'=>$this->username,':pass'=>$this->password));
        if($user=="")
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }

		else
        {
            $this->errorCode=self::ERROR_NONE;
            Yii::app()->user->setState('userName',$user->name);
            Yii::app()->user->setState('type',$user->user_type);
            Yii::app()->user->setState('userId',$user->id);
        }


        return !$this->errorCode;
	}

}