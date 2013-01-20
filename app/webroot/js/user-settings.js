$(function() {
	var timein1 = $( "#SettingTimeIn1" ),
	timeout1 = $( "#SettingTimeOut1" ),
	timein2 = $( "#SettingTimeIn2" ),
	timeout2 = $( "#SettingTimeOut2" ),
	nickname = $( "#SettingNickname" ),
	allFields = $( [] ).add( timein1 ).add( timeout1 ).add( timein2 ).add( timeout2 ).add( nickname );
    $("#SettingsAlert").hide();

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

	function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );
            updateTips( "If you're trying to update, " + n + " can't be blank." );
            return false;
        } else {
            return true;
        }
    }
    function updateTips( t ) {
    	$("#dialog-form").css('height',170);
        $("#SettingsAlert").show();
        $("#SettingsAlert")
            .text( t )
            .addClass( "alert alert-error" );
        setTimeout(function() {
            $("#SettingsAlert").removeClass( "alert alert-error", 1500 );
        }, 500 );
    }
    $('.settings_timepick').timepicker({
		ampm: true
	});
	$( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 270,
            width: 550,
            modal: true,
            buttons: [{
                id: "btnSettingsUpdate",
                text: "Update Settings",
                click: function() {
                	$("#SettingsAlert").hide();
                    var bValid = true;
                    allFields.removeClass( "alert alert-error" );
 
                    bValid = bValid && checkLength( timein1, "Time In 1", 3, 16 );
                    bValid = bValid && checkLength( timeout1, "Time Out 1", 3, 16 );
                    bValid = bValid && checkLength( timein2, "Time In 2", 3, 16 );
                    bValid = bValid && checkLength( timeout2, "Time Out 2", 3, 16 );

                    if ( bValid ) {
                    	var p1 = time_difference($(timein1).val(),$(timeout1).val());
                    	var p2 = time_difference($(timein2).val(),$(timeout2).val());
                    	var mealPeriod = time_difference($(timeout1).val(),$(timein2).val());
                    	var totalTime = parseFloat(p1) + parseFloat(p2);
                    	if(totalTime === 8) {
	                    	$("#btnSettingsUpdate").attr("disabled", "disabled");
                    		$.ajax({
							  type: "POST",
							  url: base_url + "settings/edit",
							  data: { time_in1: $("#SettingTimeIn1").val(), time_out1: $("#SettingTimeOut1").val() ,time_in2: $("#SettingTimeIn2").val(), time_out2: $("#SettingTimeOut2").val(),meal_period: mealPeriod, nickname: $("#SettingNickname").val(), user_id: $("#SettingUserId").val() }
							}).done(function( msg ) {
							  $("#dialog-message-text").html(msg);
							});
	                        $( this ).dialog( "close" );
	                        $( "#dialog-message" ).dialog( "open" );
                    	} else {
                    		$("#dialog-form").css('height',170);
                    		$("#SettingsAlert").show();
                    		$("#SettingsAlert")
                    		.text( "Your default hours must equal exactly 8" )
                    		.addClass( "alert alert-error" );
                    	}
                    }
                }
            	},
                {
                	id: "btnSettingsCancel",
                	text: "Cancel",
                	click: function() {
                    	$( this ).dialog( "close" );
                	},
                }
            ],
            close: function() {
                allFields.removeClass( "alert alert-error" );
                $("#btnSettingsUpdate").removeAttr("disabled");
            }
        });
	$( "#btnSettings" )
        .button()
        .click(function(e) {
		    $(".ui-dialog-buttonset button").each(function () {
		    	$(this).addClass('btn');
		    });
            $( "#dialog-form" ).dialog( "open" );
            e.preventDefault();
    });

    $( "#dialog-message" ).dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Ok: function() {
                $( this ).dialog( "close" );
            }
        }
    });


});