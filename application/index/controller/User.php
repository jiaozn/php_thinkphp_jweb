<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use app\index\model\Ugroup as UgroupModel;
use think\Request;
use think\Controller;
use think\Db;
use think\Session;
class User extends Controller{
	public function index(){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
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
			return '该用户不存在';
		}
	
	}	
	public function edit($id){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$user=UserModel::get($id);
		$this->assign('user',$user);
		return $this->fetch();
	}
	public function update(){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
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
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		return $this->fetch();
	}
	public function add(){
		$user=new UserModel;
		$user->allowField(true)->save(input('post.'));
		return '新增成功！';
	}
	public function readbyugroup($ugroupid){
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$user=UserModel::all(['ugroup_id'=>$ugroupid]);
		$ugroup=UgroupModel::get($ugroupid);
		$this->assign('userlist',$user);
		$this->assign('usercount',count($user));
		$this->assign('ugroup',$ugroup);
		return $this->fetch();
	}
	public function login(){
		return $this->fetch();
	}
	public function check(){
			$vip=UserModel::get(['username'=>$_POST['username'],'password'=>$_POST['password']]);
			// dump($vip);
			if($vip!=null){
				Session::set('vip',$vip);
				return '登录成功';
			}else{
				return '登录失败！';
			}
	}
	public function logout(){
		Session::set('vip',null);
		return '登出成功';
	}
	
}
?>