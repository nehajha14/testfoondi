<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <style type="text/css">
        label.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/redirect') }}" class="btn btn-primary">Login With Google</a>
        <h2>Stacked form</h2>
         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{url('/gallery')}}"><button type="button">Click</button></a>
        <form action="#" method="post" id="register_form">
            @csrf
            <div class="form-group">
                <label for="email">First Name:</label>
                <input type="text" value="" class="form-control" placeholder="Enter First Name" name="first_name">
            </div>
            <div class="form-group">
                <label for="email">Last Name:</label>
                <input type="text" value="" class="form-control" placeholder="Enter Last Name" name="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="" class="form-control"  placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" value="" class="form-control" placeholder="Enter password" name="password">
            </div>
            <div class="form-group form-check">
                <!-- <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label> -->
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
<script type="text/javascript">
    var ajax_url = "http://localhost/testfoondi/public";
    $("#register_form").validate({
        rules: {
            first_name: {
                required: true,
                maxlength:50
            },
            last_name: {
                required: true,
                maxlength:50
            },
            email: {
                required: true,
                email: true,
                remote: ajax_url+'/checkUserEmail',
                maxlength:50
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 50
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name.",
                maxlength: "Your first name should not be greater than 50 characters."
            },
            last_name: {
                required: "Please enter last name.",
                maxlength: "Your last name should not be greater than 50 characters."
            },
            password: {
                required: "Please enter password.",
                minlength: "Your password must be at least 6 characters long."
            },
            email: {
                required: "Please enter email",
                maxlength: "Your email should not be greater than 50 characters.",
                remote: 'Email-id already registered.',
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
</html>     