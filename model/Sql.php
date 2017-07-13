<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午8:59
 */
namespace User\model;
class Sql{
    function ConnectUser(){
        $dbms='mysql';     //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='user-manage-system';    //使用的数据库
        $user='root';      //数据库连接用户名
        $pass='root';          //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new \PDO($dsn, $user, $pass, array(\PDO::ATTR_PERSISTENT => true))//初始化一个PDO对象
            or die("链接错误");
            $dbh->query("SET NAMES utf8");
        } catch (\PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $dbh;
    }
    function ConnectLoginuser(){//链接另一个数据库
        $dbms='mysql';     //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='user-manage-system';    //使用的数据库
        $user='root';      //数据库连接用户名
        $pass='root';          //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new \PDO($dsn, $user, $pass, array(\PDO::ATTR_PERSISTENT => true))//初始化一个PDO对象
            or die("链接错误");
            $dbh->query("SET NAMES utf8");
        } catch (\PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $dbh;


    }
}
?>