

var neonResendVerification = neonResendVerification || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		neonResendVerification.$container = $("#form_resend_verification");
		neonResendVerification.$steps = neonResendVerification.$container.find(".form-steps");
		neonResendVerification.$steps_list = neonResendVerification.$steps.find(".step");
		neonResendVerification.step = 'step-1'; // current step

		neonResendVerification.$container.validate({
			rules: {
				
				email: {
					required: true
				},

			},
			
			highlight: function(element){
				$(element).closest('.input-group').addClass('validate-has-error');
			},
			
			
			unhighlight: function(element)
			{
				$(element).closest('.input-group').removeClass('validate-has-error');
			},
			
			submitHandler: function(ev)
			{
				$(".login-page").addClass('logging-in');
				
				// We consider its 30% completed form inputs are filled
				neonResendVerification.setPercentage(30, function()
				{
					// Lets move to 80%, meanwhile ajax data are sending and processing
					neonResendVerification.setPercentage(80, function()
					{
						var toptions = {
										"closeButton": false,
										"debug": false,
										"positionClass": "toast-top-right",
										"onclick": null,
										"showDuration": "300",
										"hideDuration": "1000",
										"timeOut": "0",
										"extendedTimeOut": "0",
										"showEasing": "swing",
										"hideEasing": "linear",
										"showMethod": "fadeIn",
										"hideMethod": "fadeOut",
										"tapToDismiss": false
									};
						// Send data to the server
						$.ajax({
							url: baseurl + '/ajax/account/resendverification',
							method: 'POST',
							dataType: 'json',
							data: {
								email:					$("input#email").val(),
								_token: 				$("input#_token").val()
							},
							error: function(jqXHR, exception)
							{
								var toastrmsg = "Something went wrong, our monkies are working on it! Please let the staff know that you saw this message.";
								if (jqXHR.status === 0) {
									console.log('Not connect.\n Verify Network.');
									toastr.error(toastrmsg, "0 - Could not connect", toptions);
								} else if (jqXHR.status == 404) {
									console.log('Requested page not found. [404]');
									toastr.error(toastrmsg, "404 - Page not found", toptions);
								} else if (jqXHR.status == 500) {
									console.log('Internal Server Error [500].');
									console.log(jqXHR.responseText);
									toastr.error(toastrmsg, "500 - Internal Server Error", toptions);
								} else if (exception === 'parsererror') {
									console.log('Requested JSON parse failed.');
									toastr.error(toastrmsg, "0 - Requested JSON parse failed.", toptions);
								} else if (exception === 'timeout') {
									console.log('Time out error.');
									toastr.error(toastrmsg, "0 - Timed Out", toptions);
								} else if (exception === 'abort') {
									console.log('Ajax request aborted.');
									toastr.error(toastrmsg, "0 - Ajax Request Aborted", toptions);
								} else {
									console.log('Uncaught Error.\n' + jqXHR.responseText);
									toastr.error(toastrmsg, "999 - Uncaught Error", toptions);
								}
							},
							success: function(response)
							{
								// From response you can fetch the data object retured
								var status = response.status;
								var msg = response.msg;
								
								// Form is fully completed, we update the percentage
								neonResendVerification.setPercentage(90);
								console.log(status);
								console.log(msg);
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function()
								{

									// If login is invalid
									if(status == 'invalid')
									{
										$(".login-page").removeClass('logging-in');
										neonResendVerification.resetProgressBar(true);
										document.getElementById("msg").innerHTML = msg;
									}
									else if(status == 'success')
									{
										neonResendVerification.setPercentage(100);
										// Hide the description title
										$(".login-page .login-header .description").slideUp();
										
										// Hide the register form (steps)
										neonResendVerification.$steps.slideUp('normal', function()
										{
											// Remove loging-in state
											$(".login-page").removeClass('logging-in');
											
											// Now we show the success message
											$(".form-register-success").slideDown('normal');
											
											// You can use the data returned from response variable
										});
									};
									
								}, 1000);
							}
						});
					});
				});
			}
		});
	
		// Steps Handler
		neonResendVerification.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var $current_step = neonResendVerification.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonResendVerification.$container.data('validator'),
				errors = 0;
			
			neonResendVerification.$container.valid();
			errors = validator.numberOfInvalids();
			
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{
				var $next_step = neonResendVerification.$steps_list.filter('#' + next_step),
					$other_steps = neonResendVerification.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonResendVerification.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonResendVerification.$steps, 0.6, {css: {height: next_step_height}});
				
				TweenMax.to($current_step, .3, {css: {autoAlpha: 0}, onComplete: function()
				{
					$current_step.attr('style', '').removeClass('current');
					
					var $form_elements = $next_step.find('.form-group');
					
					TweenMax.set($form_elements, {css: {autoAlpha: 0}});
					$next_step.addClass('current');
					
					$form_elements.each(function(i, el)
					{
						var $form_element = $(el);
						
						TweenMax.to($form_element, .2, {css: {autoAlpha: 1}, delay: i * .09});
					});
					
					setTimeout(function()
					{
						$form_elements.add($next_step).add($next_step).attr('style', '');
						$form_elements.first().find('input').focus();
						
					}, 1000 * (.5 + ($form_elements.length - 1) * .09));
				}});
			}
		});
		
		neonResendVerification.$steps_list.each(function(i, el)
		{
			var $this = $(el),
				is_current = $this.hasClass('current'),
				margin = 20;
			
			if(is_current)
			{
				$this.data('height', $this.outerHeight() + margin);
			}
			else
			{
				$this.addClass('current').data('height', $this.outerHeight() + margin).removeClass('current');
			}
		});
		
		
		// Login Form Setup
		neonResendVerification.$body = $(".login-page");
		neonResendVerification.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonResendVerification.$login_progressbar = neonResendVerification.$body.find(".login-progressbar div");
		
		neonResendVerification.$login_progressbar_indicator.html('0%');
		
		if(neonResendVerification.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonResendVerification.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonResendVerification.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonResendVerification.$container.find('input:first').focus();
		}
		
		
		// Functions
		$.extend(neonResendVerification, {
			setPercentage: function(pct, callback)
			{

				var $errors_container = $(".form-login-error");
				$errors_container.hide();

				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				neonResendVerification.$login_progressbar_indicator.html(pct);
				neonResendVerification.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonResendVerification.$login_progressbar.width() / neonResendVerification.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonResendVerification.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			},
			resetProgressBar: function(display_errors)
			{
				TweenMax.set(neonResendVerification.$container, {css: {opacity: 0}});
				
				setTimeout(function()
				{
					TweenMax.to(neonResendVerification.$container, .6, {css: {opacity: 1}, onComplete: function()
					{
						neonResendVerification.$container.attr('style', '');
					}});
					
					neonResendVerification.$login_progressbar_indicator.html('0%');
					neonResendVerification.$login_progressbar.width(0);
					
					if(display_errors)
					{
						var $errors_container = $(".form-login-error");
						
						$errors_container.show();
						var height = $errors_container.outerHeight();
						
						$errors_container.css({
							height: 0
						});
						
						TweenMax.to($errors_container, .45, {css: {height: height}, onComplete: function()
						{
							$errors_container.css({height: 'auto'});
						}});
						
						// Reset password fields
						//neonResendVerification.$container.find('input[type="password"]').val('');
					}
					
				}, 800);
			}
		});
	});
	
})(jQuery, window);