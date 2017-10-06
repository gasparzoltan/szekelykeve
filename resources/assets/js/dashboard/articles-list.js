new Vue({
	el: '#articles-list',
	data: {

	},

	methods: {
		onShowDeleteDialog(articleId) {
			$('#dialog-'+articleId).slideToggle('fast');
		},

		onHideDeleteDialog(articleId) {
			$('#dialog-'+articleId).slideUp('fast');
		},

		onDeleteArticle(articleId, route) {			
			

			axios.post(route, {})
			  .then(response => {
				$('#article-wrap-'+articleId).fadeOut('slow');
				showSuccessAlert('A cikk törölve');
				var countBadge = $('#count-badge').html();
				countBadge = countBadge - 1;
				countBadge = $('#count-badge').html(countBadge);
			  })

			  .catch(error => {
				showDangerAlert('Hoppá, ismeretlen hiba lépet fel. Szólj a SuperAdminnak');			  	
			  });			
		}
	}
});