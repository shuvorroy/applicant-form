/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/***/ (() => {

(function ($) {
  'use strict';

  var ApplicantForm = {
    init: function init() {
      this.loadElement();
      this.loadMethods();
      this.loadEvents();
    },
    loadElement: function loadElement() {
      this.$body = $('body');
      this.$document = $(document);
      this.$applicantform = $('#applicant-form');
      this.$btns = $('.btns');
    },
    loadMethods: function loadMethods() {},
    loadEvents: function loadEvents() {
      var self = this;
      this.$applicantform.find('input[type=file]').on('change', this.uploadCv.bind(self));
      this.$applicantform.on('submit', this.submitApplication.bind(self));
    },
    uploadCv: function uploadCv(e) {
      var self = this;
      var $el = $(e.target);
      var $progress_bar = self.$applicantform.find('.upload-progressbar');
      var $cv_file_url = self.$applicantform.find('input[name=cv_file_url]');
      $progress_bar.hide();
      var $progress = self.$applicantform.find('.upload-progressbar .progress');
      var $file_bessage = self.$applicantform.find('.file-message');
      var file_data = $el.prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      form_data.append('action', 'cv_upload');
      form_data.append('security', applicant_form.security);
      $progress_bar.show();
      $.ajax({
        url: applicant_form.ajaxurl,
        type: 'POST',
        contentType: false,
        processData: false,
        data: form_data,
        xhr: function xhr() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total * 100;
              $progress.css('width', "".concat(percentComplete, "%"));
            }
          }, false);
          return xhr;
        },
        success: function success(response) {
          if (response.url !== '') {
            $cv_file_url.val(response.url);
            $file_bessage.text('Uploaded!');
          } else {
            $file_bessage.text('Please upload a valid file');
          }
        }
      });
    },
    submitApplication: function submitApplication(e) {
      e.preventDefault();
      var self = this;
      this.$btns.text('');
      var $el = $(e.target);
      var form_data = $el.serialize();
      $el.find('.loader-container').addClass('show');
      $.ajax({
        url: applicant_form.ajaxurl,
        type: 'POST',
        dataType: 'json',
        processData: false,
        data: form_data,
        success: function success(response) {
          $el.find('.loader-container').html('<p>Your Application is Submitted</p>');
        }
      });
    }
  };
  $(document).ready(function () {
    ApplicantForm.init();
  });
})(jQuery);

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/admin.scss":
/*!************************!*\
  !*** ./src/admin.scss ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/applicant-form-public": 0,
/******/ 			"assets/css/applicant-form-admin": 0,
/******/ 			"assets/css/applicant-form-public": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkapplicant_form"] = self["webpackChunkapplicant_form"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/applicant-form-admin","assets/css/applicant-form-public"], () => (__webpack_require__("./src/app.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/applicant-form-admin","assets/css/applicant-form-public"], () => (__webpack_require__("./src/app.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/applicant-form-admin","assets/css/applicant-form-public"], () => (__webpack_require__("./src/admin.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;