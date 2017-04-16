<?php
namespace app\index\model;
use think\Model;
class Ugroup extends Model{
		//自动设置create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//定义user和ugroup之间的一对多
	public function users(){
		return $this->hasMany('User');
	}
}
?>