$(document).ready(function () {
	var count = 1;
	var title = $('span.note');
	var text = $(title).text();

	var interval = setInterval(function () {
		$(title).append('.');
		count++;
		if (count == 5) {
			$(title).text(text);
			count = 1;
		}
	}, 500);

	$("a.scroll").on('click', function (event) {

		if (this.hash !== "") {
			event.preventDefault();

			var hash = this.hash;
			var responsive = 0;
			if ($(window).width() <= 991) {
				var responsive = 50;
			}

			$('html, body').animate({
				scrollTop: $(hash).offset().top-responsive
			}, 800, function () {
			});
		}
	});

	window.onscroll = function () { scrollFunction() };

	function scrollFunction() {
		if ($(window).width() > 991) {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				$('nav.navbar').css({
					'background': '#1C2128',
					'padding': '15px 0'
				});
			} else {
				$('nav.navbar').css({
					'background': 'linear-gradient(0deg, rgba(0,0,0,0) 0%, rgba(28,33,40,1) 95%)',
					'padding': '25px 0'
				});
			}
		}
	}

	$(window).scroll(function () {
		var position = $(this).scrollTop();

		$('section').each(function () {
			var target = $(this).offset().top - 250;
			var id = $(this).attr('id');

			if (position >= target) {
				$('.navbar-nav > li > a').removeClass('active');
				$('.navbar-nav > li > a[href=\\#' + id + ']').addClass('active');
			}
		});
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})

	$('.nav-link').click(function (e) {
		if ($(window).width() <= 991) {
			$('.navbar-collapse').collapse('toggle');
		}
	});

	$('#mrkfilm').backstretch('img/portfolio/mrkfilm.jpg');
	$('#vpg').backstretch('img/portfolio/vpg.jpg');
	$('#jss').backstretch('img/portfolio/jss.jpg');
	$('#bvh').backstretch('img/portfolio/bvh.jpg');
	$('#snuverink').backstretch('img/portfolio/autosnuverink.jpg');
	$('#gazelle').backstretch('img/portfolio/gazelle.jpg');

});