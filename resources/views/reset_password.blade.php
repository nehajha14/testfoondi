<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    /* Styles */
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Open Sans";
        font-size: 14px;
    }

    .container {
        width: 500px;
        margin: 25px auto;
    }

    form {
        padding: 20px;
        background: #2c3e50;
        color: #fff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }
    form label,
    form input,
    form button {
        border: 0;
        margin-bottom: 3px;
        display: block;
        width: 100%;
    }
    form input {
        height: 25px;
        line-height: 25px;
        background: #fff;
        color: #000;
        padding: 0 6px;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    form button {
        height: 30px;
        line-height: 30px;
        background: #e67e22;
        color: #fff;
        margin-top: 10px;
        cursor: pointer;
    }
    form .error {
        color: #ff0000;
    }


</style>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/toastr.css')}}">

</head>
<body>
<div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 text-center">
        <form method="post" action="{{url('/user-reset-password')}}" id="userResetPassword" accept-charset="UTF-8" class="custom-form-sign-login">
          @csrf
          <input type="hidden" name="id" value="{{$id}}">
          <div class="input-group">
             <input id="user_new_password" class="form-control" type="password" placeholder="New Password" name="new_password" autocomplete="off">
          </div>
          <div class="input-group">
             <input id="confirm_reset_pass" class="form-control" type="password" placeholder="Confirm Password" name="confirm_reset_pass" autocomplete="off">
          </div>
          <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-theme submit-button-style" type="submit"><span>Reset</span>
                </button>
              </span>
               </div>
          </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="{{asset('frontend/js/toastr.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // $(document).ready(function(){
        $("#forgot_password_form").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      // first_name: "required",
      // last_name: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      // first_name: "Please enter your firstname",
      // last_name: "Please enter your lastname",
      // password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
    // })
</script>
<script>
  @if(Session::has('success'))
        $(function () {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": true,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success("{{ Session::get('success') }}");
        })
    @endif

    @if(Session::has('error'))
        $(function () {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": true,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.error("{{ Session::get('error') }}");
        })
    @endif
</script>
</html>
