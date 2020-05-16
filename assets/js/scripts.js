window.EStrap = (function (window, document, $, undefined) {
	'use strict';

	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;

	$('#slider').css({ width: slideWidth, height: slideHeight });
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	$('#slider ul li:last-child').prependTo('#slider ul');

	var app = {
		init: function () {
			$(window).on('scroll', app.handleSticky);
			$('.hamburger-btn, .nav-drawer-close').on('click', app.toggleNavDrawer);
			$('.search-icon, .close-seaarch-popup').on('click', app.toggleSearchPopup);
			$('.send-message').on('click', app.sendMessage);
			$('.click-to-copy').on('click', app.copyLink);
			$('.subscribe-form-btn').on('submit', app.subscribe);
			$('.control_prev').on('click', app.moveLeft);
			$('.control_next').on('click', app.moveRight);
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				responsiveClass: true,
				dots: false,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 2,
						nav: false
					},
					1000: {
						items: 2,
						nav: true,
						loop: false,
						margin: 20
					}
				}
			});
		},
		handleSticky: function () {
			if ($(window).scrollTop() > 600) {
				$('#main-nav').addClass('sticky-header');
			} else if ($(window).scrollTop() < 300) {
				$('#main-nav').removeClass('sticky-header');
			}
		},
		toggleNavDrawer: function () {
			var $nav_drawer = $('#nav-drawer');
			$nav_drawer.toggleClass('open');
		},
		toggleSearchPopup: function () {
			var $sidebar_menu_wrapper = $('#sidebar-menu-wrapper');
			$sidebar_menu_wrapper.toggleClass('open-sidebar');
		},
		sendMessage: function (e) {
			e.preventDefault();
			var postTitle = $(this).data('title');
			window.open('mailto:your@email.com?subject=Share Post&body="' + postTitle + '"');
		},
		copyLink: function () {
			var elem = $(this).data('link');

			var $temp = $('<input id="pastebin">');
			$('body').append($temp);
			$temp.val(elem).select();

			try {
				document.execCommand('copy');
				$temp.remove();
				window.alert('Copied current URL to clipboard!');
			} catch (err) {
				window.alert('unable to copy text');
			}
		},
		subscribe: function (e) {
			e.preventDefault();
		},
		moveLeft: function () {
			$('#slider ul').animate({
				left: + slideWidth
			}, 200, function () {
				$('#slider ul li:last-child').prependTo('#slider ul');
				$('#slider ul').css('left', '');
			});
		},
		moveRight : function() {
			$('#slider ul').animate({
				left: - slideWidth
			}, 200, function () {
				$('#slider ul li:first-child').appendTo('#slider ul');
				$('#slider ul').css('left', '');
			});
		}
	};

	$(document).ready(app.init);

	return app;

})(window, document, jQuery);
