<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Article extends Model{
	
	//自动设置create_time\update_time
	protected $autoWriteTimestamp=true;
	
	//定义tags读取器
	protected function getTagsAttr($value,$data){
		//dump($data);
		$tagarr=Db::query('select title from javaj_tag where id= any (select tag_id from javaj_article_tag_access where article_id=?)',[$data['id']]);
		$tags="";
		foreach ($tagarr as $tag){  
			$tags.=$tag['title'].",";
			//利用字符串截取函数消除最后一个逗号  
			}  
		$tags=substr($tags,0,-1);  
		return $tags;
	}
		//定义tagsarr读取器
	protected function getTagsarrAttr($value,$data){
		//dump($data);
		$tagsarr=Db::query('select title from javaj_tag where id= any (select tag_id from javaj_article_tag_access where article_id=?)',[$data['id']]);
		return $tagsarr;
	}
	//定义tags读取器
	protected function getCategorynameAttr($value,$data){
		//dump($data);
		$category=Db::query('select name from javaj_category where id=?',[$data['category_id']]);
		//dump($category);
		return $category[0]['name'];
	}
	
	//定义username读取器
	protected function getUsernameAttr($value,$data){
		//dump($data);
		$username=Db::query('select username from javaj_user where id=?',[$data['user_id']]);
		return $username[0]['username'];
	}
}
?>
