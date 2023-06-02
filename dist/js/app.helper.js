

var jshelper = new function () {
	/**** Notification ******/
    this.alert = function (message) {
           $.toast({
				heading: 'Information',
				text: message,
				position: 'top-right',
				loaderBg:'#ff6849',
				icon: 'info',
				hideAfter: 3000, 
				stack: 6
			  });
			return false;
    }
	
    this.error = function (message) {
		$.toast({
				heading: 'Error',
				text: message,
				position: 'top-right',
				loaderBg:'#ff6849',
				icon: 'error',
				hideAfter: 3500
		  });
        return false;
    }	
	
    this.complete = function (message) {
	   $.toast({
			heading: 'Complete',
			text: message,
			position: 'top-right',
			loaderBg:'#ff6849',
			icon: 'success',
			hideAfter: 3500, 
			stack: 6
		});
        return false;
    }	
	
    this.warning = function (message) {
	   $.toast({
			heading: 'Warning',
			text: message,
			position: 'top-right',
			loaderBg:'#ff6849',
			icon: 'warning',
			hideAfter: 3500, 
			stack: 6
		});
        return false;
    }		
	/**** End Notification ******/

	
	
	/** Utiity **/
	function formatter(value,digit) {
		if(typeof digit == "undefined"){digit=0;}			
		value = (value == '') ? '0' : value.replace(/,/g, '');
		var num = $.isNumeric(value) ? parseFloat(value) : 0;
		return num.toFixed(digit).replace(/./g, function (c, i, a) {
			return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
		});
	}	
	
    this.formatnumber = function (num) {//convert 1234 -> 1,234  for display
        return formatter(num.toString());
    }
    this.formatnumber = function (num,digit) {//convert 1234 -> 1,234  for display
        return formatter(num.toString(),digit);
    }
	
    this.inputnumber = function (id, num) {   //convert 1234 -> 1,234.00  for input text
        $(id).val(formatter(num));
    }
    this.inputnumber = function (id, num,digit) { //convert 1234 -> 1,234.00  for input text
        $(id).val(formatter(num,digit));
    }

    this.tonumber = function (num) {
		num =  (num === undefined)?"0":num;
		var value = (num == '') ? 0: num.replace(/\,/g, '');
		var result = $.isNumeric(value) ? parseFloat(value) : 0;
		return isNaN(result) ? 0 : result;
    }
	

    this.formatsysdate = function (datestring) {
        var date;
        var arrdate = datestring.split("/");
        if (arrdate.length = 3) {
            return arrdate[2] + "/" + arrdate[1] + "/" + arrdate[0];
        } else {
            return '';
        }
    }

	this.round = function (value, digits) {
	  return Number(Math.round(value+'e'+digits)+'e-'+digits);
	}

    this.todate = function (datestring) {
        var date;
        var arrdate = datestring.split("/");
        if (arrdate.length = 3) {
            date = new Date(arrdate[2] + " " + arrdate[1] + " " + arrdate[0]);
            return date.toLocaleDateString("en-GB");
        } else {
            return null;
        }
    }

    this.caldiscount = function (price, discrate) {
        var discamt = price;
        if (discrate.length > 0) {
            var arrdisc = discrate.split('+');
            arrdisc.forEach(function (disc) {
                if (disc.indexOf('%') > 0) {
                    var d = parseFloat(disc.replace('%', ''));
                    var x = (discamt * d) / 100;
                    discamt = discamt - (x.toFixed(2));
                } else {
                    discamt = discamt - parseFloat(disc);
                }
            });
        }
        return discamt;
    }



    this.toint = function (num) {
        var value = (num == '') ? 0 : num.replace(/\,/g, '');
        var result = $.isNumeric(value) ? parseInt(value) : 0;
        return isNaN(result) ? 0 : result;
    }

    this.submitsave = function (data, sourceurl, desturl) {
        $.ajax({
            type: 'POST',
            url: sourceurl,
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
                if (result = 'success') {
                    kratai.complete('บันทึกข้อมูลเรียบร้อยแล้ว');
                    window.location.href = desturl;
                }
            }
        });
    }

    this.submitdelete = function (data, sourceurl, desturl) {
        $.ajax({
            type: 'POST',
            url: sourceurl,
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
                if (result = 'success') {
                    kratai.complete('ลบข้อมูลเรียบร้อยแล้ว');
                    window.location.href = desturl;
                }
            }
        });
    }


    this.submit = function (data, sourceurl, desturl) {
        $.ajax({
            type: 'POST',
            url: sourceurl,
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
                if (result = 'success') {
                    window.location.href = desturl;
                }
            }
        });
    }
	
	this.isemail =	function (email) {
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			return String(email).toLowerCase().match(mailformat);
	}	
		

}//js main

		