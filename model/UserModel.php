<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午10:18
 */

namespace User\model;

use User\Dao\UserDao;
class UserModel
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
    function findUserall(){
        return $this->getUserDao()->findUserall();

    }
    function getUserModity($id){
        return $this->getUserDao()->getUserModity($id);
    }
    function delUser($id){
        $this->getUserDao()->delUser($id);

    }
    function addUser($name,$sex,$age,$comment){
        $this->getUserDao()->addUser($name,$sex,$age,$comment);
    }
    function upUser($id,$name,$sex,$age,$comment)
    {
        $this->getUserDao()->upUser($id,$name,$sex,$age,$comment);
    }

}