<?php
namespace app\index\model;
use think\Model;
class Comment extends Model{
	//自动设置create_time\update_time
	protected $autoWriteTimestamp=true;
		//定义文章-评论 多对多
	public function articles(){
		return $this->belongsToMany('Article','javaj_article_comment_access');
	}
		//定义user和comment之间的一对多
	public function User(){
		return $this->belongsTo('User');
	}
}
?>