<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Logs extends Model{
	//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//��ȡip
	public static function getIp(){
		//��ȡ������ip��ַ
 
			if ($_SERVER['REMOTE_ADDR']) {//�ж�SERVER������û��ip����Ϊ�û����ʵ�ʱ����Զ����������������һ��ip
			$cip = $_SERVER['REMOTE_ADDR'];
			} elseif (getenv("REMOTE_ADDR")) {//���û��ȥϵͳ��������ȡһ�� getenv()ȡϵͳ�����ķ�������
			$cip = getenv("REMOTE_ADDR");
			} elseif (getenv("HTTP_CLIENT_IP")) {//�����û����ȥϵͳ������ȡ�¿ͻ��˵�ip
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