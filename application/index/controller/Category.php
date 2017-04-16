<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use think\Request;
use think\Controller;
use think\Db;
class Category extends Controller{
	public function index(){
		$categorylist=CategoryModel::all();
		$this->assign('categorylist',$categorylist);
		$this->assign('categorycount',count($categorylist));
		return $this->fetch();
	}
	
	public function input(){
		return $this->fetch();
	}
	public function add(){
		$category=new CategoryModel;
		$category->allowField(true)->save(input('post.'));
		return '新增成功！';
	}
	public function delete($id){
		if($id==1){
			return '默认分类不允许删除';
		}
		Db::query('update javaj_article set category_id = 1 where category_id=?',[$id]);
		$category=CategoryModel::get($id);
		$category->delete();
		return '删除分类成功';
	}
	public function edit($id){
		$category=CategoryModel::get($id);
		$this->assign('category',$category);
		return $this->fetch();
	}
	public function update(){
		$category=CategoryModel::get($_POST['id']);
		$category->name=$_POST['name'];
		$category->save();
		return '修改分类成功';
	}
}


?>