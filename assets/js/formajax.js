formsubmitajax = false;

FormAjax = function ($action, $id) {
    this.action = $action;
    this.dom = $("#" + $id);
    this.params = [];
    this.files = [];
    this.add_param = function ($param, $value) {
        this.params.push([$param, $value]);
    }

    this.add_file = function ($param, $id) {
        this.files.push([$param, $id]);
    }
    this.send = function () {

        if ( formsubmitajax !== false && formsubmitajax.hasClass("sender") ) {
            console.log("!!!");
            return false;
        }

        this.dom.find(".response_error").html('');
        this.dom.find(".error_filed_msg").remove();
        this.dom.find(".error_field_value").removeClass("error_field_value");

        $params = '';

        var formData = new FormData();
        formData.append('action', this.action);

        this.params.forEach(function ($item, $i) {
            formData.append($item[0], $item[1]);
        });

        this.files.forEach(function ($item, $i) {
            jQuery.each(jQuery('#' + $item[1])[0].files, function (i, file) {
                formData.append($item[0], file);
            });
        });

        //this.dom.addClass("sender"); 
        formsubmitajax = this.dom; 
        formsubmitajax.addClass("sender");
 
        $.ajax({
            type: "POST",
            data: formData,
            url: window.ajax_url_path ,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,  
            success: function (data) {
                if (data.result === "error") {
                    if (typeof data.msg === 'string' || data.msg instanceof String) {
                        if ($(".response_error", formsubmitajax).length > 0) {
                            $(formsubmitajax).find(".response_error").html(data.msg);
                        } else {
                            $(formsubmitajax).append("<div class='response_error'>" + data.msg + "</div>");
                        }
                    }
 
                    if (data.fielderror && data.fielderror.length) {
                        $.each(data.fielderror, function ($ind, $elem) {
                            $fielderror = $(formsubmitajax).find(".field_" + $elem.field);
                            if ($fielderror.length === 0) {
                                $(formsubmitajax).find(".response_error").append($elem.msg + "<br>");
                            } else {
                                $fielderror.addClass("error_field_value");
                                $fielderror.after("<div class='error_filed_msg'>" + $elem.msg + "</div>");
                            }
                        });
                    }

                } else if (data.redirect !== undefined) {
                    window.location.href = data.redirect;
                } else if (data.msg !== undefined) { 
                  alert(data.msg);  
                }  
              console.log(formsubmitajax);
                formsubmitajax.removeClass("sender");
            }
        });
      
        
      
    }


}