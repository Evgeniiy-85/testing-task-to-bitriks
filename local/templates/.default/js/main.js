$(function(){
	$(".date").datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
	});
	
	$.ajax({
		url: "/ajax.handler.php",
		type: "POST",
		dataType: "json",
		data: ({type: "get_users_dates"}),
		success: function(dates) {
			show_dates_registration(dates);
		},
		error:function() {
			alert('ошибка');
		}
	});
	
	var selected_date = '';

	function show_dates_registration(dates) {
		$("#dates_registered_users").datepicker({
			onChangeMonthYear: function(year, month, inst) {
				month = month < 10 ? '0' + month : month;
				selected_date = '01.' + month + '.' + year;
			},
			beforeShowDay: function(d) {
				var date = $.datepicker.formatDate('dd.mm.yy', d);
				
				if ($.inArray(date, dates) != -1) {
					return [true, 'marked-date', 'user'];
				}

				return [true, ""];
			},
			onSelect: function(date, inst) {
				$('#registered-users-list tbody').html('');
				getAndShowUsers(date, 'd');
			}
		});
	}
	
	function getAndShowUsers(date, date_type) {
		$.ajax({
			url: "/ajax.handler.php",
			type: "POST",
			dataType: "json",
			data: ({type:"get_users", date: date, date_type: date_type}),
			success: function(data) {
				show_users(data);
			}
		});
	}
		
	function show_users(data) {
		if (data.length > 0) {
			$('#registered-users-list').show();
			$('#registered-users-list tbody').html('');

			var users_html = '';

			$.each(data, function() {
				users_html += '<tr>';
				users_html += '<td>' + this.NAME + '</td>';
				users_html += '<td>' + this.LAST_NAME + '</td>';
				users_html += '<td>' + this.DATE_REGISTER + '</td>';
				users_html += '</tr>';
			});

			$('.registered-users-list-box .message-unsuccessful').hide();
			$('#registered-users-list tbody').append(users_html);
		} else {
			$('#registered-users-list').hide();
			$('.registered-users-list-box .message-unsuccessful').show();
		}

	}

	$('#show_users').click(function() {
		getAndShowUsers(selected_date, 'm');
	});
});