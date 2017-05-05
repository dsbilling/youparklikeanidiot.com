

var neonResetPassword = neonResetPassword || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		neonResetPassword.$container = $("#form_reset_password");
		neonResetPassword.$steps = neonResetPassword.$container.find(".form-steps");
		neonResetPassword.$steps_list = neonResetPassword.$steps.find(".step");
		neonResetPassword.step = 'step-1'; // current step

		// Block the enter key, because bug thats why
		$('html').bind('keypress', function(e)
		{
			if(e.keyCode == 13)
			{
				return false;
			}
		});
				
		neonResetPassword.$container.validate({
			rules: {
				
				username: {
					required: true,
				},

				password: {
					required: true,
					rangelength: [8, 64]
				},

				password_confirmation: {
					required: true,
					equalTo: "#password"
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
				neonResetPassword.setPercentage(30, function()
				{
					// Lets move to 80%, meanwhile ajax data are sending and processing
					neonResetPassword.setPercentage(80, function()
					{
						// Send data to the server
						$.ajax({
							url: baseurl + '/ajax/account/resetpassword',
							method: 'POST',
							dataType: 'json',
							data: {
								resetpassword_code:		$("input#resetpassword_code").val(),
								username: 				$("input#username").val(),
								password:				$("input#password").val(),
								password_confirmation:	$("input#password_confirmation").val(),
								_token: 				$("input#_token").val()
							},
							error: function(jqXHR, exception)
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
								var resetpw_status = response.resetpw_status;
								var resetpw_msg = response.resetpw_msg;
								
								// Form is fully completed, we update the percentage
								neonResetPassword.setPercentage(100);
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function()
								{

									// If login is invalid
									if(resetpw_status == 'invalid')
									{
										$(".login-page").removeClass('logging-in');
										document.getElementById("step-1").className = 'step current';
										document.getElementById("step-2").className = 'step';
										neonResetPassword.resetProgressBar(true);
										document.getElementById("resetpw_msg").innerHTML = resetpw_msg;
										neonResetPassword.step = 'step-1';
									}
									else if(resetpw_status == 'success')
									{
										// Hide the description title
										$(".login-page .login-header .description").slideUp();
										
										// Hide the register form (steps)
										neonResetPassword.$steps.slideUp('normal', function()
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
		neonResetPassword.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var $current_step = neonResetPassword.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonResetPassword.$container.data('validator'),
				errors = 0;
			
			neonResetPassword.$container.valid();
			errors = validator.numberOfInvalids();
			
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{
				var $next_step = neonResetPassword.$steps_list.filter('#' + next_step),
					$other_steps = neonResetPassword.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonResetPassword.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonResetPassword.$steps, 0.6, {css: {height: next_step_height}});
				
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
		
		neonResetPassword.$steps_list.each(function(i, el)
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
		neonResetPassword.$body = $(".login-page");
		neonResetPassword.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonResetPassword.$login_progressbar = neonResetPassword.$body.find(".login-progressbar div");
		
		neonResetPassword.$login_progressbar_indicator.html('0%');
		
		if(neonResetPassword.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonResetPassword.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonResetPassword.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonResetPassword.$container.find('input:first').focus();
		}
		
		
		// Functions
		$.extend(neonResetPassword, {
			setPercentage: function(pct, callback)
			{

				var $errors_container = $(".form-login-error");
				$errors_container.hide();

				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				neonResetPassword.$login_progressbar_indicator.html(pct);
				neonResetPassword.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonResetPassword.$login_progressbar.width() / neonResetPassword.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonResetPassword.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			},
			resetProgressBar: function(display_errors)
			{
				TweenMax.set(neonResetPassword.$container, {css: {opacity: 0}});
				
				setTimeout(function()
				{
					TweenMax.to(neonResetPassword.$container, .6, {css: {opacity: 1}, onComplete: function()
					{
						neonResetPassword.$container.attr('style', '');
					}});
					
					neonResetPassword.$login_progressbar_indicator.html('0%');
					neonResetPassword.$login_progressbar.width(0);
					
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
						//neonResetPassword.$container.find('input[type="password"]').val('');
					}
					
				}, 800);
			}
		});
	});
	
})(jQuery, window);