/**
 * Scripts globais do tema Site Teste Tower.
 */
(function () {
	'use strict';

	const navigation = document.querySelector('.site-navigation');
	const menuToggle = document.querySelector('.menu-toggle');

	if (navigation && menuToggle) {
		menuToggle.addEventListener('click', () => {
			const isActive = navigation.classList.toggle('is-active');
			menuToggle.setAttribute('aria-expanded', String(isActive));
		});
	}

	/**
	 * Adiciona uma classe ao body quando a navegação é usada via teclado.
	 */
	window.addEventListener(
		'keydown',
		(event) => {
			if (event.key === 'Tab') {
				document.body.classList.add('user-is-tabbing');
			}
		},
		{ once: true },
	);
})();
