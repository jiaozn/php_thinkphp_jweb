<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use think\Request;
use think\Controller;
class User extends Controller{
	public function index(){
		$userlist=UserModel::all();
		$this->assign('userlist',$userlist);
		$this->assign('usercount',count($userlist));
		return $this->fetch();
	}
	public function read($id){
		if($user=UserModel::get($id)){
			$this->assign('user',$user);
			return $this->fetch();
		}else{
			return '该文章不存在';
		}
	
	}	
	public function edit($id){
		$user=UserModel::get($id);
		$this->assign('user',$user);
		return $this->fetch();
	}
	public function update(){
		$user=UserModel::get($_POST['id']);
		$user->password=$_POST['password'];
		$user->username=$_POST['username'];
		$user->name=$_POST['name'];
		$user->age=$_POST['age'];
		$user->sex=$_POST['sex'];
		$user->birthday=$_POST['birthday'];
		$user->country=$_POST['country'];
		$user->qq=$_POST['qq'];
		$user->single=$_POST['single'];
		$user->email=$_POST['email'];
		$user->web=$_POST['web'];
		$user->introduce=$_POST['introduce'];
		$user->ugroup_id=$_POST['ugroup_id'];
		$user->save();
		return '更新成功';
	}
	public function delete($id){
		return '暂不提供删除';
	}
	public function input(){
		return $this->fetch();
	}
	public function add(){
		$user=new UserModel;
		$user->allowField(true)->save(input('post.'));
		return '新增成功！';
	}
	
	
}
?>