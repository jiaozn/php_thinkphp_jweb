<?php
namespace app\index\model;
use think\Model;
class Category extends Model{

		//自动设置create_time\update_time
	protected $autoWriteTimestamp=true;
	//定义文章分类-文章 一对多关联
}
?>