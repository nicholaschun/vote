jQuery(function(){
    jQuery("#username").validate({
        expression: "if (VAL) return true; else return false;"
        // message: "Please enter your username"
    });

    jQuery("#password").validate({
        expression: "if (VAL) return true; else return false;"

        //message: "Please enter your password"
    });
    jQuery("#fullname").validate({
        expression: "if (VAL) return true; else return false;"

        //message: "Please enter your password"
    });

});

