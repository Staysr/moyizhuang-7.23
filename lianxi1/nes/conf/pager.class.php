<?php
class Pager {
	private $pageSize = 10;
	private $pageIndex;
	private $totalNum;
	private $totalPagesCount;
	private $pageUrl;
	static private $_instance;
	public function __construct($p_totalNum, $p_pageIndex, $p_pageSize = 10, $p_initNum = 3, $p_initMaxNum = 5) {
		if (!isset($p_totalNum) || !isset($p_pageIndex)) {
			exit("pager initial error");
		} 
		$this -> totalNum = $p_totalNum;
		$this -> pageIndex = $p_pageIndex;
		$this -> pageSize = $p_pageSize;
		$this -> initNum = $p_initNum;
		$this -> initMaxNum = $p_initMaxNum;
		$this -> totalPagesCount = ceil($p_totalNum / $p_pageSize);
		$this -> pageUrl = $this -> _getPageUrl();
		$this -> _initPagerLegal();
	} 
	private function _getPageUrl() {
		$CurrentUrl = $_SERVER["REQUEST_URI"];
		$arrUrl = parse_url($CurrentUrl);
		$urlQuery = $arrUrl["query"];
		if ($urlQuery) {
			$urlQuery = ereg_replace("(^|&)page=" . $this -> pageIndex, "", $urlQuery);
			$CurrentUrl = str_replace($arrUrl["query"], $urlQuery, $CurrentUrl);
			if ($urlQuery) {
				$CurrentUrl .= "&page";
			} else {
				$CurrentUrl .= "page";
			} 
		} else {
			$CurrentUrl .= "?page";
		} 
		return $CurrentUrl;
	} 
	private function _initPagerLegal() {
		if (!is_numeric($this -> pageIndex) || ($this -> pageIndex < 1)) {
			$this -> pageIndex = 1;
		} else if ($this -> totalPagesCount < $this -> pageIndex) {
			$this -> pageIndex = $this -> totalPagesCount;
		} 
	} 
	public function GetPagerContent() {
		$str = "<div class=\"Pagination\">";
		if ($this -> pageIndex == 1) {
			$str .= "<a href='javascript:void(0)' class='tips' title='首页'>首页</a> \n";
			$str .= "<a href='javascript:void(0)' class='tips' title='上一页'>上一页</a> \n\n";
		} else {
			$str .= "<a href='$this->pageUrl=1' class='tips' title='首页'>首页</a> \n";
			$str .= "<a href='$this->pageUrl=" . ($this -> pageIndex - 1) . "' class='tips' title='上一页'>上一页</a> \n\n";
		} 
		$currnt = "";
		if ($this -> totalPagesCount <= 10) {
			for ($i = 1;$i <= $this -> totalPagesCount;$i++) {
				if ($i == $this -> pageIndex) {
					$currnt = " class='current'";
				} else {
					$currnt = "";
				} 
				$str .= "<a href='$this->pageUrl=$i ' $currnt>$i</a>\n";
			} 
		} else if ($this -> pageIndex < 3) {
			for ($i = 1;$i <= 3;$i++) {
				if ($i == $this -> pageIndex) {
					$currnt = " class='current'";
				} else {
					$currnt = "";
				} 
				$str .= "<a href='$this->pageUrl=$i ' $currnt>$i</a>\n";
			} 
			$str .= "<span class=\"dot\">……</span>\n";
			for ($i = ($this -> totalPagesCount - 3) + 1;$i <= $this -> totalPagesCount;$i++) {
				$str .= "<a href='$this->pageUrl=$i' >$i</a>\n";
			} 
		} else if ($this -> pageIndex <= 5) {
			for ($i = 1;$i <= $this -> pageIndex + 1;$i++) {
				if ($i == $this -> pageIndex) {
					$currnt = " class='current'";
				} else {
					$currnt = "";
				} 
				$str .= "<a href='$this->pageUrl=$i ' $currnt>$i</a>\n";
			} 
			$str .= "<span class=\"dot\">……</span>\n";
			for ($i = ($this -> totalPagesCount - 3) + 1;$i <= $this -> totalPagesCount;$i++) {
				$str .= "<a href='$this->pageUrl=$i' >$i</a>\n";
			} 
		} else {
			if ((5 < $this -> pageIndex) && ($this -> pageIndex <= $this -> totalPagesCount - 5)) {
				for ($i = 1;$i <= 3;$i++) {
					$str .= "<a href='$this->pageUrl=$i' >$i</a>\n";
				} 
				$str .= "<span class=\"dot\">……</span>";
				for ($i = $this -> pageIndex - 1;$i <= ($this -> totalPagesCount - 5) + 1;$i++) {
					if ($i == $this -> pageIndex) {
						$currnt = " class='current'";
					} else {
						$currnt = "";
					} 
					$str .= "<a href='$this->pageUrl=$i ' $currnt>$i</a>\n";
				} 
				$str .= "<span class=\"dot\">……</span>";
				for ($i = ($this -> totalPagesCount - 3) + 1;$i <= $this -> totalPagesCount;$i++) {
					$str .= "<a href='$this->pageUrl=$i' >$i</a>\n";
				} 
			} else {
				for ($i = 1;$i <= 3;$i++) {
					$str .= "<a href='$this->pageUrl=$i' >$i</a>\n";
				} 
				$str .= "<span class=\"dot\">……</span>\n";
				for ($i = $this -> totalPagesCount - 5;$i <= $this -> totalPagesCount;$i++) {
					if ($i == $this -> pageIndex) {
						$currnt = " class='current'";
					} else {
						$currnt = "";
					} 
					$str .= "<a href='$this->pageUrl=$i ' $currnt>$i</a>\n";
				} 
			} 
		} 
		if ($this -> pageIndex == $this -> totalPagesCount) {
			$str .= "\n<a href='javascript:void(0)' class='tips' title='下一页'>下一页</a>\n";
			$str .= "<a href='javascript:void(0)' class='tips' title='末页'>末页</a>\n";
		} else {
			$str .= "\n<a href='$this->pageUrl=" . ($this -> pageIndex + 1) . "' class='tips' title='下一页'>下一页</a> \n";
			$str .= "<a href='$this->pageUrl=$this->totalPagesCount' class='tips' title='末页'>末页</a> \n";
		} 
		$str .= "</div>";
		return $str;
	} 
} 
