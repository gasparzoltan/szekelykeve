var edit = new Vue({
	el: '#edit-article',
	data: {
		btnClearImage: false,
		image: '',
		imgSrc: ''			
	},

	methods: {
		imageChanged(e) {
			console.log(e.target.files[0]);
			var fileReader = new FileReader();

			fileReader.readAsDataURL(e.target.files[0]);

			fileReader.onload = (e) => {
			  this.image = e.target.result;
			  console.log(this.image);
			};					
		},

		onImageRemove(namedRouteToDeleteImage) {
			axios.post(namedRouteToDeleteImage, {});
			this.image = '';
			this.imgSrc = '';
			document.getElementById('newImage').value = '';
		},

		onClearImage() {
			this.image = '';
			document.getElementById('newImage').value = '';
		},		

		checkForImage()
		{
			var src = document.getElementById('oldImage').value;
			if(src != '') {
				if (src.indexOf('http') > -1)
				{					
					this.imgSrc = src;
				} else {
					this.imgSrc = '/images/article/' + src;
				}				
				
			} else {
				this.imgSrc = '';
			}
		}

	},

	watch: {
		'image'() {
			if(this.image !== '') {
				this.btnClearImage = true;	
				this.imgSrc = this.image;
			} else {
				this.btnClearImage = false;
				this.imgSrc = '';
			}
		}
	}	
})


edit.checkForImage();




