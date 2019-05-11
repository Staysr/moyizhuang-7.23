EPUBJS.filePath = appOptions.epubStatic+"js/libs/";
EPUBJS.cssPath = appOptions.epubStatic+"css/";
//避免css中图片解析；没找到图片时导致css也不加载的问题
EPUBJS.replace.cssUrls = function(_store, base, text){
	var deferred = new RSVP.defer(),
		matches = text.match(/url\(\'?\"?((?!data:)[^\'|^\"^\)]*)\'?\"?\)/g);
	if(!_store) return;
	if(!matches){
		deferred.resolve(text);
		return deferred.promise;
	}
	var promises = matches.map(function(str) {
		var full = EPUBJS.core.resolveUrl(base, str.replace(/url\(|[|\)|\'|\"]|\?.*$/g, ''));
		return _store.getUrl(full).then(function(url) {
			text = text.replace(str, 'url("'+url+'")');
		}, function(reason) {
			deferred.resolve(text); // add by warlee;
			//deferred.reject(reason);
		});
	});
	RSVP.all(promises).then(function(){
		deferred.resolve(text);
	});
	return deferred.promise;
};
EPUBJS.Unarchiver.prototype.getUrl = function(url, mime){
	var unarchiver = this;
	var deferred = new RSVP.defer();
	var decodededUrl = window.decodeURIComponent(url);
	var entry = this.zip.file(decodededUrl);
	var _URL = window.URL || window.webkitURL || window.mozURL;
	var tempUrl;
	var blob;

	//文件丢失允许继续执行
	if(!entry){
		url = appOptions.epubStatic+"OEBPS/images/cover.jpg";
		entry = this.zip.file(url);
		if(url in this.urlCache) {
			deferred.resolve(this.urlCache[url]);
			return deferred.promise;
		}
	}

	if(!entry) {
		deferred.reject({
			message : "File not found in the epub111: " + url,
			stack : new Error().stack
		});
		
		return deferred.promise;
	}
	if(url in this.urlCache) {
		deferred.resolve(this.urlCache[url]);
		return deferred.promise;
	}

	blob = new Blob([entry.asUint8Array()], {type : EPUBJS.core.getMimeType(entry.name)});
	tempUrl = _URL.createObjectURL(blob);
	deferred.resolve(tempUrl);
	unarchiver.urlCache[url] = tempUrl;
	return deferred.promise;
};

var reader=null;
$(document).ready(function(){
	reader = ePubReader(appOptions.filePath,{
		reload: false,
		restore: true, 
		generatePagination: false,
		history:false,
		contained:true
	});
	reader.book.on('book:ready', function(){
		reader.book.setStyle('fontSize',fontsize+'%')
        fonts.value='黑体'
        reader.book.setStyle('font-family','黑体')
        $('[href="'+reader.book.currentChapter.href+'"]').parent().addClass('currentChapter');
        cover_tmp=reader.book.coverUrl();
        $('#cover').attr('src',cover_tmp._result);
        setTimeout(function() {$('#cover').attr('src',cover_tmp._result);
        cpos=reader.book.spinePos+1;
        $('#chapter-name').html(''+cpos+'. '+$('[href="'+reader.book.currentChapter.href+'"]').html())
        $('#cur_pg').html(reader.book.renderer.chapterPos);
        $('#all_pg').html(reader.book.renderer.displayedPages);
        $('#pg_view').attr('style','');}, 1000);
	});
	reader.book.on('renderer:resized', function(){
        $('#cur_pg').html(reader.book.renderer.chapterPos);
        $('#all_pg').html(reader.book.renderer.displayedPages);
    });
    reader.book.on('renderer:locationChanged', function(){
        cpos=reader.book.spinePos+1;
        $('#chapter-name').html(''+cpos+'. '+$('[href="'+reader.book.currentChapter.href+'"]').html())
        $('#cur_pg').html(reader.book.renderer.chapterPos);
        $('#all_pg').html(reader.book.renderer.displayedPages);
    });
    reader.book.on('renderer:chapterDisplayed', function(){
        $('.currentChapter').removeClass('currentChapter');
        $('[href="'+reader.book.currentChapter.href+'"]').parent().addClass('currentChapter');
    });
});
function green(){
	if (isGreen){
		$('#main').attr('style','background: rgb(246,244,236);');
		isGreen=false;
	}else{
		$('#main').attr('style','background: #C7EDCC;');
		isGreen=true;
	}
}
function zoomin(){
	fontsize+=25;
	if(fontsize>250) {fontsize=250;return;}
	reader.book.setStyle('fontSize',fontsize+'%')
}
function zoomout(){
	fontsize-=25;
	if(fontsize<25) {fontsize=25;return;}
	reader.book.setStyle('fontSize',fontsize+'%')
}
function fontSet(fontFamily){
	reader.book.setStyle('font-family',fontFamily)
}