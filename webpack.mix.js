let mix = require('laravel-mix');


 
mix.js('resources/assets/js/app.js', 'public/js')


	.js('resources/assets/js/dashboard/create-article.js', 'public/dashboard/assets/js')
	.js('resources/assets/js/dashboard/edit-article.js', 'public/dashboard/assets/js')
	.js('resources/assets/js/dashboard/articles-list.js', 'public/dashboard/assets/js')

	.sass('resources/assets/dashboard/scss/dashboard.scss', 'public/dashboard/assets/css')


	.sass('resources/assets/sass/app.scss', 'public/css');
