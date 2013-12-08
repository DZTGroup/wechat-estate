<?php

/**
 * Overload of CWebUser to set some more methods.
 */
class WebUser extends CWebUser
{

    public function isAdmin()
    {
        // When Users are implemented, change this to check roles.
        return ( strcmp($this->getUserType(),'admin')==0 );
    }
    public function setUserType($type)
    {
        $this->setState('type',$type);
    }
    public function getUserType()
    {
        return $this->getState('type');
    }

    public function getUserName()
    {
        return $this->getState('userName');
    }
    public function setUserName($userName)
    {
        return $this->setState('userName',$userName);
    }

    public function getUserId(){
        return $this->getState('userId');
    }

    public function setUserId($id){
        return $this->setState('userId',$id);
    }

}