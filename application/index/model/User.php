<?php
namespace app\index\model;
use think\Model;
use think\Db;
class User extends Model{
	//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
	//����ugroupname��ȡ��
	protected function getUgroupnameAttr($value,$data){
		$ugroupname=Db::query('select ugroupname from javaj_ugroup where id=?',[$data['ugroup_id']]);
		return $ugroupname[0]['ugroupname'];
	}
}
?>