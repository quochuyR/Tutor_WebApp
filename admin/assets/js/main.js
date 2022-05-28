(function () {
	$.noConflict();

	jQuery(document).ready(function ($) {

		"use strict";


		$('.equal-height').matchHeight({
			property: 'max-height'
		});

		// var chartsheight = $('.flotRealtime2').height();
		// $('.traffic-chart').css('height', chartsheight-122);


		// Counter Number
		$('.count').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});




		// Menu Trigger
		$('#menuToggle').on('click', function (event) {
			var windowWidth = $(window).width();
			if (windowWidth < 1010) {
				$('body').removeClass('open');
				if (windowWidth < 760) {
					$('#left-panel').slideToggle();
				} else {
					$('#left-panel').toggleClass('open-menu');
				}
			} else {
				$('body').toggleClass('open');
				$('#left-panel').removeClass('open-menu');
			}

		});


		$(".menu-item-has-children.dropdown").each(function () {
			$(this).on('click', function () {
				var $temp_text = $(this).children('.dropdown-toggle').html();
				$(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
			});
		});


		// Load Resize 
		$(window).on("load resize", function (event) {
			var windowWidth = $(window).width();
			if (windowWidth < 1010) {
				$('body').addClass('small-device');
			} else {
				$('body').removeClass('small-device');
			}

		});

		// 
		// var urls = ['/url/one','/url/two'];
		
		$.ajax({
			type: "get",
			url: "../api/getnumberuserandtutorbymonth.php",
			data: {
				// numNotification, // lấy giá trị của thuộc tính subject-id
				// offset
			},
			cache: false,
			success: function (group) {
				console.log(group)
				callbackDataTutorSuccess(group);
				

			},
			error: function (xhr, status, error) {
				console.error(xhr);
			}
		});
		
		function callbackDataTutorSuccess(group){
			console.log(group, "callback");
			// let month_tutor = group.groupByTutor.map(val =>{
			// 	return val.month
			// });
	
			let num_user = group.groupByUser.map(val =>{
				return val.num
			});
			let num_tutor = group.groupByTutor.map(val =>{
				return val.num
			});
			console.log( num_tutor, "group tutor")
			const labels = [
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December'
			];
			
	
			const data = {
				labels: labels,
				datasets: [{
					label: 'Gia sư đăng ký',
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgb(255, 99, 132)',
					data: num_user,
					borderWidth: 1
				},
				{
					label: 'Người dùng đăng ký',
					backgroundColor: 'rgba(255, 159, 64, 0.2)',
					borderColor: 'rgb(255, 159, 64)',
					data: num_tutor,
					borderWidth: 1
				}
			],
			
			};
	
			const config = {
				type: 'bar',
				data: data,
				
			};
	
			const myChart = new Chart(
				document.getElementById('tutors-chart'),
				config
			);
			// if(!data){
			// 	responseNotification = false;
			// 	return;
			// }
			// $(".list-notification").last().append(data);  
			// document.querySelector('#end-notification').scrollIntoView({behavior : "smooth",  block: 'nearest', inline: 'start'})
		}
		

		

	});

})();