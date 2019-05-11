$(function() {

	$(window).scroll(function() {
		var scroHei = $(window).scrollTop();
		if (scroHei > 400) {
			$('.set-top').fadeIn(400);
		} else {
			$('.set-top').fadeOut(400);
		}
	})

	$('.set-top').click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
	})
})

$(document).ready(function() {
	$(".fade-out").click(function() {
		$(".fade-in").fadeIn(500); // ����
		$(".menu-zzc").fadeIn(500); // ���ֲ㵭��
		$(".fade-out").fadeOut(500); // ����
	});
	$(".fade-in").click(function() {
		$(".fade-out").fadeIn(500); // ����
		$(".menu-zzc").fadeOut(500); // ���ֲ㵭��
		$(".fade-in").fadeOut(500); // ����
	});
	$(".take-up-button").click(function() {
		$(".take-up").slideUp(200);
	});
	$(".take-up-button1").click(function() {
		$(".take-up1").slideUp(200);
	});
	$(".take-up-button2").click(function() {
		$(".take-up2").slideUp(200);
	});
	$(".take-up-button3").click(function() {
		$(".take-up3").slideUp(200);
	});
});

//����˵��ű�
function openNav() {
	document.getElementById("hide-menu").style.left = "0";
	document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
	document.getElementById("hide-menu").style.left = "-200px";
	document.body.style.backgroundColor = "white";
}


// �����˵��ű�
var acc = document.getElementsByClassName("dropdown-button");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].onclick = function() {
		this.classList.toggle("active");
		var dropdown = this.nextElementSibling;
		if (dropdown.style.maxHeight) {
			dropdown.style.maxHeight = null;
		} else {
			dropdown.style.maxHeight = dropdown.scrollHeight + "px";
		}
	}
}


// ѡ��ű�
function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";
}

// ���� id="defaultOpen" click �¼�
document.getElementById("defaultOpen").click();


// ѡ��ű�2
function openCity2(evt, cityName) {
	var i, tabcontent2, tablinks2;
	tabcontent2 = document.getElementsByClassName("tabcontent2");
	for (i = 0; i < tabcontent2.length; i++) {
		tabcontent2[i].style.display = "none";
	}
	tablinks2 = document.getElementsByClassName("tablinks2");
	for (i = 0; i < tablinks2.length; i++) {
		tablinks2[i].className = tablinks2[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";
}

// ���� id="defaultOpen" click �¼�
document.getElementById("defaultOpen2").click();
