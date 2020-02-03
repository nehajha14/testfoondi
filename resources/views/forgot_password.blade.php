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
<form action="{{url('/user-send-link-forgot-password')}}" method="post" id="forgot_password_form">
    @csrf
    <div class="container">
        <h2>Forgot Password</h2>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder=""/>
        <button type="submit">Submit</button>
    </div>
</form>
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
