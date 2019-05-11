-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 01 月 26 日 00:24
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xryy`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e9de5178d7a548ccc8d75ce39c6f5680');

-- --------------------------------------------------------

--
-- 表的结构 `blocked`
--

CREATE TABLE IF NOT EXISTS `blocked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(35, '流行音乐'),
(38, '摇滚音乐'),
(39, '民谣音乐'),
(40, '导致舞曲'),
(41, '嘻哈说唱'),
(42, '轻音乐'),
(43, '爵士乡村'),
(44, '古典'),
(45, '民族音乐'),
(46, '小清新'),
(47, '中文DJ'),
(48, '伤感应用');

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `read`, `time`) VALUES
(1, 2, 1, '你好', 1, '2017-04-24 07:44:19'),
(2, 1, 2, '你也好', 1, '2017-04-24 07:45:01');

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `uid`, `tid`, `message`, `time`) VALUES
(1, 1, 1, '哈哈哈', '2017-04-23 06:41:28'),
(3, 1, 7, '很好听', '2017-04-24 06:57:50'),
(4, 2, 12, '很好听啊，你们觉得呢？', '2017-04-24 07:57:44'),
(5, 1, 12, '很好听', '2017-04-24 08:01:28');

-- --------------------------------------------------------

--
-- 表的结构 `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` int(11) NOT NULL,
  `track` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `downloads`
--

INSERT INTO `downloads` (`id`, `by`, `track`, `time`) VALUES
(1, 1, 2, '2017-04-24 02:03:12');

-- --------------------------------------------------------

--
-- 表的结构 `info_pages`
--

CREATE TABLE IF NOT EXISTS `info_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(4) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `info_pages`
--

INSERT INTO `info_pages` (`id`, `title`, `url`, `public`, `content`) VALUES
(1, '{$lng->developers}', 'developers', 1, 'Our API allows you to retrieve informations from our website via <strong>GET</strong> request and supports the following query parameters:\r\n						<br><br>\r\n						<table border="1" width="100%">\r\n							<tr>\r\n								<td width="20%" valign="top">Name</td>\r\n								<td width="20%" valign="top">Meaning</td>\r\n								<td width="60%" valign="top">Description</td>\r\n							</tr>\r\n							<tr>\r\n								<td width="20%" valign="top"><strong>t (required)</strong></td>\r\n								<td width="20%" valign="top">Query type.</td>\r\n								<td width="60%" valign="top">This parameter specify the type of the query, <strong><code>u</code></strong> is for profile informations, <strong><code>t</code></strong> is for tracks informations.</td>\r\n							</tr>\r\n							<tr>\r\n								<td width="20%" valign="top"><strong>q (required)</strong></td>\r\n								<td width="20%" valign="top">Requested <strong>username</strong>.</td>\r\n								<td width="60%" valign="top">The <code>t</code> parameter supports two values: \r\n								<ul>\r\n									<li>u = <strong>username</strong> [returns basic profile informations containing the following]\r\n										<ul>\r\n											<li><code>id</code> = returns the unique user id</li>\r\n											<li><code>username</code> = returns the username</li>\r\n											<li><code>first_name</code> = returns the first name</li>\r\n											<li><code>last_name</code> = returns the last bame</li></li>\r\n											<li><code>website</code> = returns the website</li></li>\r\n											<li><code>country</code> = returns the country</li></li>\r\n											<li><code>city</code> = returns the city</li></li>\r\n											<li><code>image</code> = returns the profile avatar image</li></li>\r\n											<li><code>cover</code> = returns the profile cover image</li></li>\r\n										</ul>\r\n									</li>\r\n										\r\n									<li>t = <strong>username</strong> [returns a list of latest 20 tracks uploaded by a user containing the following]\r\n										<ul>\r\n											<li><code>id</code> = returns the unique track id</li>\r\n											<li><code>by</code> = returns the unique user id</li>\r\n											<li><code>title</code> = returns the track title</li>\r\n											<li><code>description</code> = returns the description of the track</li>\r\n											<li><code>art</code> = returns the track artwork image</li>\r\n											<li><code>tag</code> = returns the tag list</li>\r\n											<li><code>buy</code> = returns the purchase url</li>\r\n											<li><code>record</code> = returns the record label</li></li>\r\n											<li><code>release</code> = returns the release date</li></li>\r\n											<li><code>license</code> = returns the license type</li></li>\r\n											<li><code>time</code> = returns the date time when was published</li>\r\n											<li><code>likes</code> = returns the number of likes</li>\r\n											<li><code>views</code> = returns the number of views (times played)</li>\r\n										</ul>\r\n									</li>\r\n								</ul></td>\r\n							</tr>\r\n						</table>\r\n						<br>\r\n						<div class="divider"></div>\r\n						<br>\r\n						<div id="jump-url"><strong>Examples of requests:</strong></div><br>\r\n						For profile information of a user:\r\n						<br>\r\n						<code class="api-request">https://phpsound.com/demo/api.php?t=u&q=USERNAME</code>\r\n						<br><br>\r\n						For a list of latest 20 tracks uploaded by a user:\r\n						<br>\r\n						<code class="api-request">https://phpsound.com/demo/api.php?t=t&q=USERNAME</code>\r\n						<br><br>\r\n						<div class="divider"></div>\r\n						<br>\r\n						An example of <strong>json</strong> decoding would be the following PHP code:\r\n						<br><br>\r\n						<code>\r\n						&lt;?php<br>\r\n							header(''Content-Type: text/plain; charset=utf-8;'');\r\n							<br>\r\n							$file = file_get_contents("https://phpsound.com/demo/api.php?t=t&q=USERNAME");<br>\r\n							print_r(json_decode($file));<br>\r\n						?&gt;\r\n						</code>'),
(2, '服务条款', 'service', 1, '<div class="m-service">\r\n    <h2>网易云音乐服务条款</h2>\r\n    <p>【注意】欢迎使用网易公司为您提供的网易云音乐软件或服务。请您（下列简称为“用户”）仔细阅读以下全部内容<strong class="tdu str">（特别是粗体下划线标注的内容）</strong>。未成年人则应在法定监护人陪同下阅读。如用户使用网易云音乐软件或服务，即表示用户与网易公司已达成协议，自愿接受本服务条款所有内容。此后，用户不得以未阅读本服务条款内容作任何形式的抗辩。</p>\r\n    \r\n    <h3>1、服务条款的确认和接纳</h3>\r\n    <p>本条款是用户与网易公司之间关于用户使用网易云音乐软件或服务的条款，内容包括条款正文、网易公司已经发布的或将来可能发布的各类规则。所有规则为本条款不可分割的组成部分，与条款正文具有同等法律效力。除另行明确声明外，用户使用网易云音乐软件或服务的行为将受本条款约束。</p>\r\n    \r\n    <h3>2、网易云音乐简介</h3>\r\n    <p>本服务条款所称的“网易云音乐”是指网易公司所有和经营的专注于发现与分享的音乐产品，依托专业音乐人、DJ、好友推荐及社交功能，为用户打造全新的音乐生活服务。</p>\r\n    <p>用户通过网易云音乐可享受网易云音乐上的音乐、DJ节目,并可在登录后享受更为完整的服务如创建更多歌单、发表评论、分享音乐等。用户登录帐号可以是用户本人的手机号、网易邮箱帐号或网易云音乐增加的其他可登录帐号。用户应维持密码及帐号的机密安全，如果用户未保管好自己的帐号和密码而对用户、网易公司或第三方造成损害，用户将负全部责任。用户同意若发现任何非法使用用户帐号或安全漏洞的情况，有义务立即通告网易公司。</p>\r\n    <p>用户在使用网易云音乐服务时填写、登录、使用的帐号名称、头像、个人简介等帐号信息资料应遵守法律法规、社会主义制度、国家利益、公民合法权益、公共秩序、社会道德风尚和信息真实性等七条底线，不得在帐号信息资料中出现违法和不良信息，且用户保证在填写、登录、使用帐号信息资料时，不得有以下情形:</p>\r\n    <p>（1）违反宪法或法律法规规定的；</p>\r\n	<p>（2）危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</p>\r\n	<p>（3）损害国家荣誉和利益的，损害公共利益的；</p>\r\n	<p>（4）煽动民族仇恨、民族歧视，破坏民族团结的；</p>\r\n	<p>（5）破坏国家宗教政策，宣扬邪教和封建迷信的；</p>\r\n	<p>（6）散布谣言，扰乱社会秩序，破坏社会稳定的；</p>\r\n	<p>（7）散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</p>\r\n	<p>（8）侮辱或者诽谤他人，侵害他人合法权益的；</p>\r\n	<p>（9）含有法律、行政法规禁止的其他内容的。</p>\r\n    <p>若用户登录、使用帐号头像、个人简介等帐号信息资料存在违法和不良信息的，网易公司有权采取通知限期改正、暂停使用等措施。对于冒用关联机构或社会名人登录、使用、填写帐号名称、头像、个人简介的，网易公司有权取消该帐号在网易云音乐上使用，并向政府主管部门进行报告。</p>\r\n    <h3>3、服务条款的修改</h3>\r\n    <p>网易公司有权在必要时通过在网易云音乐软件内或网页上发出公告等合理方式修改本条款。用户在使用网易云音乐软件或服务时，应当及时查阅了解修改的内容，并自觉遵守本服务条款的相关内容。用户如继续使用网易云音乐软件或本服务条款涉及的服务，则视为对修改内容的同意，当发生有关争议时，以最新的服务条款为准；用户在不同意修改内容的情况下，有权停止使用本服务条款涉及的软件或服务。</p>\r\n    \r\n    <h3>4、服务的变更或中止</h3>\r\n    <p>网易公司始终在不断变更和改进服务。网易公司可能会增加或删除网易云音乐的部分服务，也可能暂停或彻底停止本项服务。用户同意网易公司有权行使上述权利且不需对用户或第三方承担任何责任。</p>\r\n    \r\n    <h3>5、用户隐私制度</h3>\r\n    <p class="tdu str">用户知悉并同意，为便于向用户提供更好的服务，网易公司将在用户自愿选择服务或者提供信息的情况下收集用户的个人信息，并将这些信息进行整合。在用户使用网易公司服务时，服务器会自动记录一些信息，包括但不限于URL、IP地址、浏览器类型、使用语言、访问日期和时间等。为方便用户登录或使用网易公司的服务，网易公司在有需要时将使用cookies等技术，并将收集到的信息发送到对应的服务器。用户可以选择接受或者拒绝cookies。如用户选择拒绝cookies，则用户有可能无法登录或使用依赖于cookies的服务或者功能。网易公司收集的信息将成为网易公司常规商业档案的一部分，且有可能因为转让、合并、收购、重组等原因而被转移到网易公司的继任公司或者指定的一方。网易公司同意善意使用收集的信息，且采取各项措施保证信息安全。</p>\r\n    <p class="tdu str">尊重用户个人隐私是网易公司的一项基本政策。所以，网易公司不会公开或透露用户的注册资料及保存在网易云音乐服务中的非公开内容，除非网易公司在诚信的基础上认为透露这些信息在以下几种情况是必要的：</p>\r\n    <p class="tdu str">（1）事先获得用户的明确授权；或</p>\r\n    <p class="tdu str">（2）遵守有关法律规定，包括在国家有关机关查询时，提供用户的注册信息、用户在网易的网页上发布的信息内容及其发布时间、互联网地址或者域名；或</p>\r\n    <p class="tdu str">（3）保持维护网易的知识产权和其他重要权利；或</p>\r\n    <p class="tdu str">（4）在紧急情况下竭力维护用户个人和社会大众的隐私安全；或</p>\r\n    <p class="tdu str">（5）根据本条款相关规定或者网易认为必要的其他情况下。</p>\r\n    <p class="tdu str">网易公司可能会与第三方合作向用户提供网易云音乐的相关服务，在此情况下，如该第三方同意承担与网易公司同等的保护用户隐私的责任，则网易公司可将用户信息提供给该第三方。</p>\r\n    \r\n    <h3>6、不可抗力条款</h3>\r\n    <p class="tdu str">网易公司对不可抗力导致的损失不承担责任。本服务条款所指不可抗力包括：天灾、法律法规或政府指令的变更，因网络服务特性而特有的原因，例如境内外基础电信运营商的故障、计算机或互联网相关技术缺陷、互联网覆盖范围限制、计算机病毒、黑客攻击等因素，及其他合法范围内的不能预见、不能避免并不能克服的客观情况。</p>\r\n    \r\n    <h3>7、禁止服务的商业化</h3>\r\n    <p>用户承诺，非经网易公司同意，用户不能利用网易云音乐软件或服务进行销售或其他商业用途。如用户有需要将网易云音乐软件或服务用于商业用途，应书面通知网易公司并获得网易公司的明确授权。</p>\r\n    \r\n    <h3>8、用户管理</h3>\r\n    <p>用户独立承担其在网易云音乐所发布内容的责任。用户对网易云音乐软件或服务的使用必须遵守所有适用于服务的地方法律、国家法律和国际法律。</p>\r\n    <p>用户承诺：</p>\r\n    <p>（1）用户在网易云音乐上发布信息或者使用网易云音乐的软件或服务时必须符合中国有关法规，不得利用网易云音乐软件或服务制作、复制、发布、传播法律、行政法规禁止的信息。</p>\r\n    <p>（2）用户在网易云音乐上发布信息或者利用网易云音乐的软件或服务时还必须符合其他有关国家和地区的法律规定以及国际法的有关规定。</p>\r\n    <p>（3）用户不得利用网易云音乐软件或服务实施以下行为：</p>\r\n    <p class="p2">(a) 通过非网易公司开发、授权或认可的第三方兼容软件、系统登录或使用网易云音乐软件或服务，或针对网易云音乐软件和相关服务使用非网易公司开发、授权或认证的插件；</p>\r\n    <p class="p2">(b) 删除网易云音乐软件及其他副本上所有关于版权的信息、内容；</p>\r\n    <p class="p2">(c) 对网易云音乐软件进行反向工程、反向汇编、反向编译或以其他方式自网易云音乐软件获取源代码等；</p>\r\n    <p class="p2">(d) 对于网易云音乐软件相关信息等，未经网易公司同意，擅自实施包括但不限于下列行为：使用、出租、出借、复制、修改、链接、转载、汇编、发表、出版，建立镜像站点、擅自借助网易云音乐软件发展与之有关的衍生产品、作品、服务、插件、外挂、兼容、互联等；</p>\r\n    <p class="p2">(e) 对使用网易云音乐软件或服务过程中释放到任何计算机或移动终端内存中的数据及软件运行过程中客户端与服务器端的交互数据进行复制、更改、修改。</p>\r\n    <p class="p2">(f) 其他以任何不合法的方式、为任何不合法的目的、或以任何与本条款不一致的方式使用网易云音乐软件和服务。</p>\r\n    <p>（4）用户不得滥用网易云音乐软件或服务，包括但不限于利用网易云音乐软件或服务进行侵害他人知识产权或者合法利益的其他行为。</p>\r\n    <p>（5）用户应遵守网易公司的所有其他规定和程序。用户须对自己在使用网易云音乐软件或服务过程中的行为承担法律责任。用户承担法律责任的形式包括但不限于：对受到侵害者进行赔偿，以及在网易公司首先承担了因用户的行为导致的行政处罚或侵权损害赔偿责任后，用户应给予网易公司等额的赔偿。若用户违反以上规定，网易公司有权作出独立判断立即暂停或终止对用户提供部分或全部服务，包括冻结、取消用户的帐号的使用权限等措施。</p>\r\n    <p>用户理解，如果网易公司发现用户在网易云音乐发布的信息明显属于上段第(1)条所述内容，依据中国法律，网易公司有义务立即停止传输，保存有关记录，向国家有关机关报告，并且删除含有该内容的地址、目录或关闭服务器。</p>\r\n    \r\n    <h3>9、通知</h3>\r\n    <p>所有发给用户的通知都可通过电子邮件、常规的信件或在网易云音乐软件或网易网站内显著位置公告的方式进行传送。网易公司将通过上述方法之一将消息传递给用户，告知他们服务条款的修改、服务变更、或其它重要事情。</p>\r\n    \r\n    <h3>10、内容、商标所有权</h3>\r\n    <p>网易云音乐软件或服务提供的内容包括但不限于：音频、歌曲图文资料、歌曲列表、文字表述及其组合、界面设计、版面框架、图标、“网易云音乐”和“歌单”商标等。除涉及第三方授权的软件或技术外，所有这些内容均属于网易公司，并受中华人民共和国著作权法、商标法、专利法、反不正当竞争法和相应的国际条约以及其他知识产权法律法规的保护。所以，用户只能在网易公司授权下才能使用这些内容，未经网易公司书面同意，用户不能为任何营利或非营利性的目的擅自复制、再造这些内容、或创造与内容有关的派生产品、或以转让、许可的方式授权第三方实施、利用和转让上述知识产权。</p>\r\n    <p>网易公司有权在服务中或经过服务在网易云音乐软件中投放各种广告和宣传信息。同时云音乐、网易等本文中提及的软件和服务名称有可能为网易公司或其关联公司的商标，未经网易公司事先书面同意，用户不得以任何方式展示或使用或作其他处理，也不得向他人表明用户有权展示、使用、或其他有权处理的行为。</p>\r\n    \r\n    <h3>11、信息储存及相关知识产权</h3>\r\n    <p class="str">网易公司对网易云音乐软件上所有服务将尽力维护其安全性及方便性，但对服务中出现的信息（包括但不限于用户发布的信息、用户自主创立的歌单）删除或储存失败不承担任何责任。另外网易公司有权判定用户的行为是否符合本服务条款的要求，如果用户违背了本服务条款的规定，网易公司有权中止或者终止对提供其网易云音乐服务。</p>\r\n    <p class="str">网易公司尊重知识产权并注重保护用户享有的各项权利。在网易云音乐软件所含服务中，用户可能需要通过发表评论等各种方式向网易公司提供内容。在此情况下，用户仍然享有此等内容的完整知识产权。用户在提供内容时将授予网易公司一项全球性的免费许可，允许网易公司使用、传播、复制、修改、再许可、翻译、创建衍生作品、出版、表演及展示此等内容。</p>\r\n    \r\n    <h3>12、法律</h3>\r\n    <p class="tdu str">本条款适用中华人民共和国的法律，并且排除一切冲突法规定的适用。</p>\r\n    <p class="tdu str">如出现纠纷，用户和网易公司一致同意将纠纷交由杭州市滨江区人民法院管辖。</p>\r\n    \r\n    <h3>13、其他</h3>\r\n    <p>除非另有证明，网易公司储存在其服务器上的数据是您使用网易云音乐软件或服务的唯一有效证据。</p>\r\n    <p>本条款自发布之日起实施，并构成用户和网易公司之间的共识。网易公司不行使、未能及时行使或者未充分行使本条款或者按照法律规定所享有的权利，不应被视为放弃该权利，也不影响网易公司在将来行使该权利。</p>\r\n    <p>如果用户对本条款内容有任何疑问，请发送邮件至我们的客服邮箱：（cloudmusicservice@163.com）。</p>\r\n</div>'),
(3, '隐私政策', 'legal', 1, '<td style="padding:5px;">\r\n                <h2>前言</h2>\r\n<p>网易一向庄严承诺以保护使用其交互性产品和服务之用户的隐私。以下声明旨在披露与网易网页有关的隐私政策并试图回答以下问题：<br>\r\n&nbsp;&nbsp;o 网易收集哪些个人信息，如何收集、使用、储存和分享这些信息以及谁有权接触这些个人  \r\n  信息<br>\r\n&nbsp;&nbsp;o 什麽是cookies，它们是怎麽用的<br>\r\n&nbsp;&nbsp;o 网易的用户在披露个人信息时有哪些选择<br>\r\n&nbsp;&nbsp;o 网易的用户怎样接近、更新、控制、保护或删除他/她的信息<br>\r\n&nbsp;&nbsp;o 如果网易的用户对网易的隐私政策有问题，他们应该和谁联系\r\n</p>\r\n<p>网易是一个多维度的网站。它向用户提供广泛的服务，包括电子邮件、网上拍卖、虚拟社区、论坛、聊天室、个人主页、域名和即时通讯服务等。因为网易的成功取决於建立与维护对用户的良好信誉，我们会坚定的实施保护我们用户隐私的措施。此外，我们认为自己有责任就在互联网上的隐私问题树立榜样并帮助建立有关标准。在登记过程中，每一项服务都要求用户提供不同类型和数量的个人信息。网易力图通过善意使用这些资料而为用户提供更好的服务。本隐私政策适用於您与网易页面的交互行为以及您登记和使用网易的在线服务。除了在本隐私政策和服务条款以及其他公布的准则的规定的情况下，我们不会公布与用户个人身份有关的资料。请注意网易不时地会检查其隐私措施，因此有关的措施会随之变化。我们恳请您定期光顾本页以确保对我们隐私政策最新版本始终保持了解。在阅读完本政策之後，如您对本《隐私政策》或与本《隐私政策》相关的事宜有任何问题，请与Privacy@service.netease.com联系。</p>\r\n<p><strong>您使用或继续使用我们的服务，都表示您同意我们按照本《隐私政策》收集、使用、储存和分享您的信息。</strong></p>\r\n<h2>网易收集用户的两类信息：</h2>\r\n<p>(1) 与个人身份无关的信息：<br>\r\n当用户来到我们的网页，我们收集和汇总诸如哪些网页受到了访问，访问的顺序，链接途径等信息。收集这些信息涉及到记录访问网易的每个用户的IP地址、操作平台、浏览器软件等。尽管这些信息无关个人身份，但我们能够通过其IP地址确定其使用的ISP和其上网的地理位置。这些无关个人身份的信息都帮助我们辩别我们网页最受欢迎的地区并确定我们推广活动的有效性。此外，我们也可能将这些信息披露给我们的广告客户，使他们知道点击他们广告的人数。\r\n</p>\r\n<p>(2) 有关个人身份的信息：<br>\r\n在网易网页的某些区域，比如在登记网易免费电子邮件服务时，用户会被要求提供生日等信息。在登记加入交互式的网易虚拟社区时，用户会被要求提供姓名、代号、籍贯、性别、爱好及兴趣等信息。<br>\r\n网易收集这类关于个人身份的信息主要是为了用户能够更容易和更满意地使用网易的网页。网易的目标是向所有的互联网用户提供刺激、有趣及有教益的上网经历。而这些个人信息有助於我们实现这一目标。<br>\r\n所有用户应该知道，当他们在公告牌、聊天室、签名簿或其他公开场合披露其个人身份信息，该等信息可能会被他人收集并用来向他们发送未经邀约的电子邮件。当您发现网易的用户不正当地收集或使用您或他人的信息时，请联系Privacy@service.netease.com.&nbsp;\r\n</p>\r\n<h2>上述两类信息的来源及网易搜集这些信息的途径：</h2>\r\n<p>您提供的信息<br>\r\n&nbsp;&nbsp;o 您在注册我们的账户或使用我们的服务时，向我们提供的相关个人信息，例如电话号码、电子邮件和银行卡号等；<br> \r\n&nbsp;&nbsp;o 您通过我们的服务向其他方提供的共享信息，以及您使用我们的服务时所储存的信息。\r\n</p>\r\n<p>其他方分享的您的信息<br>\r\n其他方使用我们的服务时所提供有关您的共享信息。\r\n</p>\r\n<p>我们获取的您的信息<br>\r\n您使用我们服务时我们可能收集如下信息：<br>\r\n&nbsp;&nbsp;o 日志信息指您使用我们服务时，系统可能会通过cookies、web beacon或其他方式自动采集的技术信息，包括：<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 设备或软件信息，例如您的移动设备、网页浏览器或您用于接入我们的服务的其他程序所提供的配置信息、您的IP地址和您的移动设备所用的版本和设备识别码；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您在使用我们服务时搜索和浏览的信息，例如您使用的网页搜索词语、访问的社交媒体页面url地址，以及您在使用我们服务时浏览或要求提供的其他信息和内容详情；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 有关您曾使用的移动应用（APP）和其他软件的信息，以及您曾经使用该等移动应用和软件的信息；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您通过我们的服务进行通讯的信息，例如曾通讯的账号，以及通讯时间、数据和时长；及<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您通过我们的服务分享的内容所包含的信息（元数据），例如拍摄或上传的共享照片或录像的日期、时间或地点等。 <br>\r\n&nbsp;&nbsp;o 位置信息指您开启移动终端设备定位功能并使用我们基于位置提供的相关服务时，我们收集的有关您位置的信息，包括： <br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您通过具有定位功能的移动设备使用我们的服务时，我们通过GPS或WiFi等方式收集的您的地理位置信息； <br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您或其他用户提供的包含您所处地理位置的实时信息，例如您提供的账户信息中包含的您所在地区信息，您或其他人上传的显示您当前或曾经所处地理位置的共享信息，例如您或其他人共享的照片包含的地理标记信息；以及<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您可以通过关闭定位功能随时停止我们对您的地理位置信息的收集。\r\n</p>\r\n<h2>我们如何使用您的信息</h2>\r\n<p>我们可能将在向您提供服务的过程之中所收集的信息用作下列用途：<br>\r\n&nbsp;&nbsp;o 向您提供服务；<br>\r\n&nbsp;&nbsp;o 在我们提供服务时，用于身份验证、客户服务、安全防范、诈骗监测、存档和备份用途，确保我们向您提供的产品和服务的安全性；<br>\r\n&nbsp;&nbsp;o 帮助我们设计新服务，改善我们现有服务；<br>\r\n&nbsp;&nbsp;o 使我们更加了解您如何接入和使用我们的服务，从而针对性地回应您的个性化需求，例如语言设定、位置设定、个性化的帮助服务和指示，或对您和其他使用我们服务的用户作出其他方面的回应；<br>\r\n&nbsp;&nbsp;o 向您提供与您更加相关的广告以替代普遍投放的广告；<br>\r\n&nbsp;&nbsp;o 评估我们服务中的广告和其他促销及推广活动的效果，并加以改善；<br>\r\n&nbsp;&nbsp;o 软件认证或管理软件升级；及<br>\r\n&nbsp;&nbsp;o 让您参与有关我们产品和服务的调查。 \r\n</p>\r\n<p>为了让我们的用户有更好的体验、改善我们的服务或您同意的其他用途，在符合相关法律法规的前提下，我们可能将通过我们的某一项服务所收集的个人信息，以汇集信息或者个性化的方式，用于我们的其他服务。例如，在您使用我们的一项服务时所收集的您的个人信息，可能在另一服务中用于向您提供特定内容或向您展示与您相关的、而非普遍推送的信息。如我们在相关服务之中提供了相应选项，您也可以主动要求我们将您在该服务所提供和储存的个人信息用于我们的其他服务。\r\n</p>\r\n<p><strong>针对某些特定服务的特定个人信息保护声明将更具体地说明我们在该等服务中如何使用您的信息。</strong></p>\r\n<h2>如何访问和控制您的信息</h2>\r\n<p>我们将尽量采取适当的技术手段，保证您可以访问、更新和更正您的注册信息或使用我们的服务时提供的其他个人信息。在访问、更新、更正和删除您的个人信息时，我们可能会要求您进行身份验证，以保障您的账户安全。</p>\r\n<p>对于通过cookies和web beacon收集的您的信息，我们还在以下“COOKIES、日志档案和WEB BEACON”部分说明了向您提供的选择机制。</p>\r\n<p>如您想查询或修改您的个人信息，敬请登录网易帐号中心（reg.163.com）。</p>\r\n<h2>我们如何分享您的信息</h2>\r\n<p>除以下情形外，未经您同意，我们不会与任何第三方分享您的个人信息：<br>\r\n&nbsp;&nbsp;o 我们可能将您的个人信息与我们的合作伙伴及第三方服务供应商、承包商及代理（例如代表我们发出电子邮件或推送通知的通讯服务提供商、以及为我们提供位置数据的地图服务供应商）分享（他们可能并非位于您所在法域），用作下列用途：<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 向您提供我们的服务；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 实现“我们如何使用您的信息”部分所述目的；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 履行我们在本《隐私政策》或网易与您达成的其他协议中的义务和行使我们的权利；及<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 理解、维护和改善我们的服务。<br>\r\n如我们与任何上述第三方分享您的个人信息，我们将努力确保该等第三方在使用您的个人信息时遵守本《隐私政策》及我们要求其遵守的其他适当的保密和安全措施。<br>\r\n&nbsp;&nbsp;o 随着我们业务的持续发展，我们有可能进行合并、收购、资产转让或类似的交易，而您的个人信息有可能作为此类交易的一部分而被转移。<br>\r\n&nbsp;&nbsp;o 我们还可能为以下原因需要保留、保存或披露您的个人信息：<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 您授权或同意网易披露的；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 遵守适用的法律法规；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 遵守法院命令或其他法律程序的规定；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 遵守相关政府机关的要求；<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 我们认为为遵守适用的法律法规、维护社会公共利益、或保护我们或我们的集团公司、我们的客户、其他用户或雇员的人身和财产安全或合法权益或公共安全及利益所合理必需的；及<br>\r\n&nbsp;&nbsp;&nbsp;&nbsp;o 根据网易各服务条款及声明中的相关规定，或者网易认为必要的其他情形下。\r\n</p>\r\n<h2>我们如何保留、储存和保护您的信息</h2>\r\n<p>我们仅在本《隐私政策》所述目的所必需期间和法律法规要求的时限内保留您的个人信息。</p>\r\n<p>我们使用各种安全技术和程序，以防信息的丢失、不当使用、未经授权阅览或披露。例如，在某些服务中，我们将利用加密技术（例如SSL）来保护您向我们提供的个人信息。但请您谅解，由于技术的限制以及风险防范的局限，即便我们已经尽量加强安全措施，也无法始终保证信息百分之百的安全。您需要了解，您接入我们的服务所用的系统和通讯网络，有可能因我们可控范围外的情况而发生问题。</p>\r\n<h2>有关共享信息的提示</h2>\r\n<p>我们的多项服务可让您不仅与您的社交网络、也与使用该服务的所有用户公开分享您的相关信息，例如，您在我们的服务中所上传或发布的信息（包括您公开的个人信息、您建立的名单）、您对其他人上传或发布的信息作出的回应，以及包括与这些信息有关的位置数据和日志信息。使用我们服务的其他用户也有可能分享与您有关的信息（包括位置数据和日志信息）。特别是我们的社交媒体服务，是专为使您可以与世界各地的用户共享信息而设计，从而使共享信息可实时、广泛的传递。只要您不删除共享信息，有关信息便一直留存在公众领域；即使您删除共享信息，有关信息仍可能由其他用户或不受我们控制的第三方独立地缓存、复制或储存，或由其他用户或该等第三方在公众领域保存。</p>\r\n<p>因此，请您认真考虑您通过我们的服务上传、发布和交流的信息内容。在一些情况下，您可通过我们某些服务的隐私设定来控制有权浏览您的共享信息的用户范围。</p>\r\n<p>网易的用户总是可以选择是否披露信息。有些信息是登记我们的服务所必需的，但大多数其他信息的提供是由用户决定的。网易将视用户舒适度及自主选择为首位。</p>\r\n<p>网易为用户提供不计其数的网络互动活动，为便于用户参予互动活动并获取互动奖品，网易通常要求申请者在联系方法(通讯地址和电话)之外，还要根据其个人兴趣填写表格。此类信息被网易用来累积其用户的数据。如果用户不想提供所要求的信息和参加此类活动，这完全由用户自行决定。</p>\r\n<h2>有关信息更新与公开的特别提示</h2>\r\n<p>网易鼓励用户更新和修改其个人信息以使其有效。网易用户能在任何时候非常容易地获取并修改其个人信息。用户可以自行决定修改、删除他们的相关资料。</p>\r\n<p>请记住，无论何时您自愿披露个人信息（如在留言板、通过电子邮件或在聊天区公布）， 此种信息可能被他人收集及使用，因此造成您的个人信息泄露，网易不承担责任，如果您将个人信息公布在上述渠道，您就有可能造成个人信息泄露。因此，我们提醒并请您慎重考虑是否有必要在上述渠道公开您的个人信息。</p>\r\n<h2>有关敏感个人信息的提示</h2>\r\n<p>某些个人信息因其特殊性可能被认为是敏感个人信息，例如您的种族、宗教、个人健康和医疗信息等。</p>\r\n<p>请注意，您在我们的服务中所提供、上传或发布的内容和信息（例如有关您社交活动的照片或信息），可能会泄露您的敏感个人信息。您需要谨慎地考虑，是否使用我们的服务披露您的敏感个人信息。</p>\r\n<p>您同意您的敏感个人信息按本《隐私政策》所述的目的和方式来处理。</p>\r\n<h2>COOKIES、日志档案和WEB BEACON</h2>\r\n<p>通过使用Cookies，网易向用户提供简单易行并富个性化的网络体验。一个Cookies是少量的数据，它们从一个网络服务器送至您的浏览器并存在计算机硬盘上。网易使用Cookies是为了让其用户受益。比如，为使得网易虚拟社区的登录过程更快捷，用户们可以选择把用户名和口令存在一个Cookies中。这样下次当用户要登录网易的服务时，只要点击一键就可以了。Cookies能帮助我们确定您连接的页面和内容，您在网易特定网页上花费的时间和您所选择的网易的服务。</p>\r\n<p>Cookies 还能告诉我们您在我们的网页上看到了哪些广告。总之，Cookies是放置在网易的计算机或服务器上的您的身份证。Cookies只能被设置它们的服务器阅读，而且不能执行任何代码或病毒。Cookies使得网易能更好、更快地为您服务，并且使您在网易网页上的经历更富个性化。然而，您应该能够控制Cookies是否以及怎样被你的浏览器接受。请查阅您的浏览器附带的文件以获得更多这方面的信息。简而言之，网易将Cookies当作一种便捷的体验，其作用是使得用户在从网易的一项服务转到另一项服务时，无须再证明自己的身份。</p>\r\n<p>我们和第三方合作伙伴可能通过cookies和web beacon收集和使用您的信息，并将该等信息储存。</p>\r\n<p>我们使用自己的cookies和web beacon，用于以下用途：<br>\r\n&nbsp;&nbsp;o 记住您的身份。例如：cookies和web beacon有助于我们辨认您作为我们的注册用户的身份，或保存您向我们提供有关您的喜好或其他信息； <br>\r\n&nbsp;&nbsp;o 分析您使用我们服务的情况。我们可利用cookies和web beacon来了解您使用我们的服务进行什么活动、或哪些网页或服务最受欢迎；及<br>\r\n&nbsp;&nbsp;o 广告优化。Cookies和web beacon有助于我们根据您的信息，向您提供与您相关的广告而非进行普遍的广告投放。\r\n</p>\r\n<p>我们为上述目的使用cookies和web beacon的同时，可能将通过cookies和web beacon收集的非个人身份信息汇总提供给广告商和其他伙伴，用于分析您和其他用户如何使用我们的服务并用于广告服务。</p>\r\n<p>我们的产品和服务上可能会有广告商和其他合作方放置的cookies和web beacon。这些cookies和web beacon可能会收集与您相关的非个人身份信息，以用于分析用户如何使用该等服务、向您发送您可能感兴趣的广告，或用于评估广告服务的效果。这些第三方cookies和web beacon收集和使用该等信息不受本《隐私政策》约束，而是受到其自身的个人信息保护声明约束，我们不对第三方的cookies或web beacon承担责任。</p>\r\n<p>您可以通过浏览器或用户选择机制拒绝或管理cookies或web beacon。但请您注意，如果您停用cookies或web beacon，我们有可能无法为您提供最佳的服务体验，某些服务也可能无法正常使用。同时，您仍然将收到同样数量的广告，只是这些广告与您的相关性会降低。</p>\r\n<h2>广告</h2>\r\n<p>我们可能使用您的信息，向您提供与您更加相关的广告。</p>\r\n<p>我们也可能使用您的信息，通过我们的服务、电子邮件或其他方式向您发送营销信息，提供或推广我们或第三方的如下商品和服务：<br>\r\n&nbsp;&nbsp;o 我们的商品和服务，包括但不限于：即时通讯服务、网上媒体服务、互动娱乐服务、社交网络服务、付款服务、互联网搜索服务、位置和地图服务、应用软件和服务、数据管理软件和服务、网上广告服务、互联网金融及其他社交媒体、娱乐、电子商务、资讯及通讯软件和服务（“互联网服务”）；及<br>\r\n&nbsp;&nbsp;o 第三方商品和服务，包括但不限于：互联网服务、食物和餐饮、体育、音乐、电影、电视、现场表演和其他艺术和娱乐、书册、杂志和其他刊物、服装和配饰、珠宝、化妆品、个人健康和卫生、电子、收藏品、家用器皿、电器、家居装饰和摆设、宠物、汽车、酒店、交通和旅游、银行、保险及金融服务、会员积分和奖励计划，以及我们认为可能与您相关的其他商品和服务。\r\n</p>\r\n<p>如您不希望我们将您的个人信息用作前述广告用途，您可以通过我们在广告中提供的相关指示、或在特定服务中提供的选择机制，要求我们停止为上述用途使用您的个人信息。</p>\r\n<h2>我们向您发送的邮件和信息</h2>\r\n<p>邮件和信息推送</p>\r\n<p>您使用我们服务时，我们可能使用您的信息向您的设备发送电子邮件、新闻或推送通知。如您不希望收到这些信息，您可以按照我们向您发出的电子邮件所述指示，在设备上选择取消订阅。</p>\r\n<p>与服务有关的公告</p>\r\n<p>我们可能在必需时（例如当我们由于系统维护而暂停某一项服务时）发出与服务有关的公告。您可能无法取消这些与服务有关、性质不属于推广的公告。</p>\r\n<h2>我们服务中的第三方服务</h2>\r\n<p>我们的服务可能包括或链接至第三方提供的社交媒体或其他服务（包括网站）。例如：<br>\r\n&nbsp;&nbsp;o 您可利用 “分享”键将某些内容分享到我们的服务，或您可利用第三方连线服务登录我们的服务。这些功能可能会收集您的信息（包括您的日志信息），并可能在您的电脑装置cookies，从而正常运行上述功能；及<br>\r\n&nbsp;&nbsp;o 我们通过广告或我们服务的其他方式向您提供链接，使您可以接入第三方的服务或网站。\r\n</p>\r\n<p>该等第三方社交媒体或其他服务由相关的第三方负责运营。您使用该等第三方的社交媒体服务或其他服务（包括您向该等第三方提供的任何个人信息），须受第三方自己的服务条款及个人信息保护声明（而非本《隐私政策》）约束，您需要仔细阅读其条款。<strong>本《隐私政策》仅适用于我们所收集的任何信息，并不适用于任何第三方提供的服务或第三方的信息使用规则，而我们对任何第三方使用由您提供的信息不承担任何责任。</strong></p>\r\n<h2>年龄限制</h2>\r\n<p>网易建议：任何未成年人参加网上活动应事先取得家长或其法定监护人（以下简称"监护人"）的同意。网易将根据国家相关法律法规的规定保护未成年人的相关信息。</p>\r\n<p>我们鼓励父母或监护人指导未满十八岁的未成年人使用我们的服务。我们建议未成年人鼓励他们的父母或监护人阅读本《隐私政策》，并建议未成年人在提交个人信息之前寻求父母或监护人的同意和指导。</p>\r\n<h2>本《隐私政策》的适用范围</h2>\r\n<p>除某些特定服务外，我们所有的服务均适用本《隐私政策》。这些特定服务将适用特定的个人信息保护声明。该特定服务的个人信息保护声明构成本《隐私政策》的一部分。<strong>如任何特定服务的个人信息保护声明与本《隐私政策》有不一致之处，则适用特定服务的个人信息保护声明。</strong></p>\r\n<p>除本《隐私政策》另有规定外，本《隐私政策》所用词语将与网易制定的其他公开条款所定义的词语具有相同的涵义。</p>\r\n<p><strong>请您注意，本《隐私政策》不适用于以下情况：</strong><br>\r\n&nbsp;&nbsp;o 通过我们的服务而接入的第三方服务（包括任何第三方网站）收集的信息；或<br>\r\n&nbsp;&nbsp;o 通过在我们服务中进行广告服务的其他公司和机构所收集的信息。\r\n</p>\r\n<h2>本《隐私政策》的修改</h2>\r\n<p>我们可能随时修改本《隐私政策》的条款，该等修改构成本《隐私政策》的一部分。<strong>如该等修改造成您在本《隐私政策》下权利的实质减少，您可以选择停止使用我们向您提供的服务；在该种情况下，若您仍然继续使用我们的服务的，即表示同意受经修订的本《隐私政策》的约束。</strong></p>\r\n<p>任何修改都会将您的满意度置於首位。我们鼓励您在每次访问网易的网页时都查阅我们的隐私政策。</p>\r\n<p>最后，您是唯一对您的账号和密码信息负有保密责任的人。任何情况下，请小心妥善保管。</p>\r\n<p>有关本声明或网易的隐私措施的问题请与网易的网站协调人联系。地址是Privacy@service.netease.com。</p>\r\n<p>\r\n<a href="http://www.iac-i.org/privacy/index.html" target="_blank"><img src="http://img5.cache.netease.com/cnews/2015/1/15/20150115144923e7199.png" alt="中国互联网定向广告用户信息保护框架标准"></a>\r\n</p>\r\n                <p class="inewsbody">&nbsp;</p>\r\n                </td>');
INSERT INTO `info_pages` (`id`, `title`, `url`, `public`, `content`) VALUES
(4, '联系我们', 'contactus', 1, '<tbody><tr>\r\n              <td class="pagehead" style="padding:5px; padding-bottom:2px;">联系我们</td>\r\n            </tr>\r\n            <tr>\r\n              <td>&nbsp;</td>\r\n            </tr>\r\n            <tr>\r\n              <td style="padding:5px;"><p><span class="inewsbody"><b><font color="#990000">网易</font>客户<font color="#000000">服务</font></b></span></p>\r\n                  <table width="75%" height="60" border="0" cellpadding="0">\r\n                    <tbody><tr> \r\n                      <td height="27"><table cellspacing="0" cellpadding="0">\r\n                        <tbody><tr height="27">\r\n                          <td height="31" colspan="2"><p class="STYLE1">网易彩票、商城、交友、免费相册、博客等产品服务咨询</p>                            </td>\r\n                        </tr>\r\n                        <tr height="27">\r\n                          <td height="27" colspan="2"><span class="STYLE1">客服热线：0571 - 26201163</span></td>\r\n                        </tr>\r\n                        <tr height="27">\r\n                          <td height="27" colspan="2"><span class="STYLE1">服务时间：08：00 - 24：00 </span></td>\r\n                        </tr>\r\n                        <tr height="27">\r\n                          <td height="27" colspan="2">&nbsp;</td>\r\n                        </tr>\r\n                        <tr height="27">\r\n                          <td height="27" colspan="2"><p class="STYLE1">免费邮箱客服</p>                            </td>\r\n                        </tr>\r\n						  <tr height="27">\r\n						    <td width="304" height="27"><span class="STYLE1"><font color="#990000" class="bullet1">在线客服服务</font>：<a style="color:#003366" href="http://help.mail.163.com/">http://help.mail.163.com/</a></span></td>\r\n					        <td width="205"> </td>\r\n						  </tr>\r\n						  <tr height="27">\r\n                            <td height="27" colspan="2">&nbsp;</td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="27" colspan="2"><p><span class="inewsbody"><b><font color="#990000">网易</font>游戏客服</b> \r\n                  </span> </p></td>\r\n                          </tr>\r\n						  <tr height="27">\r\n                            <td height="17" colspan="2">&nbsp;</td>\r\n                          </tr>\r\n						  <tr height="27">\r\n                            <td height="27" colspan="2"><p class="STYLE1">游戏客服总机电话: &nbsp;&nbsp;&nbsp;020-83918160</p></td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="27" colspan="2"><p class="STYLE1">大话西游客服电话:         <span lang="EN-US">&nbsp;&nbsp;&nbsp;020-83918161</span></p></td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="27" colspan="2"><p class="STYLE1">梦幻西游客服电话: <span lang="EN-US">&nbsp;&nbsp;&nbsp;020-83918162</span></p></td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="27" colspan="2"><p class="STYLE1">天下贰客服电话:         <span lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;020-83918163</span></p></td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="27" colspan="2"><p class="STYLE1">飞飞游戏客服电话: <span lang="EN-US">&nbsp;&nbsp;&nbsp;020-83918169</span></p></td>\r\n                          </tr>\r\n                          <tr height="27">\r\n                            <td height="22" colspan="2"><p class="STYLE1">&nbsp;</p></td>\r\n                          </tr>\r\n                        </tbody></table>                      </td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td height="27"><span class="STYLE1">注: 请您先选择在线客户服务，如仍无法解决问题，请按照以上相应电话咨询。</span></td>\r\n                    </tr>\r\n                  </tbody></table>\r\n                <p>&nbsp;</p>\r\n                  <p><span class="inewsbody"><br>\r\n                    <b><font color="#990000">网易</font>考拉海购</b></span></p>\r\n                    <div style="height:10px;">&nbsp;</div>\r\n<p style="color:#333;margin-top:5px;"> 网易考拉海购香港公司 </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="800" valign="top"><span class="inewsbody">1/F, Xiu Ping Commercial Building, 104 Jervois Street, Sheung Wan, Hong Kong\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+852)-21376188</span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n              \r\n                  <p style="color:#333;">   网易考拉海购台湾公司 </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="800" valign="top"><span class="inewsbody">台灣省台北市內湖區新湖二路28號5F\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8862)-87919685</span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n              \r\n                  <p style="color:#333;">   网易考拉海购韩国公司 </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="800" valign="top"><span class="inewsbody"> 9F, Miraeasset building, 20, Pangyoyeok-ro 241beon-gil, Bundang-gu, Seongnam-si, Gyeonggi-do, Korea\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8231)-6983837</span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n               \r\n                  <p style="color:#333;"> 网易考拉海购日本东京事务所  </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="800" valign="top"><span class="inewsbody">〒107-0052　東京都港区赤坂7-3-37プラース?カナダ１階\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8103)-68947460</span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n         \r\n                  <p style="color:#333;">网易考拉海购澳大利亚公司</p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="800" valign="top"><span class="inewsbody">Suite 502, 37 Bligh St, Street, Sydney NSW 2000\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+6104)-33264753</span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n                  <p>&nbsp;</p>\r\n                  <p><span class="inewsbody"><b><font color="#990000">网易</font>北京公司</b> \r\n                  </span> </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td height="24"><span class="inewsbody">地址:</span></td>\r\n                    <td width="2">&nbsp;</td>\r\n                      <td width="511" valign="top" class="inewsbody">北京市海淀区西北旺东路10号院 中关村软件园二期西区7号 网易(北京)公司</td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">邮编:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody">100084</td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody"><span class="inewsbody">(+8610)-82558163</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">传真:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody"><span class="inewsbody">(+8610)-82618163 \r\n                       \r\n                        </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                      <td valign="top" class="inewsbody">广告销售部电话:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody"><span class="inewsbody">(+8610)-8255 8163 转88118   服务时间：工作日（09:30-12:00 14:00-18:30）</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">E-mail: </td>\r\n                    <td></td>\r\n                    <td class="inewsbody" valign="top">bjsales#service.netease.com (#=@) </td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">市场部电话:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody"><span class="inewsbody">(+8610)-82558147</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody"><span class="inewsbody">E-mail:</span></td>\r\n                    <td></td>\r\n                    <td valign="top" class="inewsbody"><span class="inewsbody">marcom#service.netease.com (#=@) </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">投资者关系部电话:</td>\r\n                    <td></td>\r\n                    <td valign="top" class="inewsbody">(+8610)-82558208</td>\r\n                  </tr>\r\n                </tbody></table>\r\n                  <p>&nbsp;</p>\r\n                  <p><span class="inewsbody"><br>\r\n                    <b><font color="#990000">网易</font>上海公司</b> </span> </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                  <tbody><tr>\r\n                    <td width="96" valign="top" class="inewsbody">地址:</td>\r\n                    <td width="1">&nbsp;</td>\r\n                      <td width="519" valign="top"><span class="inewsbody">中国上海市虹口区溧阳路735号半岛湾创意产业园区2号楼3楼\r\n                      </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">邮编:</td>\r\n                    <td></td>\r\n                      <td valign="top" class="inewsbody">200080</td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8621)-61947163</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">传真:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8621)-61156336</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                      <td height="24" valign="top" class="inewsbody">广告销售部电话:</td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8621)-61947163-77258</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td height="24" valign="top" class="inewsbody">E-mail:</td>\r\n                    <td></td>\r\n                    <td class="bullet3" valign="top"><span class="inewsbody">shsales#service.netease.com</span> <span class="inewsbody">(#=@) </span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody">市场部电话:</td>\r\n                    <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8621)-61947163-7279</span></td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td valign="top" class="inewsbody"><span class="inewsbody">E-mail:</span></td>\r\n                    <td></td>\r\n                      <td valign="top" class="bullet3"><span class="inewsbody">marcom#service.netease.com (#=@) </span></td>\r\n                  </tr>\r\n                </tbody></table>\r\n                  <p>&nbsp;</p>\r\n                  <p><br>\r\n                    <span class="inewsbody"><b><font color="#990000">网易</font>广州公司</b> \r\n                    </span> </p>\r\n                  <table border="0" cellspacing="0" cellpadding="4">\r\n                    <tbody><tr> \r\n                      <td width="95" height="25" valign="top" class="inewsbody">地址:</td>\r\n                      <td width="2">&nbsp;</td>\r\n                      <td width="517" valign="top"><span class="inewsbody">广州市天河区科韵路16号广州信息港E栋网易大厦</span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody">邮编:</td>\r\n                      <td></td>\r\n                      <td valign="top" class="inewsbody">510665</td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody">电话:</td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8620)-85105163</span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody">传真:</td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8620)-85105203</span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td height="25" valign="top" class="inewsbody">广告销售部电话:</td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8620)-8510 5291/6684  服务时间：工作日（09:30-12:00 14:00-18:30）</span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody">E-mail: </td>\r\n                      <td></td>\r\n                      <td class="bullet3" valign="top"><span class="inewsbody">gzsales#service.netease.com </span><span class="inewsbody">(#=@) </span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody">市场部电话:</td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody">(+8620)-85105546</span></td>\r\n                    </tr>\r\n                    <tr> \r\n                      <td valign="top" class="inewsbody"><span class="inewsbody">E-mail:</span></td>\r\n                      <td></td>\r\n                      <td valign="top"><span class="inewsbody"> gzhuangyanlin#corp.netease.com (#=@) </span></td>\r\n                    </tr>\r\n                  </tbody></table></td>\r\n            </tr>\r\n          </tbody>');

-- --------------------------------------------------------

--
-- 表的结构 `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `track` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `likes`
--

INSERT INTO `likes` (`id`, `track`, `by`, `time`) VALUES
(2, 1, 1, '2017-04-23 07:05:22'),
(3, 7, 1, '2017-04-24 06:57:53'),
(4, 12, 2, '2017-04-24 07:57:12'),
(5, 12, 1, '2017-04-24 08:01:10');

-- --------------------------------------------------------

--
-- 表的结构 `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `child` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `parent`, `child`, `type`, `read`, `time`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2017-04-23 06:41:28'),
(3, 1, 1, 1, 0, 2, 1, '2017-04-23 07:05:22'),
(5, 1, 1, 7, 3, 1, 1, '2017-04-24 06:57:50'),
(6, 1, 1, 7, 0, 2, 1, '2017-04-24 06:57:53'),
(7, 2, 1, 0, 0, 4, 1, '2017-04-24 07:44:04'),
(8, 2, 2, 12, 0, 2, 1, '2017-04-24 07:57:12'),
(9, 2, 2, 12, 4, 1, 1, '2017-04-24 07:57:44'),
(10, 1, 2, 12, 0, 2, 1, '2017-04-24 08:01:10'),
(11, 1, 2, 12, 5, 1, 1, '2017-04-24 08:01:28');

-- --------------------------------------------------------

--
-- 表的结构 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` int(11) NOT NULL,
  `payer_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payer_first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payer_last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payer_country` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `valid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `playlistentries`
--

CREATE TABLE IF NOT EXISTS `playlistentries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist` int(11) NOT NULL,
  `track` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `playlists`
--

CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `public` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leader` int(11) NOT NULL,
  `subscriber` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `relations`
--

INSERT INTO `relations` (`id`, `leader`, `subscriber`, `time`) VALUES
(1, 1, 2, '2017-04-24 07:44:04');

-- --------------------------------------------------------

--
-- 表的结构 `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `track` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `reports`
--

INSERT INTO `reports` (`id`, `track`, `parent`, `content`, `type`, `by`, `state`, `time`) VALUES
(1, '1', 0, '哈哈哈哈哈哈哈\n\n[火狐]', 1, 1, 1, '2017-04-24 02:56:58');

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perpage` int(11) NOT NULL,
  `volume` varchar(4) NOT NULL,
  `captcha` int(11) NOT NULL,
  `intervaln` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `format` varchar(256) NOT NULL,
  `mail` int(11) NOT NULL,
  `artsize` int(11) NOT NULL,
  `artformat` varchar(256) NOT NULL,
  `tracksize` int(11) NOT NULL,
  `trackformat` varchar(128) NOT NULL,
  `tracksizetotal` bigint(12) NOT NULL,
  `cperpage` int(11) NOT NULL,
  `ilimit` int(11) NOT NULL,
  `mlimit` int(11) NOT NULL,
  `rperpage` int(11) NOT NULL,
  `sperpage` int(11) NOT NULL,
  `nperpage` tinyint(4) NOT NULL,
  `nperwidget` tinyint(4) NOT NULL,
  `lperpost` int(11) NOT NULL,
  `aperip` int(11) NOT NULL,
  `conline` int(4) NOT NULL,
  `ronline` tinyint(4) NOT NULL,
  `mperpage` tinyint(4) NOT NULL,
  `chatr` int(11) NOT NULL,
  `email_comment` tinyint(4) NOT NULL,
  `email_like` tinyint(4) NOT NULL,
  `email_new_friend` tinyint(4) NOT NULL,
  `smiles` tinyint(4) NOT NULL,
  `permalinks` tinyint(4) NOT NULL,
  `fbapp` int(11) NOT NULL,
  `fbappid` varchar(128) NOT NULL,
  `fbappsecret` varchar(128) NOT NULL,
  `smtp_email` int(11) NOT NULL,
  `smtp_host` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_auth` int(11) NOT NULL,
  `smtp_username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paypalapp` int(11) NOT NULL,
  `paypaluser` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paypalpass` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paypalsign` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paypalsand` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `promonth` decimal(6,2) NOT NULL,
  `proyear` decimal(6,2) NOT NULL,
  `protracksize` int(11) NOT NULL,
  `protracktotal` bigint(12) NOT NULL,
  `ad1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tracking_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`title`, `theme`, `perpage`, `volume`, `captcha`, `intervaln`, `time`, `size`, `format`, `mail`, `artsize`, `artformat`, `tracksize`, `trackformat`, `tracksizetotal`, `cperpage`, `ilimit`, `mlimit`, `rperpage`, `sperpage`, `nperpage`, `nperwidget`, `lperpost`, `aperip`, `conline`, `ronline`, `mperpage`, `chatr`, `email_comment`, `email_like`, `email_new_friend`, `smiles`, `permalinks`, `fbapp`, `fbappid`, `fbappsecret`, `smtp_email`, `smtp_host`, `smtp_port`, `smtp_auth`, `smtp_username`, `smtp_password`, `language`, `timezone`, `paypalapp`, `paypaluser`, `paypalpass`, `paypalsign`, `paypalsand`, `currency`, `promonth`, `proyear`, `protracksize`, `protracktotal`, `ad1`, `ad2`, `ad3`, `ad4`, `ad5`, `ad6`, `ad7`, `tracking_code`) VALUES
('网易云音乐', 'sound', 10, '0.80', 0, 60000, 0, 2097152, 'png,jpg,gif,jpeg', 1, 2097152, 'png,jpg,gif,jpeg', 5242880, 'mp3,m4a,mp4', 104857600, 10, 9, 1000, 20, 10, 100, 30, 5, 0, 600, 7, 10, 30, 1, 1, 1, 1, 0, 0, '', '', 1, 'smtp.163.com', 25, 1, '10373458@163.com', 'mmmmmm50010', 'China', '', 0, '', '', '', 0, 'USD', '3.00', '29.00', 52428800, 1073741824, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uid` int(32) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `art` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `buy` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `record` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `release` date NOT NULL,
  `license` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `public` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `tracks`
--

INSERT INTO `tracks` (`id`, `uid`, `title`, `description`, `name`, `tag`, `art`, `buy`, `record`, `release`, `license`, `size`, `download`, `time`, `public`, `likes`, `downloads`, `views`) VALUES
(1, 1, '林玉英 - 娜奴娃情歌', 'rw', '1905790498_1745965290_1188285241.mp3', 'fffd,', '301971701_1376235348_1306973537.jpg', '', '', '0000-00-00', 0, 8055294, 0, '2017-04-23 06:26:46', 1, 1, 0, 17),
(2, 1, '汤灿 - 龙船调', '锂电池', '1655242631_2122846889_632160983.mp3', '哈哈哈,', '107137637_287955327_721036309.jpg', '', '', '0000-00-00', 0, 12989697, 1, '2017-04-24 01:59:54', 1, 0, 1, 2),
(3, 1, '林玉英 - 高山青', '', '813906637_1364959483_1471418486.mp3', '流行音乐,', '513645292_1581756838_1956838368.jpg', '', '', '0000-00-00', 0, 7553739, 0, '2017-04-24 06:31:53', 1, 0, 0, 2),
(4, 1, '逃 - 侯旭', '这个深夜有谁陪我买醉\r\n尝下这杯孤独我会想谁\r\n我才知道我回忆的回忆的\r\n回忆的全是你', '84149632_1310947983_1062411606.mp3', '流行音乐,', '331834103_2038930719_954934249.jpg', '', '', '0000-00-00', 0, 3872614, 0, '2017-04-24 06:38:02', 1, 0, 0, 3),
(5, 1, 'Jar Of Love - 曲婉婷', '《Jar of Love》是中国原创音乐人曲婉婷的一首作品，收录在其首张专辑《Everything In The World》（北美版）和《我的歌声里》（亚洲版）中。', '1266815975_1918227584_1982148988.mp3', '流行音乐,', '236077813_1130073120_776834626.jpg', '', '', '0000-00-00', 0, 3975242, 0, '2017-04-24 06:47:49', 1, 0, 0, 4),
(6, 1, '光明 - 谭茜', '当灰烬查封了凝霜的屋檐\r\n当车菊草化作深秋的露水\r\n我用固执的枯藤做成行囊\r\n走向了那布满荆棘的他乡', '291131378_73681214_1523378661.mp3', '流行音乐,', '414835799_1126374016_1399529289.jpg', '', '', '0000-00-00', 0, 3764828, 0, '2017-04-24 06:53:47', 1, 0, 0, 1),
(7, 1, '爷们 - 孔东东', '最近有什么改变\n\n笑着说一声再见\n\n走遍天涯也怀念\n\n不敢回头', '1598722431_1122131745_1670117840.mp3', '流行音乐,', '140126158_1575556498_1954515910.jpg', '', '', '0000-00-00', 0, 4122141, 0, '2017-04-24 06:56:57', 1, 1, 0, 3),
(8, 1, '把酒倒满 - 李晓杰', '如果爱是一杯穿肠的毒药 我喝过\r\n如果情是一汪人世间的浑水 我趟过\r\n如果我的命运注定坎坷\r\n我不会问为什么\r\n如果自暴自弃怨天由命 那不是我\r\n如果你有一双飞翔的翅膀 还等什么\r\n如果你的泪水已经汇聚成河 你在酿酒吗', '586467656_1811689876_863143825.mp3', '流行音乐,', '721356570_624562092_1468252547.jpg', '', '', '0000-00-00', 0, 4407698, 0, '2017-04-24 07:03:54', 1, 0, 0, 2),
(9, 1, '风的季节 - Soler', '夏天偷去听不见声音\r\n　　日子匆匆走过倍令我有百感生\r\n　　记挂那一片景象缤纷\r\n　　随风轻轻吹到你步进了我的心\r\n　　在一息间改变我一生\r\n　　付出多少热诚也没法去计得真\r\n　　却也不需再惊惧风雨侵\r\n　　吹呀吹 让这风吹\r\n　　抹干眼眸里亮晶的眼泪', '623177427_870474647_2080069925.mp3', '流行音乐,', '2127731463_581265453_1651073686.jpg', '', '', '0000-00-00', 0, 4971074, 0, '2017-04-24 07:06:52', 1, 0, 0, 2),
(10, 1, '爱拼才会赢 - 叶启田', '《爱拼才会赢》是有其深刻社会背景的，从台湾社会来说，社会刚刚开放，就是所谓的“解严”，人们就好象放飞的鸟，一下能自由自在的在天空翱翔，人们都有在事业上奋斗一翻的想法，所以在开放初期与人们的心态吻合。', '1466963365_853557495_1176800778.mp3', '流行音乐,', '26921034_526982833_239514193.jpg', '', '', '0000-00-00', 0, 4087727, 0, '2017-04-24 07:09:09', 1, 0, 0, 2),
(11, 1, '李行亮 - 回忆里的那个人', '路灯下的恋人\r\n多像是曾经的我们\r\n深情拥抱亲吻\r\n爱的难舍又难分\r\n曾相爱的光阴\r\n全世界只有两个人\r\n为何一个转身\r\n就能变成陌路人\r\n藏在我回忆里的那个人\r\n愿你现在过得幸福安稳\r\n若再相遇人海黄昏\r\n你是否还记得我的眼神\r\n藏在我回忆里的那个人\r\n有你我的青春才算完整\r\n感谢曾经你的认真\r\n让我知道爱一个人会奋不顾身\r\n路灯下的恋人\r\n多像是曾经的我们\r\n深情拥抱亲吻\r\n爱的难舍又难分\r\n曾相爱的光阴\r\n全世界只有两个人\r\n为何一个转身\r\n就能变成陌路人\r\n藏在我回忆里的那个人\r\n愿你现在过得幸福安稳\r\n若再相遇人海黄昏\r\n你是否还记得我的眼神\r\n藏在我回忆里的那个人\r\n有你我的青春才算完整\r\n感谢曾经你的认真\r\n让我知道爱一个人会奋不顾身\r\n藏在我回忆里的那个人\r\n愿你现在过得幸福安稳\r\n若再相遇人海黄昏\r\n你是否还记得我的眼神\r\n藏在我回忆里的那个人\r\n有你我的青春才算完整\r\n感谢曾经你的认真\r\n让我知道爱一个人会奋不顾身\r\n让我知道爱一个人会奋不顾身', '92737552_220053978_1244626149.mp3', '流行音乐,', '1092422884_2126808720_2090449781.jpg', '', '', '0000-00-00', 0, 3705132, 0, '2017-04-24 07:35:44', 1, 0, 0, 1),
(12, 2, '梦中的额吉(蒙) - 乌达木', '《梦中的额吉》是一首是由蒙古国人作词、作曲的一首歌曲，原本传唱于蒙古国，蒙古国歌星吉布呼楞演唱的版本最为著名，另有五彩呼伦贝尔儿童合唱团的巴特尔·道尔吉、 杜宏达、孙布日、恩和巴雅勒格、阿迪亚等演唱过。因在中国达人秀节目上，出现了一个蒙古族男孩——乌达木，以这首《梦中的额吉》感动了所有观众和评委，演出视频在网上传开后，又有许多的人被这个小男孩感动，这支歌又一次被广泛传唱。', '749360039_1293546939_1688283292.mp3', '流行音乐,', '269024900_1530613858_1268987270.jpg', '', '', '0000-00-00', 0, 3961502, 0, '2017-04-24 07:55:11', 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idu` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) NOT NULL DEFAULT '',
  `city` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `facebook` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `twitter` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gplus` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `youtube` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `vimeo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tumblr` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `soundcloud` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `myspace` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastfm` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `private` int(11) NOT NULL DEFAULT '0',
  `suspended` int(11) NOT NULL DEFAULT '0',
  `salted` varchar(256) NOT NULL DEFAULT '',
  `cover` varchar(128) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL DEFAULT '0',
  `offline` tinyint(4) NOT NULL DEFAULT '0',
  `ip` varchar(45) NOT NULL,
  `notificationl` tinyint(4) NOT NULL,
  `notificationc` tinyint(4) NOT NULL,
  `notificationd` tinyint(4) NOT NULL,
  `notificationf` tinyint(4) NOT NULL,
  `email_comment` tinyint(4) NOT NULL,
  `email_like` tinyint(4) NOT NULL,
  `email_new_friend` tinyint(4) NOT NULL,
  UNIQUE KEY `id` (`idu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`idu`, `username`, `password`, `email`, `first_name`, `last_name`, `country`, `city`, `website`, `description`, `date`, `facebook`, `twitter`, `gplus`, `youtube`, `vimeo`, `tumblr`, `soundcloud`, `myspace`, `lastfm`, `image`, `private`, `suspended`, `salted`, `cover`, `gender`, `online`, `offline`, `ip`, `notificationl`, `notificationc`, `notificationd`, `notificationf`, `email_comment`, `email_like`, `email_new_friend`) VALUES
(1, 'mmmmmm', '9aee390f19345028f03bb16c588550e1', 'admin@gmail.com', ' Ames', 'Chris', 'China', '重庆市', 'https://item.taobao.com/item.htm?spm=a1z10.5-c.w4002-13420503034.31.zdjDsY&id=538033949323', '在读书学习的道路上，没有捷径可走，也没有顺风船可驶，如果你想要在广博的书山、学海中汲取更多更广的知识', '2017-04-23', '5937764456', '', '', '', '', '', '', '', '', '1393451149_412046753_1204604737.jpg', 0, 0, '', '1609703772_2066634046_386421028.jpg', 0, 1493020863, 0, '::1', 1, 1, 1, 1, 1, 1, 1),
(2, 'shanjun', '9b541bc9277370ca9db526f79051a427', '1990672233@qq.com', '文静', '', 'Armenia', '重庆市', 'http://weibo.com/5937764456/profile?rightmod=1&wvr=6&mod=personinfo', '一分耕耘一分收获学海无涯苦作舟', '2017-04-24', '', '', '', '', '', '', '', '', '', '898030181_957460358_1868948580.jpg', 0, 0, '', '967271045_578536480_1877783790.jpg', 0, 1493021072, 0, '::1', 1, 1, 1, 1, 1, 1, 1),
(3, 'nnnnnn', '4c8b40018f893d4384fcfe60302cb46a', '602832901@qq.com', '', '', '', '', '', '', '2017-04-24', '', '', '', '', '', '', '', '', '', 'default.png', 0, 0, '', 'default.png', 0, 1493021151, 0, '::1', 1, 1, 1, 1, 1, 1, 1),
(4, 'hjl416148489', 'ba7f771fafe132c390b0a020eb1981e3', '416148489@qq.com', '', '', '', '', '', '', '2017-11-21', '', '', '', '', '', '', '', '', '', 'default.png', 0, 0, '', 'default.png', 0, 1511233435, 0, '127.0.0.1', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` int(11) NOT NULL,
  `track` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `views`
--

INSERT INTO `views` (`id`, `by`, `track`, `time`) VALUES
(1, 1, 1, '2017-04-23 06:27:03'),
(2, 1, 1, '2017-04-23 06:29:32'),
(3, 1, 1, '2017-04-24 01:29:58'),
(4, 1, 1, '2017-04-24 01:41:02'),
(5, 1, 2, '2017-04-24 02:01:03'),
(6, 1, 1, '2017-04-24 02:04:42'),
(7, 1, 1, '2017-04-24 02:57:26'),
(8, 1, 1, '2017-04-24 03:36:18'),
(9, 1, 1, '2017-04-24 04:02:53'),
(10, 1, 1, '2017-04-24 06:24:26'),
(11, 1, 3, '2017-04-24 06:32:41'),
(12, 1, 4, '2017-04-24 06:38:27'),
(13, 1, 5, '2017-04-24 06:48:05'),
(14, 1, 4, '2017-04-24 06:48:13'),
(15, 1, 10, '2017-04-24 07:23:27'),
(16, 1, 7, '2017-04-24 07:28:42'),
(17, 1, 11, '2017-04-24 07:35:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
