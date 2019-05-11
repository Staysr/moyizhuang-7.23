/**
 * KindEditor 配置文件
 * 更多初始化参数请参阅： http://www.kindsoft.net/docs/option.html
 */

var kindeditor_options = {
	//配置编辑器的工具栏，"/"表示换行，"|"表示分隔符 (详情请参阅：http://www.kindsoft.net/docs/option.html#items)
	items : ['forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'removeformat', '|', 'emoticons'],

	//2或1或0，2时可以拖动改变宽度和高度，1时只能改变高度，0时不能拖动
	resizeType : 1,

	//指定主题风格，可设置"default"、"simple"
	themeType : 'default',

	//指定语言，可设置"en"、"zh-CN"、"zh-TW"、"ar"、"ko"、"ru"
	langType : 'zh-CN',

	//指定上传文件的服务器端程序
	uploadJson : 'js/kindeditor/php/upload_json.php',

	//指定浏览远程图片的服务器端程序
	fileManagerJson : 'js/kindeditor/php/file_manager_json.php',

	//true时鼠标放在表情上可以预览表情
	allowPreviewEmoticons : false,

	//true时显示图片上传按钮
	allowImageUpload : true,

	//true时显示Flash上传按钮
	allowFlashUpload : false,

	//true时显示视音频上传按钮
	allowMediaUpload : false,

	//true时显示文件上传按钮
	allowFileUpload	: false,

	//true时显示浏览远程服务器按钮
	allowFileManager : false,

	//true时根据 htmlTags 过滤HTML代码，false时允许输入任何代码
	filterMode: true
};