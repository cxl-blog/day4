<?php

/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午10:48
 */
namespace User\Userserver;
use User\Dao\UserDao;
class Userserver
{
    function getUserDao(){
        $getDao=new UserDao();
        return $getDao;

    }
    function getUser($id){
        $this->getUserDao()->getUser($id);
    }
    function findUserByname($name){
        return $this->getUserDao()->findUserByname($name);
    }
    function findUserall($select){
        if($select=="0")
            return $this->getUserDao()->findUserall();
        else
            return $this->getUserDao()->findSexUser($select);

    }
    function getUserModity($id){
        return $this->getUserDao()->getUserModity($id);
    }
    function delUser($id){
        return $this->getUserDao()->delUser($id);

    }
    function addUser($name,$sex,$age,$comment){
        return $this->getUserDao()->addUser($name,$sex,$age,$comment);
    }
    function upUser($id,$name,$sex,$age,$comment)
    {
        return $this->getUserDao()->upUser($id,$name,$sex,$age,$comment);
    }
    function seleUser($data){
        if(eregi('[0-9]+',$data))
        {
            return $this->getUserDao()->getUser($data);
        }
        else
            return $this->getUserDao()->findUserByname($data);

    }
    function serchUser($sex,$agel,$ager){
           return $this->getUserDao()->serchUser($sex,$agel,$ager);

    }
}