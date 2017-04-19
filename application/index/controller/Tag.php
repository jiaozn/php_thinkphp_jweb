<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use think\Request;
use think\Controller;
use app\index\model\Logs as LogsModel;
use think\Session;

class Tag extends Controller{
	
	public function index(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
		// $list=TagModel::all();
		$list=TagModel::paginate(15);
		$count=TagModel::count();
		$this->assign('list',$list);
		$this->assign('count',$count);
		return $this->fetch();
	}
}
?>