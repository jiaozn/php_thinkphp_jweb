<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Article extends Model{
	
	//�Զ�����create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//����tags��ȡ��
	protected function getTagsAttr($value,$data){
		//dump($data);
		$tagarr=Db::query('select title from javaj_tag where id= any (select tag_id from javaj_article_tag_access where article_id=?)',[$data['id']]);
		$tags="";
		foreach ($tagarr as $tag){  
			$tags.=$tag['title'].",";
			//�����ַ�����ȡ�����������һ������  
			}  
		$tags=substr($tags,0,-1);  
		return $tags;
	}
		//����tagsarr��ȡ��
	protected function getTagsarrAttr($value,$data){
		//dump($data);
		$tagsarr=Db::query('select title from javaj_tag where id= any (select tag_id from javaj_article_tag_access where article_id=?)',[$data['id']]);
		return $tagsarr;
	}
	//����tags��ȡ��
	protected function getCategorynameAttr($value,$data){
		//dump($data);
		$category=Db::query('select name from javaj_category where id=?',[$data['category_id']]);
		//dump($category);
		return $category[0]['name'];
	}
	
	//����username��ȡ��
	protected function getUsernameAttr($value,$data){
		//dump($data);
		$username=Db::query('select username from javaj_user where id=?',[$data['user_id']]);
		return $username[0]['username'];
	}
}
?>
