<?php
namespace app\index\model;
use app\index\model\Article as ArticleModel;
use think\Model;
use think\Db;
class Comment extends Model{
	//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
	
		//����username��ȡ��
	protected function getUsernameAttr($value,$data){
		//dump($data);
		$username=Db::query('select username from javaj_user where id=?',[$data['user_id']]);
		return $username[0]['username'];
	}
			//����commentto��ȡ��
	protected function getCommenttoAttr($value,$data){
		//dump($data);
		$commentto=ArticleModel::get($data['comment_id']);
		return $commentto;
	}
	
}
?>