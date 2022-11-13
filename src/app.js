( function ( $ ) {
	'use strict';

	const ApplicantForm = {

		init: function () {
			this.loadElement();
			this.loadMethods();
			this.loadEvents();
		},

		loadElement: function () {
			this.$body = $( 'body' );
			this.$document = $( document );
			this.$applicantform = $( '#applicant-form' );
			this.$btns = $( '.btns' );
		},

		loadMethods: function() {

		},

		loadEvents: function() {
			let self = this;
			this.$applicantform.find( 'input[type=file]' ).on( 'change', this.uploadCv.bind( self ) );
			this.$applicantform.on( 'submit', this.submitApplication.bind( self ) );
		},

		uploadCv: function( e ) {
			let self = this;
			let $el = $( e.target );
			let $progress_bar = self.$applicantform.find( '.upload-progressbar' );
			let $cv_file_url = self.$applicantform.find( 'input[name=cv_file_url]' );
			$progress_bar.hide();
			let $progress = self.$applicantform.find( '.upload-progressbar .progress' );
			let $file_bessage = self.$applicantform.find( '.file-message' );
			let file_data = $el.prop( 'files' )[0];
			let form_data = new FormData();
			form_data.append( 'file', file_data );
			form_data.append( 'action', 'cv_upload' );
			form_data.append( 'security', applicant_form.security );
			$progress_bar.show();
			$.ajax( {
				url: applicant_form.ajaxurl,
				type: 'POST',
				contentType: false,
				processData: false,
				data: form_data,
				xhr: function () {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener( "progress", function ( evt ) {
						if ( evt.lengthComputable ) {
							var percentComplete = ( evt.loaded / evt.total ) * 100;
							$progress.css( 'width', `${percentComplete}%` );
						}
					}, false );
					return xhr;
				},
				success: function ( response ) {
					if (  response.url !== ''  ) {
						$cv_file_url.val( response.url );
						$file_bessage.text( 'Uploaded!' );
					} else {
						$file_bessage.text( 'Please upload a valid file' );
					}
				}
			} );
		},

		submitApplication: function ( e ) {
			e.preventDefault();
			let self = this;
			this.$btns.text( '' )
			let $el = $( e.target );
			let form_data = $el.serialize();
			$el.find( '.loader-container' ).addClass( 'show' );
			$.ajax( {
				url: applicant_form.ajaxurl,
				type: 'POST',
				dataType: 'json',
				processData: false,
				data: form_data,
				success: function ( response ) {
					$el.find( '.loader-container' ).html( '<p>Your Application is Submitted</p>' );
				}
			} );
		}

	}

	$( document ).ready( function () {
		ApplicantForm.init();
	} );
} )( jQuery );