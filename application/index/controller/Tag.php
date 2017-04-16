<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use think\Request;
use think\Controller;


class Tag extends Controller{
	
	public function index(){
		$list=TagModel::all();
		$this->assign('list',$list);
		$this->assign('count',count($list));
		return $this->fetch();
	}
}
?>