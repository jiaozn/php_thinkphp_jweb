<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use think\Request;
use think\Db;
use think\Controller;

class Comment extends Controller{
	public function index(){
		// $list=CommentModel::all();
		$list=CommentModel::paginate(15);
		$count=CommentModel::count();
		$this->assign('list',$list);
		$this->assign('count',$count);
		return $this->fetch();
	}
	public function input(){
		return $this->fetch();
	}
	public function add(){
		$comment=new CommentModel;
		$comment->allowField(true)->save(input('post.'));
		return '评论成功！';
	}
	
	public function edit($id){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$comment=CommentModel::get($id);
		$this->assign('comment',$comment);
		return $this->fetch();
	}
	public function update(){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$comment=CommentModel::get($_POST['id']);
		$comment->content=$_POST['content'];
		$category->save();
		return '修改评论成功';
	}
	
	public function delete($id){	
	if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>1){
			return '权限不够！';
		}
		$comment=CommentModel::get($id);
		$comment->delete();
		return '评论已删除';
	}
}

?>