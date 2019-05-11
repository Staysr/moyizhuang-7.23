<?php 


//-----------------------------------------------------------
//API文件请勿修改，因修改此文件造成无法解析概不负责！
//-----------------------------------------------------------


//文件名称
define('SELF', pathinfo(__file__, PATHINFO_BASENAME));
// 网站根目录
define('FCPATH', str_replace("\\", "/", str_replace(SELF, '', __file__)));
//加载配置文件
require_once FCPATH . 'config.php';
class api extends __abose
{
		private $form, $url, $jurl, $waif, $t_w, $times, $uuid, $type, $c_to_token, $x_token, $tit_error, $tit_tea_error, $param, $ccokie = '';
		private function data_send()
		{
				if (empty($this->url) || $this->tit_error == false || $this->tit_tea_error == false)
				{
						$this->_iserror();
				}
				switch ($this->type)
				{
						case 'bdyun':
								$this->ccokie = '&bdyun=' . USER_BDYUN;
								break;
						case 'tyyun':
								$this->ccokie = '&tyyun=' . USER_TYYUN;
								break;
						case 'weiyun':
								$this->ccokie = '&weiyun=' . USER_WEIYUN;
								break;
						case 'tyyun':
								$this->ccokie = '&icloud=' . USER_ICLOUD;
								break;
				}
				$this->param = '?uid=' . USER_UID . '&token=' . USER_TOKEN . '&url=' . $this->url . '&type=' . $this->type . '&hd=' . USER_HD . '&wap=' . $this->form . '&uuid=' . $this->uuid . '&times=' . $this->
						times . '&ip=' . $_SERVER['REMOTE_ADDR'] . '&cip=' . htmlspecialchars($_POST['t']) . '&tip=' . htmlspecialchars($_POST['tip']) . '&tips=' . htmlspecialchars($_POST['tips']) . '&expire=' . $this->
						full(htmlspecialchars($_POST['tip'])) . '&k1=' . htmlspecialchars($_POST['k1']) . $this->ccokie;
		}
		public function send()
		{
				$this->form = @htmlspecialchars($_POST['ref'] ? $_POST['ref'] : $_GET['ref']);
				$this->jurl = @htmlspecialchars($_POST['url'] ? $_POST['url'] : $_GET['xml']);
				$this->waif = @htmlspecialchars($_POST['key'] ? $_POST['key'] : $_GET['key']);
				$this->t_w = @htmlspecialchars($_POST['time'] ? $_POST['time'] : $_GET['time']);
				$this->times = @htmlspecialchars($_POST['times'] ? $_POST['times'] : $_GET['times']);
				$this->uuid = @htmlspecialchars($_POST['uuid'] ? $_POST['uuid'] : $_GET['uuid']);
				$this->type = @htmlspecialchars($_POST['type'] ? $_POST['type'] : $_GET['type']);
				$this->c_to_token = @htmlspecialchars($_POST['fuck'] ? $_POST['fuck'] : $_GET['fuck']);
				$this->x_token = @htmlspecialchars($_GET['token']);
				$this->tit_error = $this->get_waif($this->waif, $this->t_w);
				$this->tit_tea_error = $this->tea($this->c_to_token, $this->t_w);
				$this->url = trim(rawurlencode($this->get_key($this->jurl, 'D', 'Leuqugirl')));
				$this->data_send();
				if ($_POST['url'])
				{
						$playJson = $this->geturl($this->param);
						$playJson_T_P = json_decode($playJson);
						$this->version($playJson_T_P->version);
						if (isset($playJson_T_P->success))
						{
								$playJson = $this->other_loca($playJson);
								$playJson_T_P = json_decode($playJson);
						}
						if ($playJson_T_P->msg == 'pc')
						{
								$file = fopen($this->__cache($this->url), 'w');
								fwrite($file, urldecode($playJson_T_P->url));
								fclose($file);
								$playJson_T_P->url = $this->strencode(urlencode(YOU_URL . '/api.php?xml=' . $this->jurl . '&token=' . md5($this->url . 'Lequgirl') . '&time=' . $this->t_w . '&key=' . $this->waif . '&fuck=' .
										$this->c_to_token));
						}
						else
						{
								$playJson_T_P->url = $this->strencode($playJson_T_P->url);
						}
						print_r(json_encode($playJson_T_P));
						exit();
				}
				elseif ($_GET['xml'])
				{
						($this->x_token != md5($this->url . 'Lequgirl')) ? $this->_iserror() : '';
						$file = file_get_contents($this->__cache($this->url));
						unlink($this->__cache($this->url));
						header('Content-type: text/xml;charset=utf-8');
						echo $file;
						exit();
				}

		}
}
$a = new api();
$a->send(); ?>