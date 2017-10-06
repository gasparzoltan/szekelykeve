edit = new Vue({
	el: '#createArticleWrapper',
	
	data: {
		key: document.getElementById('key').value,
		uploadProgress: 0,
		uploadStarted: false,
		getImagesRoute: document.getElementById('getImagesRoute').value,		
		imagesHtml: '',
		errorMessages: [],
		hasErrors: false
	},

	methods: {

		onUploadImages(route) {

			var form = document.getElementById('frmUpload');
			var formData = new FormData(form);

			const config = {
			    onUploadProgress: progressEvent => {
			    	var progress = progressEvent.loaded / progressEvent.total * 100;
			    	console.log(progress);
			    	this.uploadProgress = progress;
			    }
			}			

			axios.post(route, formData, config)
			.then(response => {
				console.log(response);
			})
			.catch(error => {
				console.log(error);
			});			
		},

		getImages() {
			axios.get(this.getImagesRoute)

			.then(response => {				
				this.imagesHtml = response.data.images;							
			})

			.catch(error => {
				$("#imagesWrapper").html(error);
			});			
		},

		setAsThumbnailPicture(imgId, route) {
			axios.post(route, imgId)
			.then(response => {
				console.log(response);				
			})
			.catch(error => {
				console.log(error);
			});				
			showSuccessAlert("Elsődleges kép hozzáadva");
		},

		setAsGalleryPicture(imgId, route) {
			axios.post(route, imgId)
			.then(response => {
				console.log(response);
				//alert(response.data.msg);
			})
			.catch(error => {
				console.log(error);
			});				
			showSuccessAlert("Galléria sikeresen módosítva");		
		},

		deleteImage(imgId, route) {
			axios.post(route, imgId)
			.then(response => {
				console.log(response);
				$("#img-wrap-"+imgId).fadeOut('fast');				
			})
			.catch(error => {
				console.log(error);
			});	

			showSuccessAlert("Kép törölve");		
		},

		saveArticle(route) {			
			this.errorMessages = []
			var form = document.getElementById('frmArticle');
			var formData = $(form).serialize();

			console.log(formData);

			axios.post(route, formData)
			.then(response => {				
				showSuccessAlert(response.data.msg);					
			})
			.catch(error => {
				
				var errorsObj = error.response.data.errors;											
				for (var key in errorsObj){							
					this.errorMessages.push(errorsObj[key][0]);					
				}		

				showDangerAlert('Hoppá, ' + this.errorMessages[0] + '!');		
		
			});				
		}
	},

	watch: {
		'uploadProgress'() {
			if(this.uploadProgress != 0) {
				this.uploadStarted  = true
			} else {
				this.uploadStarted = false;
			}

			if(this.uploadProgress == 100) {
				this.uploadProgress = 0;
				this.getImages();
				document.getElementById('images').value = '';
			}
		},

		'errorMessages'() {
			if(this.errorMessages.length == 0) {
				this.hasErrors = false;
			} else {
				this.hasErrors = true;
			}
		}
	}
});

edit.getImages();
$("[name='status']").bootstrapSwitch();

$(document.body).on('click', '.radThumbnail' ,function(){
	edit.setAsThumbnailPicture($(this).data('img-id'), $(this).data('route'));
});

$(document.body).on('click', '.chkGallery' ,function(){
	edit.setAsGalleryPicture($(this).data('img-id'), $(this).data('route'));
});

$(document.body).on('click', '.btnDelImg' ,function(){
	edit.deleteImage($(this).data('img-id'), $(this).data('route'));
});