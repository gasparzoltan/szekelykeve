/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(39);


/***/ }),

/***/ 39:
/***/ (function(module, exports) {

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
		onUploadImages: function onUploadImages(route) {
			var _this = this;

			var form = document.getElementById('frmUpload');
			var formData = new FormData(form);

			var config = {
				onUploadProgress: function onUploadProgress(progressEvent) {
					var progress = progressEvent.loaded / progressEvent.total * 100;
					console.log(progress);
					_this.uploadProgress = progress;
				}
			};

			axios.post(route, formData, config).then(function (response) {
				console.log(response);
			}).catch(function (error) {
				console.log(error);
			});
		},
		getImages: function getImages() {
			var _this2 = this;

			axios.get(this.getImagesRoute).then(function (response) {
				_this2.imagesHtml = response.data.images;
			}).catch(function (error) {
				$("#imagesWrapper").html(error);
			});
		},
		setAsThumbnailPicture: function setAsThumbnailPicture(imgId, route) {
			axios.post(route, imgId).then(function (response) {
				console.log(response);
			}).catch(function (error) {
				console.log(error);
			});
			showSuccessAlert("Elsődleges kép hozzáadva");
		},
		setAsGalleryPicture: function setAsGalleryPicture(imgId, route) {
			axios.post(route, imgId).then(function (response) {
				console.log(response);
				//alert(response.data.msg);
			}).catch(function (error) {
				console.log(error);
			});
			showSuccessAlert("Galléria sikeresen módosítva");
		},
		deleteImage: function deleteImage(imgId, route) {
			axios.post(route, imgId).then(function (response) {
				console.log(response);
				$("#img-wrap-" + imgId).fadeOut('fast');
			}).catch(function (error) {
				console.log(error);
			});

			showSuccessAlert("Kép törölve");
		},
		saveArticle: function saveArticle(route) {
			var _this3 = this;

			this.errorMessages = [];
			var form = document.getElementById('frmArticle');
			var formData = $(form).serialize();

			console.log(formData);

			axios.post(route, formData).then(function (response) {
				showSuccessAlert(response.data.msg);
			}).catch(function (error) {

				var errorsObj = error.response.data.errors;
				for (var key in errorsObj) {
					_this3.errorMessages.push(errorsObj[key][0]);
				}

				showDangerAlert('Hoppá, ' + _this3.errorMessages[0] + '!');
			});
		}
	},

	watch: {
		'uploadProgress': function uploadProgress() {
			if (this.uploadProgress != 0) {
				this.uploadStarted = true;
			} else {
				this.uploadStarted = false;
			}

			if (this.uploadProgress == 100) {
				this.uploadProgress = 0;
				this.getImages();
				document.getElementById('images').value = '';
			}
		},
		'errorMessages': function errorMessages() {
			if (this.errorMessages.length == 0) {
				this.hasErrors = false;
			} else {
				this.hasErrors = true;
			}
		}
	}
});

edit.getImages();
$("[name='status']").bootstrapSwitch();

$(document.body).on('click', '.radThumbnail', function () {
	edit.setAsThumbnailPicture($(this).data('img-id'), $(this).data('route'));
});

$(document.body).on('click', '.chkGallery', function () {
	edit.setAsGalleryPicture($(this).data('img-id'), $(this).data('route'));
});

$(document.body).on('click', '.btnDelImg', function () {
	edit.deleteImage($(this).data('img-id'), $(this).data('route'));
});

/***/ })

/******/ });