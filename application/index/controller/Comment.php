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
		$list=CommentModel::all();
		$this->assign('list',$list);
		$this->assign('count',count($list));
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
		$comment=CommentModel::get($id);
		$this->assign('comment',$comment);
		return $this->fetch();
	}
	public function update(){
		$comment=CommentModel::get($_POST['id']);
		$comment->content=$_POST['content'];
		$category->save();
		return '修改评论成功';
	}
	
	public function delete($id){
		$comment=CommentModel::get($id);
		$comment->delete();
		return '评论已删除';
	}
}

?>