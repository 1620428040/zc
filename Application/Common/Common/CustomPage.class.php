<?php
namespace Common\Common;
use Think\Page;

class CustomPage extends Page{
	static function defaultPage($totalRows, $listRows){
		$page=new CustomPage($totalRows, $listRows);
		$page->setConfig('next','下一页');
		$page->setConfig('prev','上一页');
		$page->setConfig('theme',"%HEADER% %NOW_PAGE%/%TOTAL_PAGE% 页  %FIRST%  %UP_PAGE%  %DOWN_PAGE% %END%");
		return $page;
	}
}
?>