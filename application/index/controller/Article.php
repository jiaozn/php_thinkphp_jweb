<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Tag as TagModel;
use app\index\model\Category as CategoryModel;
use think\Controller;
use think\Session;
use think\Db;

class Article extends Controller{
	//1.增
	public function input(){
		return $this->fetch();
	}
	public function add(){
		$article=new ArticleModel;
		$article->allowField(true)->save(input('post.'));
		//以上，标题、状态、正文、作者、分类均已解决，剩关键字待处理
		$tagarr=explode(",",$_POST['tags']);
		if(trim($tagarr[0])!=""){
					foreach($tagarr as  $tag){
							if($tagtemp=TagModel::get(['title'=>$tag])){//看该tagg是否已经在tag表中存在了
								//如果已经有了tagg
								Db::execute('insert into javaj_article_tag_access(article_id,tag_id) values(?,?)',[$article->id,$tagtemp->id]);
							}else{
								//若果没有该tagg，则应该增加该tagg
								$tagm=new TagModel;
								$tagm->title=$tag;
								$tagm->save();
								Db::execute('insert into javaj_article_tag_access(article_id,tag_id) values(?,?)',[$article->id,$tagm->id]);
							}	
					}
		}
		return '新增成功！';
	}
	
	//2删
	public function delete($id){
		//评论删除
		//$article->comments()->delete();
		//关键字，要看该关键字还有没有其他的关联，有则保留。没有则删除
		$temparr=Db::query('select tag_id from javaj_article_tag_access where article_id=?',[$id]);//取出文章的所有关联tag-id
		foreach($temparr as $temp){
			$taguc=Db::query('select count(article_id) from javaj_article_tag_access where tag_id=?',[$temp['tag_id']]);//取其中一个tag的关联文章总数
			if($taguc[0]['count(article_id)']==1){//如果该tag关联的文章只有一个了，那就删除该tag
				Db::execute('delete from javaj_tag where id=?',[$temp['tag_id']]);//该tag只有这一个关联文章了，删除该tag
			}
		}
		Db::execute('delete from javaj_article_tag_access where article_id=?',[$id]);//从文章-tag的中间表中删除该article的关键字
		//用户 不动
		Db::execute('delete from javaj_article where id=?',[$id]);
		return '删除成功';
	}
	//3改
	public function edit($id){
		$article=ArticleModel::get($id);
		$this->assign('article',$article);
		return $this->fetch();
	}
			
	public function update(){
		$tagarrori1=Db::query('select title from javaj_tag where id= any (select tag_id from javaj_article_tag_access where article_id=?)',[$_POST['id']]);
		$article=ArticleModel::get($_POST['id']);
		$article->title=$_POST['title'];
		$article->content=$_POST['content'];
		$article->status=$_POST['status'];
		$article->user_id=$_POST['user_id'];
		$article->category_id=$_POST['category_id'];
		$article->save();
		//以上，标题、状态、正文、作者、分类均已解决，剩关键字待处理
		$tagarrnow=explode(",",$_POST['tags']);
		$i=0;
		$tagarrori=array();
		foreach($tagarrori1 as $tagtemp){
			$tagarrori[$i]=$tagtemp['title'];
			$i++;
		}
		$tagarradd=array_diff($tagarrnow,$tagarrori);
		$tagarrdel=array_diff($tagarrori,$tagarrnow);
				if(count($tagarradd)!=0){
							foreach($tagarradd as  $tag){
									if($tagtemp=TagModel::get(['title'=>$tag])){//看该tagg是否已经在tag表中存在了
										//如果已经有了tagg
										Db::execute('insert into javaj_article_tag_access(article_id,tag_id) values(?,?)',[$article->id,$tagtemp->id]);
									}else{
										//若果没有该tagg，则应该增加该tagg
										$tagm=new TagModel;
										$tagm->title=$tag;
										$tagm->save();
										Db::execute('insert into javaj_article_tag_access(article_id,tag_id) values(?,?)',[$article->id,$tagm->id]);
									}	
							}
				}
				if(count($tagarrdel)!=0){
					foreach($tagarrdel as $tag){
						$taguc=Db::query('select count(article_id) from javaj_article_tag_access where tag_id= any (select id from javaj_tag where title=?)',[$tag]);//取其中一个tag的关联文章总数
						dump(Db::execute('delete from javaj_article_tag_access where tag_id= any (select id from javaj_tag where title=?)',[$tag]));//从文章-tag的中间表中删除该article的关键字
						if($taguc[0]['count(article_id)']==1){//如果该tag关联的文章只有一个了，那就删除该tag
							Db::execute('delete from javaj_tag where title=?',[$tag]);//该tag只有这一个关联文章了，删除该tag
						}
						
					}
				}
		return '更新成功！';
	}
	
	
	//4查
	public function read($id){
		if($article=ArticleModel::get($id)){
			$this->assign('article',$article);
			return $this->fetch();
		}else{
			return '该文章不存在';
		}
	}
	
	public function readbyuser($userid){
		$articles=Db::query('select * from javaj_article where user_id=?',[$userid]);
		dump($articles);
	}
	
	public function readbycategory($categoryid){
		$articles=ArticleModel::all(['category_id'=>$categoryid]);
		$category=CategoryModel::get($categoryid);
		$this->assign('category',$category);
		$this->assign('count',count($articles));
		$this->assign('list',$articles);
		return $this->fetch();
	}
	public function readbytag($tag){
		// $articles1=Db::query('select  from javaj_article where id= any(select article_id from javaj_article_tag_access where tag_id= any (select id from javaj_tag where title=?))',[$tag]);
		$articleids=Db::query('select article_id from javaj_article_tag_access where tag_id= any (select id from javaj_tag where title=?)',[$tag]);
		// dump($articles1);
		//dump(array_column($articles1,'article_id'));//该函数要求php>5.5.0
		// dump(array_map('reset',$articles1));
		$articles=ArticleModel::all(array_map('reset',$articleids));
		 $this->assign('list',$articles);
		 $this->assign('tag',$tag);
		 $this->assign('count',count($articles));
		return $this->fetch();
	}
	public function readbycomment($commentid){
	}
	
	//组合
	
	public function index(){
		$list=ArticleModel::all();
		$this->assign('list',$list);
		$this->assign('count',count($list));
		return $this->fetch();
	}
}
?>