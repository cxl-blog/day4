<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午5:23
 */
namespace  User\usercontroller;
//use User\model\Usermodel;
use User\Userserver\Userserver;
require_once "vendor/autoload.php";
class Usercontroller{

    public static $users=null;

    function getmodel(){
        $user=new Userserver();
        //var_dump($user);
        return $user;
    }
    function addAction(){
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $comment=$_POST['comment'];
        if($this->getmodel()->addUser($name,$sex,$age,$comment))
        {
            echo "新增成功，即将跳转.....";
            header("Refresh:3; url=index.html");
        }
        else{
            echo "新增失败，即将跳转.....";
            header("Refresh:3; url=index.html");
        }
    }
    function delAction(){
        $id=$_GET['id'];
        if($this->getmodel()->delUser($id)) {
            echo "删除id为 $id 的用户信息成功";
            include('view/del-view.php');
        }
        else
        {
            echo "删除id为 $id 的用户信息失败";
            include('view/del-view.php');
        }

    }
    function modifyAction(){
        $id=$_GET['id'];
        $user=$this->getmodel()->getUserModity($id);
         $this->render("/edit-view.twig",array('user'=>$user));
    }
    function upAction(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $comment=$_POST['comment'];
        if($this->getmodel()->upUser($id,$name,$sex,$age,$comment)) {
            echo "修改成功，即将跳转。。。。";
            header("Refresh:1; url=?controller=user&action=list");
        }
        else
        {
            echo "修改失败，即将跳转。。。。";
            header("Refresh:1; url=?controller=user&action=list");
        }

    }
    function sleAction(){
        $name=trim($_POST['sele']);
        //var_dump($name);
        $users=$this->getmodel()->seleUser($name);
        $array=$this->paging(count($users),$users);
        $this->render("/sele-view.twig",$array);
    }
    function serchuserAction(){
        $sex=$_POST['sex'];
        $agel=$_POST['agel'];
        $ager=$_POST['ager'];
        if(self::$users==null)
        self::$users=$this->getmodel()->serchUser($sex,$agel,$ager);


        var_dump(self::$users);
        $array=$this->paging(count(self::$users),self::$users);
        $this->render("/serchuser-view.twig",$array);

    }
    function listAction(){//twig分页
        static $row=null;
        if(!isset($_GET['select'])) {
            $select = 0;
            if($row==null)
            $row = $this->getmodel()->findUserall($select);
        }
        else {
            $select = $_GET['select'];
            if($row==null)
            $row=$this->getmodel()->findUserall($select);
        }

        $num=count($row);
        $array=$this->paging($num,$row);
        $this->render("/list-view.twig",$array);
    }

    function paging($num,$row){
        $page_show=5;
        if(!isset($_GET['page']))
            $page=1;
        if(isset($_GET['page']))
            $page=$_GET['page'];
        if($page<=1)
            $page=1;
        //$page=intval($page);
        //var_dump($page);
        $pagenum=ceil($num/$page_show);//分多少页
        $users=array();
        $offset=($page-1)*$page_show;
        for($offset;$offset<$num&&$offset<$page_show*$page;$offset++)
        {
            $users[]=$row[$offset];
        }
        $pagelast=$page-1;
        $pagenext=$page+1;
        if($num<=$page_show)
            return array('users'=>$users);
        if($pagelast>0&&$pagenext<=$pagenum)
            return array('users'=>$users,'page'=>$page,'pagenum'=>$pagenum,'num'=>$num,'pagelast'=>$pagelast,'pagenext'=>$pagenext);
        if ($pagelast<=0)
            return array('users'=>$users,'page'=>$page,'pagenum'=>$pagenum,'num'=>$num,'pagenext'=>$pagenext);
        if($pagenext>$pagenum)
            return array('users'=>$users,'page'=>$page,'pagenum'=>$pagenum,'num'=>$num,'pagelast'=>$pagelast);


    }
    private function render($renderTwig,$data = array())
    {
    $loader = new \Twig_Loader_Filesystem('view');
    $twig = new \Twig_Environment($loader);
    echo $twig->render($renderTwig,$data);

}
}
?>