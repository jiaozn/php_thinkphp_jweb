<?php
namespace app\index\controller;
use app\index\model\Comment as CommentModel;
use app\index\model\Category as CategoryModel;
use think\Controller;
use app\index\model\Logs as LogsModel;
use think\Session;
use app\index\model\Tag as TagModel;
class Comment extends Controller{
	public function index(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		$categorylist=CategoryModel::all();
		$this->assign('categorylist',$categorylist);
		$this->assign('categorycount',count($categorylist));
		
		$taglist=TagModel::paginate(20);
		$tagcount=TagModel::count();
		$this->assign('taglist',$taglist);
		$this->assign('tagcount',$tagcount);
		
		// $list=CommentModel::all();
		$list=CommentModel::order('id desc')->paginate(15);
		$count=CommentModel::count();
		$this->assign('list',$list);
		$this->assign('count',$count);
		return $this->fetch();
	}
	public function input(){
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		return $this->fetch();
	}
	public function add(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		$comment=new CommentModel;
		$comment->allowField(true)->save(input('post.'));
		return '评论成功！';
	}
	
	public function edit($id){
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
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
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
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
	
	
	$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
	
	
	
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