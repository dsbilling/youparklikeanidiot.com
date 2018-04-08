/**
 *	Neon Register Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

var neonForgotPassword = neonForgotPassword || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		neonForgotPassword.$container = $("#form_forgot_password");
		neonForgotPassword.$steps = neonForgotPassword.$container.find(".form-steps");
		neonForgotPassword.$steps_list = neonForgotPassword.$steps.find(".step");
		neonForgotPassword.step = 'step-1'; // current step
		
		jQuery.validator.addMethod("realEmail", function(value, element) {
			return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value));
}, 'Please enter valid email address.');

		$.validator.addMethod("age", function (value, element) {
			if (this.optional(element)) {
				return true;
			}

			var dateOfBirth = value;
			var arr_dateText = dateOfBirth.split("/");
			var day = arr_dateText[0];
			var month = arr_dateText[1];
			var year = arr_dateText[2];

			var mydate = new Date();
			mydate.setFullYear(year, month - 1, day);

			var currdate = new Date();
			currdate.setFullYear(currdate.getFullYear() - 12);

			return currdate > mydate;

		}, 'Minimum age is set to 12. If you\'re younger, contact the staff.');
				
		neonForgotPassword.$container.validate({
			rules: {
				
				email: {
					required: true,
					email: true,
					realEmail: true
				},

				birthdate: {
					required: true,
					date: true,
					age: true
				}

			},
			
			messages: {
				
				email: {
					email: 'Please enter valid email address.'
				},
				birthdate: {
					required: 'Please confirm your birthdate.'
				}	
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
				neonForgotPassword.setPercentage(30, function()
				{
					// Lets move to 80%, meanwhile ajax data are sending and processing
					neonForgotPassword.setPercentage(80, function()
					{
						// Send data to the server
						$.ajax({
							url: baseurl + '/ajax/account/forgot/password',
							method: 'POST',
							dataType: 'json',
							data: {
								username:		$("input#username").val(),
								_token: 		$("input#_token").val()
							},
							error: function(jqXHR, exception)
							{
								if (jqXHR.status === 0) {
									console.log('Not connect.\n Verify Network.');
								} else if (jqXHR.status == 404) {
									console.log('Requested page not found. [404]');
								} else if (jqXHR.status == 500) {
									console.log('Internal Server Error [500].');
									console.log(jqXHR.responseText);
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
									toastr.error("Something went wrong, our monkies are working on it! Please let the staff know that you saw this message.", "500 - Internal Server Error", toptions);
									setTimeout(function()
									{
										//redir
									}, 5000);
								} else if (exception === 'parsererror') {
									console.log('Requested JSON parse failed.');
								} else if (exception === 'timeout') {
									console.log('Time out error.');
								} else if (exception === 'abort') {
									console.log('Ajax request aborted.');
								} else {
									console.log('Uncaught Error.\n' + jqXHR.responseText);
								}
							},
							success: function(response)
							{
								// From response you can fetch the data object retured
								var status = response.status;
								var msg = response.msg;

								console.log(status);
								console.log(msg);
								
								
								// Form is fully completed, we update the percentage
								neonForgotPassword.setPercentage(90);
								
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function()
								{

									// If login is invalid
									if(status == 'invalid')
									{
										$(".login-page").removeClass('logging-in');
										neonForgotPassword.resetProgressBar(true);
										document.getElementById("msg").innerHTML = msg;
									}
									else if(status == 'success')
									{
										neonForgotPassword.setPercentage(100);
										// Hide the description title
										$(".login-page .login-header .description").slideUp();
										
										// Hide the register form (steps)
										neonForgotPassword.$steps.slideUp('normal', function()
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
		neonForgotPassword.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var $current_step = neonForgotPassword.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonForgotPassword.$container.data('validator'),
				errors = 0;
			
			neonForgotPassword.$container.valid();
			errors = validator.numberOfInvalids();
			
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{
				var $next_step = neonForgotPassword.$steps_list.filter('#' + next_step),
					$other_steps = neonForgotPassword.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonForgotPassword.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonForgotPassword.$steps, 0.6, {css: {height: next_step_height}});
				
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
		
		neonForgotPassword.$steps_list.each(function(i, el)
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
		neonForgotPassword.$body = $(".login-page");
		neonForgotPassword.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonForgotPassword.$login_progressbar = neonForgotPassword.$body.find(".login-progressbar div");
		
		neonForgotPassword.$login_progressbar_indicator.html('0%');
		
		if(neonForgotPassword.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonForgotPassword.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonForgotPassword.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonForgotPassword.$container.find('input:first').focus();
		}
		
		
		// Functions
		$.extend(neonForgotPassword, {
			setPercentage: function(pct, callback)
			{

				var $errors_container = $(".form-login-error");
				$errors_container.hide();

				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				neonForgotPassword.$login_progressbar_indicator.html(pct);
				neonForgotPassword.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonForgotPassword.$login_progressbar.width() / neonForgotPassword.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonForgotPassword.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			},
			resetProgressBar: function(display_errors)
			{
				TweenMax.set(neonForgotPassword.$container, {css: {opacity: 0}});
				
				setTimeout(function()
				{
					TweenMax.to(neonForgotPassword.$container, .6, {css: {opacity: 1}, onComplete: function()
					{
						neonForgotPassword.$container.attr('style', '');
					}});
					
					neonForgotPassword.$login_progressbar_indicator.html('0%');
					neonForgotPassword.$login_progressbar.width(0);
					
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
						//neonForgotPassword.$container.find('input[type="password"]').val('');
					}
					
				}, 800);
			}
		});
	});
	
})(jQuery, window);