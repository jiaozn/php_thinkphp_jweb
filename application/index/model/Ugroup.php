<?php
namespace app\index\model;
use think\Model;
class Ugroup extends Model{
		//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//����user��ugroup֮���һ�Զ�
	public function users(){
		return $this->hasMany('User');
	}
}
?>