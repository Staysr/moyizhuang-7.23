// JavaScript Document			//上传图片选择文件改变后刷新预览图
			$("#tjimg1").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
					console.log(reader);
				reader.onload = function () {

				$("#img_preview1").attr("src", this.result);
				$("#img_preview2").show();
					$("#pengyou_upload_input").attr('dqtj',2)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg2").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview2").attr("src", this.result);
				$("#img_preview3").show();
					$("#pengyou_upload_input").attr('dqtj',3)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg3").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview3").attr("src", this.result);
				$("#img_preview4").show();
					$("#pengyou_upload_input").attr('dqtj',4)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg4").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview4").attr("src", this.result);
				$("#img_preview5").show();
					$("#pengyou_upload_input").attr('dqtj',5)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg5").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview5").attr("src", this.result);
				$("#img_preview6").show();
					$("#pengyou_upload_input").attr('dqtj',6)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg6").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview6").attr("src", this.result);
					$("#img_preview7").show();
					$("#pengyou_upload_input").attr('dqtj',7)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg7").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview7").attr("src", this.result);
					$("#img_preview8").show();
					$("#pengyou_upload_input").attr('dqtj',8)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg8").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview8").attr("src", this.result);
					$("#img_preview9").show();
					$("#pengyou_upload_input").attr('dqtj',9)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
			$("#tjimg9").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {
				$("#img_preview9").attr("src", this.result);
					$("#pengyou_upload_input").attr('dqtj',10)
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});

