function set_admincp_style(css_path){
	$.cookie('admincp_style', css_path, {expires:999});
	window.location.reload();
}
