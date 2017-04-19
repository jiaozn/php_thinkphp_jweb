<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

use app\index\model\Logs as LogsModel;
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
		$this->assign('ucount',$ucount);
		// Session::set('user','jiao');
		return $this->fetch();
    }
}
