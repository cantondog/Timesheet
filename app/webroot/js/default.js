$(function() {
	/**
	** Master Add
	**/
	// date calc functions
	function dstrToUTC(ds) {
		var dsarr = ds.split("/");
		var mm = parseInt(dsarr[0],10);
		var dd = parseInt(dsarr[1],10);
		var yy = parseInt(dsarr[2],10);
		return Date.UTC(yy,mm-1,dd,0,0,0);
	}

	function datediff(ds1,ds2) {
		var d1 = dstrToUTC(ds1);
		var d2 = dstrToUTC(ds2);
		var oneday = 86400000;
		return (d2-d1) / oneday;
	}
	// date picker range
	$( "#from" ).datepicker({
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			$( "#to" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#to" ).datepicker({
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			$( "#from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	$("#MasterGenerate").click(function(e) {
		var fromDate = $("#from").val();
		var toDate = $("#to").val();
		if(from != "" && to != "") {
			var days = datediff(fromDate,toDate);
			var thedate = fromDate;
			var datesObj = '';
			for(var i=0;i<=days;i++) {
				thedate=new Date(thedate);
				var type = "regular";
				var dayofweek = "weekday";
				////******** holidays called at the top of the file as json var 'holidays'
				if(holidays[thedate.toString("M-d-yyyy")]) {
					type = "holiday";
				}
				if(thedate.getDay() == 0 || thedate.getDay() == 6) {
					dayofweek = "weekend";
				}
				datesObj = datesObj + '{"type":"' + type + '","dayofweek":"' + dayofweek + '","datestamp":"' + thedate.toString("M-d-yyyy") + '"}';
				if(i != days) {
					datesObj = datesObj + ',';
				}
				thedate.setDate(thedate.getDate()+1);
			}
			datesObj = '{"dates":[' + datesObj + ']}';
			$("#JsonDates").val(datesObj);
			$("#PeriodStartDate").val(fromDate);
			$("#PeriodEndDate").val(toDate);
			$("#MasterAddForm").submit();
		}
		e.preventDefault();
	})

	/**
	** Holidays
	**/
	$(function() {
		$( "#HolidayDate" ).datepicker();
	});	

	/**
	** Timesheets
	**/
	function __round(n,dec) {
	    n = parseFloat(n);
	    if(!isNaN(n)){
	        if(!dec) var dec= 0;
	        var factor= Math.pow(10,dec);
	        return Math.floor(n*factor+((n*factor*10)%10>=5?1:0))/factor;
	    }else{
	        return n;
	    }
	}

    function time_difference(T1,T2) { // h:m:s
        if(T1.match(/pm|PM|p|P/)) {
            var T1pm = true;
        }
        if(T2.match(/pm|PM|p|P/)) {
            var T2pm = true;
        }
        var A1 = T1.split(/\D+/);
        if(T1pm && A1[0] != "12") {
            A1[0] = parseFloat(A1[0])+12;
        }
        A1 = (A1[0] * 60 + +A1[1]);

        var A2 = T2.split(/\D+/);
        if(T2pm && A2[0] != "12") {
            A2[0] = parseFloat(A2[0])+12;
        }
        A2 = (A2[0] * 60 + +A2[1]);

        T = ((A2 - A1)/60);
        return __round(T,2).toFixed(2);
    }

    function calculate_soft_total(row) {
		var SoftTotal = 0;
		$('.daily_totals > :input').each(function(index) {
			var row_id = $(this).attr('id').split('_');
			row_id = row_id[1]; // gives the datestamp in mm-dd-YYYY format used for each row.
			if(row_id != row) {
			    SoftTotal = parseFloat(SoftTotal) + parseFloat($(this).val());
			}
		});
		return SoftTotal;
    }

	$("#DeptSelect").change(function (e) {
		window.location = '/timesheets/check/' + $("#DeptSelect").val();
	});
	$('.timepick').timepicker({
		ampm: true
	});
	$(".icon-remove").click(function (e) {
		var row_id = $(this).attr('id').split('_');
		row_id = row_id[1]; // gives the datestamp in mm-dd-YYYY format used for each row.
		$("#D_" + row_id + "_P1I").val("");
		$("#D_" + row_id + "_P1O").val("");
		$("#D_" + row_id + "_P2I").val("");
		$("#D_" + row_id + "_P2O").val("");
		$("#D_" + row_id + "_P1I").trigger('change');
		$("#D_" + row_id + "_PTO").trigger('change');
	});
	$(".icon-hand-down").click(function (e) {
		var row_id = $(this).attr('id').split('_');
		row_id = row_id[1]; // gives the datestamp in mm-dd-YYYY format used for each row.
		var datesplit = row_id.split('-');
		var next = Date.today().set({ month: parseFloat(datesplit[0])-1, day: parseFloat(datesplit[1]), year: parseFloat(datesplit[2]) }).addDays(1).toString("M-d-yyyy");
		$("#D_" + next + "_P1I").val($("#D_" + row_id + "_P1I").val());
		$("#D_" + next + "_P1O").val($("#D_" + row_id + "_P1O").val());
		$("#D_" + next + "_P2I").val($("#D_" + row_id + "_P2I").val());
		$("#D_" + next + "_P2O").val($("#D_" + row_id + "_P2O").val());
		$("#D_" + next + "_P1I").trigger('change');
		$("#D_" + next + "_PTO").trigger('change');
	});
	$(".btn_makeup").click(function (e) {
		var row_id = $(this).attr('id').split('_');
		row_id = row_id[1]; // gives the datestamp in mm-dd-YYYY format used for each row.
		$("#D_" + row_id + "_P1I").trigger('change');
		$("#D_" + row_id + "_PTO").trigger('change');
	});
	$(".timepick").change(function (e) {
		// calculate new hours for that day.
		var row_id = $(this).attr('id').split('_');
		row_id = row_id[1]; // gives the datestamp in mm-dd-YYYY format used for each row.
		var P1I = ($.trim($("#D_" + row_id + "_P1I").val())) ? $("#D_" + row_id + "_P1I").val() : "00:00";
		var P1O = ($.trim($("#D_" + row_id + "_P1O").val())) ? $("#D_" + row_id + "_P1O").val() : "00:00";
		var P2I = ($.trim($("#D_" + row_id + "_P2I").val())) ? $("#D_" + row_id + "_P2I").val() : "00:00";
		var P2O = ($.trim($("#D_" + row_id + "_P2O").val())) ? $("#D_" + row_id + "_P2O").val() : "00:00";
		var period1 = (time_difference(P1I, P1O) > 0) ? time_difference(P1I, P1O) : 0;
		var period2 = (time_difference(P2I, P2O) > 0) ? time_difference(P2I, P2O) : 0;
		var meal_period = time_difference($("#D_" + row_id + "_P1O").val(),$("#D_" + row_id + "_P2I").val());
		meal_period = (meal_period == "NaN") ? "0.00" : meal_period;
		$("#MP_" + row_id).html(meal_period);
		$("#TimesheetMT_" + row_id).val(meal_period);
		var daily_total_hours = (parseFloat(period1) + parseFloat(period2)).toFixed(2);
		if(daily_total_hours > 0) {
			if(daily_total_hours > 8) {
				if($("#D_" + row_id + "_Makeup").is(':checked')) {
					if(daily_total_hours <= 11) {
						$("#TD_" + row_id).html(daily_total_hours); // text display of daily hours total
						$("#TimesheetDT_" + row_id).val(daily_total_hours); // hidden form value of daily total
						$("#TimesheetOT_" + row_id).val(0);
						$("#OTlabel_" + row_id).html("");
					} else {
						$("#TimesheetDT_" + row_id).val(11.00);
						// calculate OT
						var daily_ot_hours = daily_total_hours - 11;
						$("#TimesheetOT_" + row_id).val(daily_ot_hours.toFixed(2));
						$("#OTlabel_" + row_id).html(daily_ot_hours.toFixed(2));
					}
				} else {
					$("#TD_" + row_id).html("8.00");
					$("#TimesheetDT_" + row_id).val(8.00);
					// calculate OT
					var daily_ot_hours = daily_total_hours - 8;
					$("#TimesheetOT_" + row_id).val(daily_ot_hours.toFixed(2));
					$("#OTlabel_" + row_id).html(daily_ot_hours.toFixed(2));
				}
			} else {
				var new_total = parseFloat(calculate_soft_total(row_id)) + parseFloat(daily_total_hours);
				if(new_total > parseFloat($("#TimesheetMaxRegularHours").val())) {
					if($("#D_" + row_id + "_Makeup").is(':checked')) {
						$("#TD_" + row_id).html(daily_total_hours); // text display of daily hours total
						$("#TimesheetDT_" + row_id).val(daily_total_hours); // hidden form value of daily total
						$("#TimesheetOT_" + row_id).val(0);
						$("#OTlabel_" + row_id).html("");
					} else {
						var ot_this_day = new_total - parseFloat($("#TimesheetMaxRegularHours").val());
						$("#TD_" + row_id).html("0.00"); // text display of daily hours total
						$("#TimesheetDT_" + row_id).val(0); // hidden form value of daily total
						$("#TimesheetOT_" + row_id).val(ot_this_day.toFixed(2));
						$("#OTlabel_" + row_id).html(ot_this_day.toFixed(2));
					}
				} else {
					$("#TD_" + row_id).html(daily_total_hours); // text display of daily hours total
					$("#TimesheetDT_" + row_id).val(daily_total_hours); // hidden form value of daily total
					$("#TimesheetOT_" + row_id).val(0);
					$("#OTlabel_" + row_id).html("");
				}

			}
		} else {
			// set hours to zero or cleared row
			$("#TD_" + row_id).html("0.00");
			$("#TimesheetDT_" + row_id).val(0.00);
			$("#TimesheetOT_" + row_id).val(0.00);
			$("#OTlabel_" + row_id).html("");
		}
		/////// calculate timesheet total regular hours
		var TotalRegularHours = 0;
		$('.daily_totals > :input').each(function(index) {
		    TotalRegularHours = parseFloat(TotalRegularHours) + parseFloat($(this).val());
		    if(TotalRegularHours > parseFloat($("#TimesheetMaxRegularHours").val())) {
		    	$("#btnTimesheetSubmit").addClass("disabled");
		    } else {
		    	$("#btnTimesheetSubmit").removeClass("disabled");
		    }
		});
		$("#TimesheetTotalRegularHours").val(TotalRegularHours.toFixed(2));
		$("#TotalRegularHours").html(TotalRegularHours.toFixed(2));
		/////// calculate timesheet total overtime hours
		var TotalOTHours = 0;
		$('.daily_ot').each(function (e) {
			TotalOTHours = parseFloat(TotalOTHours) + parseFloat($(this).val());
		});
		$("#TimesheetTotalOT").val(TotalOTHours.toFixed(2));
		$("#TotalOTHours").html(TotalOTHours.toFixed(2));
	});

	$("#btnTimesheetSubmit").click(function (e) {
		if(parseFloat($("#TimesheetTotalRegularHours").val()) > parseFloat($("#TimesheetMaxRegularHours").val())) {
			alert("Regular hours may not exceed the total alotted for this time period (" + $("#TimesheetMaxRegularHours").val() + ").");
			e.preventDefault();
		}
	});
	
	$(".pto_taken").change(function (e) {
		var PTOTaken = 0;
		$('.pto_taken').each(function(index) {
		    if($.trim($(this).val()) != "") {
			    PTOTaken = parseFloat(PTOTaken) + parseFloat($(this).val());
		    }
		});
		$("#TimesheetTotalPTO").val(PTOTaken.toFixed(2));
		$("#TotalPTO").html(PTOTaken.toFixed(2));
	});
	$(".icon-remove").tooltip();
	$(".icon-hand-down").tooltip();

	$("#approve-all").toggle(function() {
		var checkBoxes = $("input[name=data\\[Timesheet\\]\\[approve\\]\\[\\]]");
		checkBoxes.attr("checked", !checkBoxes.attr("checked"));
	}, function() {
		var checkBoxes = $("input[name=data\\[Timesheet\\]\\[approve\\]\\[\\]]");
		checkBoxes.removeAttr('checked');
	});

	$("#ApproveChecked").click(function (e) {
		var checkBoxes = $("input[name=data\\[Timesheet\\]\\[approve\\]\\[\\]]:checked");
		if(checkBoxes.length > 0) {
			$("#TimesheetResolveForm").submit();
		} else {
			alert("Please check at least one timesheet for approval.");
		}
		e.preventDefault();
	})
    $( "#accordion" ).accordion({
        collapsible: true,
        active: false
    });

	/**
	** Timesheet Export
	**/
	$("#MasterSelect").change(function (e) {
		var location = base_url + "timesheets/export/" + $(this).val();
		window.location = location;
	})
	$("#btnDownload").click(function (e) {
		var export_id = $(this).attr("rel");
		location.href = base_url + "timesheets/export_save/" + export_id;
	});

	/**
	** Password Update
	**/
	$("#PwConfirm").keyup(function (e) {
		if($("#ChangePwPassword").val() != $("#ChangePwPasswordConfirm").val()) {
			$("#PwConfirm").removeClass("success");
			$("#PwConfirm").addClass("error");
			$(".help-inline").html('<i class="icon-thumbs-down"></i> Passwords don\'t match');
		} else {
			$("#PwConfirm").addClass("success");
			$(".help-inline").html('<i class="icon-thumbs-up"></i> Rock On!');
		}
	});
	$("#UserSelect").change(function (e) {
		$("#PwUserSelect").removeClass("error");
	})
	$("#btnUpdatePw").click(function (e) {
		if($("#UserSelect").val() == "") {
			$("#PwUserSelect").addClass("error");
			e.preventDefault();
			return false;
		}
		if(($("#ChangePwPassword").val() != $("#ChangePwPasswordConfirm").val()) || ($("#ChangePwPassword").val() == "")) {
			$("#PwConfirm").removeClass("success");
			$("#PwConfirm").addClass("error");
			$(".help-inline").html('<i class="icon-thumbs-down"></i> Passwords don\'t match');
		} else {
			$("#ChangePwUpdatePasswordForm").submit();
		}
		e.preventDefault();;
	})

/**  **/

});

