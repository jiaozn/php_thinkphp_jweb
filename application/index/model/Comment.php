<?php
namespace app\index\model;
use think\Model;
class Comment extends Model{
	//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
		//��������-���� ��Զ�
	public function articles(){
		return $this->belongsToMany('Article','javaj_article_comment_access');
	}
		//����user��comment֮���һ�Զ�
	public function User(){
		return $this->belongsTo('User');
	}
}
?>