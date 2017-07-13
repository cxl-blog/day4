<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午9:54
 */
namespace User\Dao;
use User\Connection\Sql;
class UserDao{
    /*function mysql(){
        $mysql=Sql::Conneect();
        return $mysql;
    }*/
    private $mysql;
    function __construct()
    {
        $this->mysql=Sql::Conneect();
        return $this->mysql;
    }

    function getUser($id){//id查询单行
        $dbh=$this->mysql;
        $sql="SELECT * FROM `user` WHERE  id= ? ";

        $a=$dbh->prepare($sql);
        $a->execute(
            array($id)
        );
        $string=$a->fetchAll();
        return $string;
    }
    function findUserByname($name){//多行查询
        $dbh=$this->mysql;
        //var_dump($dbh);
        $sql="SELECT * FROM `user` WHERE  name= ? ";
        $a=$dbh->prepare($sql);
        $a->execute(
            array($name)
        );
        $string=$a->fetchAll();

        return $string;
    }
    function findSexUser($sex){
        $dbh=$this->mysql;
        //var_dump($dbh);
        $sql="SELECT * FROM `user` WHERE  sex= ? ";
        $a=$dbh->prepare($sql);
        $a->execute(
            array($sex)
        );
        $string=$a->fetchAll();

        return $string;

    }
    function addUser($name,$sex,$age,$comment){
        $dbh=$this->mysql;
        $sql="INSERT INTO `user` ( `name`,`sex`, `age`,`comment`) VALUES (?,?,?,?)";
        $a=$dbh->prepare($sql);

        if($a->execute(array($name,$sex,$age,$comment,)))
            return 1;
        else
            return 0;



    }
    function delUser($id){
        $dbh=$this->mysql;
        $sql="DELETE FROM `user` WHERE id= ? ";
        $a=$dbh->prepare($sql);
        if($a->execute(array($id)))
            return 1;
        else
            return 0;

    }
    function upUser($id,$name,$sex,$age,$comment){
        $dbh=$this->mysql;
        $sql="UPDATE `user` SET `name`=?,`sex`=?,`age`=?,`comment`=? WHERE id=?";
        $a=$dbh->prepare($sql);
        if($a->execute(array($name,$sex,$age,$comment,$id)))
            return 1;
        else
            return 0;


    }
    function getUserModity($id){
        $dbh=$this->mysql;
        $sql="SELECT * FROM `user` WHERE id=?";
        $qurr=$dbh->prepare($sql);
        $qurr->execute(array($id));
        $row=$qurr->fetch(\PDO::FETCH_ASSOC);
        return $row;


    }
    function findUserall(){
        $sql="SELECT * FROM `user`";
        $dbh=$this->mysql;
        $qurr=$dbh->query($sql);
        $string=array();
        while ($row=$qurr->fetch(\PDO::FETCH_ASSOC))
        {
            $string[]=$row;

        }
        return $string;



    }
    function serchUser($sex,$agel,$ager){

        $dbh=$this->mysql;
        //var_dump($dbh);
        $sql="SELECT * FROM `user` WHERE  sex= ? and ? <=age<= ? ";
        $a=$dbh->prepare($sql);
        $a->execute(
            array($sex,$agel,$ager)
        );
        $string=$a->fetchAll(\PDO::FETCH_ASSOC);

        return $string;
    }
}
?>