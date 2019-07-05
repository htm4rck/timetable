window.onscroll = function () {
	var window_top = window.scrollY + 1;
	if (window_top > 60) {
		document.querySelectorAll('.main_menu').forEach(menu => {
			menu.classList.add('menu_fixed');
			menu.classList.add('animated');
			menu.classList.add('fadeInDown');
		})
	} else {
		document.querySelectorAll('.main_menu').forEach(menu => {
			menu.classList.remove('menu_fixed');
			menu.classList.remove('animated');
			menu.classList.remove('fadeInDown');
		})
	}
};
