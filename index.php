<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午5:57
 */

namespace User;
use User\usercontroller\Usercontroller;
require_once __DIR__."/vendor/autoload.php";
header("Content-type: text/html; charset=utf-8");
$method=$_GET['action']."Action";
$controller=new Usercontroller();
$controller->$method();
?>