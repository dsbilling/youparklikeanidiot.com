/**
 *	Neon Register Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

var neonRegister = neonRegister || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		neonRegister.$container = $("#form_register");
		neonRegister.$steps = neonRegister.$container.find(".form-steps");
		neonRegister.$steps_list = neonRegister.$steps.find(".step");
		neonRegister.step = 'step-1'; // current step

		// Block the enter key, because bug thats why
		$('html').bind('keypress', function(e)
		{
			if(e.keyCode == 13)
			{
				return false;
			}
		});

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

		$.validator.addMethod(
				"regex",
				function(value, element, regexp) {
					var re = new RegExp(regexp);
					return this.optional(element) || re.test(value);
				},
				"Unsupported character. Please change your input."
		);
		
		neonRegister.$container.validate({
			rules: {
				firstname: {
					required: true,
					rangelength: [3, 25]
				},

				lastname: {
					required: true,
					rangelength: [3, 25]
				},
				
				email: {
					required: true,
					email: true,
					realEmail: true
				},
				
				username: {
					required: true,
					rangelength: [3, 30],
					regex: "^[a-zA-Z0-9]*[a-zA-Z]+[a-zA-Z0-9]*$"
				},

				birthdate: {
					required: true,
					age: true
				},
				
				password: {
					required: true,
					rangelength: [8, 64]
				},

				password_confirmation: {
					required: true,
					equalTo: "#password"
				},

				tospp: {
					required: true
				},
				
			},
			
			messages: {
				
				email: {
					email: 'Please enter valid email address.'
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
				neonRegister.setPercentage(30, function()
				{
					// Lets move to 98%, meanwhile ajax data are sending and processing
					neonRegister.setPercentage(80, function()
					{
						// set up jQuery with the CSRF token, or else post routes will fail
						$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

						// Send data to the server
						$.ajax({
							url: baseurl + '/ajax/account/register',
							method: 'POST',
							dataType: 'json',
							data: {
								firstname: 				$("input#firstname").val(),
								lastname: 				$("input#lastname").val(),
								birthdate: 				$("input#birthdate").val(),
								username: 				$("input#username").val(),
								email: 					$("input#email").val(),
								password:				$("input#password").val(),
								password_confirmation:	$("input#password_confirmation").val(),
								_token: 				$("input#_token").val()
							},
							error: function(jqXHR, exception) {
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
								
								var reg_status = response.reg_status;
								var reg_msg = response.reg_msg;
								
								
								// Form is fully completed, we update the percentage
								neonRegister.setPercentage(100);
								
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function()
								{

									// If login is invalid
									if(reg_status == 'invalid')
									{
										$(".login-page").removeClass('logging-in');
										neonRegister.resetProgressBar(true);
										document.getElementById("reg_msg").innerHTML = response.reg_msg;
									}
									else if(reg_status == 'success')
									{
										// Hide the description title
										$(".login-page .login-header .description").slideUp();
										
										// Hide the register form (steps)
										neonRegister.$steps.slideUp('normal', function()
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
		neonRegister.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var $current_step = neonRegister.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonRegister.$container.data('validator'),
				errors = 0;
			
			neonRegister.$container.valid();
			errors = validator.numberOfInvalids();
			
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{
				var $next_step = neonRegister.$steps_list.filter('#' + next_step),
					$other_steps = neonRegister.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonRegister.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonRegister.$steps, 0.6, {css: {height: next_step_height}});
				
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
		
		neonRegister.$steps_list.each(function(i, el)
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
		neonRegister.$body = $(".login-page");
		neonRegister.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonRegister.$login_progressbar = neonRegister.$body.find(".login-progressbar div");
		
		neonRegister.$login_progressbar_indicator.html('0%');
		
		if(neonRegister.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonRegister.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonRegister.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonRegister.$container.find('input:first').focus();
		}
		
		
		// Functions
		$.extend(neonRegister, {
			setPercentage: function(pct, callback)
			{
				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				neonRegister.$login_progressbar_indicator.html(pct);
				neonRegister.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonRegister.$login_progressbar.width() / neonRegister.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonRegister.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			},
			resetProgressBar: function(display_errors)
			{
				TweenMax.set(neonRegister.$container, {css: {opacity: 0}});
				
				setTimeout(function()
				{
					TweenMax.to(neonRegister.$container, .6, {css: {opacity: 1}, onComplete: function()
					{
						neonRegister.$container.attr('style', '');
					}});
					
					neonRegister.$login_progressbar_indicator.html('0%');
					neonRegister.$login_progressbar.width(0);
					
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
						neonRegister.$container.find('input[type="password"]').val('');
					}
					
				}, 800);
			}
		});
	});
	
})(jQuery, window);