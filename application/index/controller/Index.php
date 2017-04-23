<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\Category as CategoryModel;
use app\index\model\Logs as LogsModel;
use app\index\model\Tag as TagModel;

class Index extends Controller
{
    public function index()
    {
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		$ucount=LogsModel::count();
		
		$categorylist=CategoryModel::all();
		$this->assign('categorylist',$categorylist);
		$this->assign('categorycount',count($categorylist));
		
		$taglist=TagModel::paginate(20);
		$tagcount=TagModel::count();
		$this->assign('taglist',$taglist);
		$this->assign('tagcount',$tagcount);
		
		
		$this->assign('ucount',$ucount);
		return $this->fetch();
    }
}
