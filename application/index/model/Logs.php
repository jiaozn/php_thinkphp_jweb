<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Logs extends Model{
	//自动设置create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//获取ip
	public static function getIp(){
		//获取访问者ip地址
 
			if ($_SERVER['REMOTE_ADDR']) {//判断SERVER里面有没有ip，因为用户访问的时候会自动给你网这里面存入一个ip
			$cip = $_SERVER['REMOTE_ADDR'];
			} elseif (getenv("REMOTE_ADDR")) {//如果没有去系统变量里面取一次 getenv()取系统变量的方法名字
			$cip = getenv("REMOTE_ADDR");
			} elseif (getenv("HTTP_CLIENT_IP")) {//如果还没有在去系统变量里取下客户端的ip
			$cip = getenv("HTTP_CLIENT_IP");
			} else {
			$cip = "unknown";
			}
			return $cip;
	}
	public function addlog($req){
		$cip=$this->getIp();
		dump($cip);
		dump($req->url());
		$sql='insert into ';	
		// Db::execute('insert into javaj_logs(`from`,`to`,`user_id`,`create_time`,) values()',[])
		
	}
}
?>