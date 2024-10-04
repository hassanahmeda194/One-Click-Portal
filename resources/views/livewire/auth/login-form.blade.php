<div class="page" style="background:url({{asset('assets/images/images/photos/login1.jpg')}})" >
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-lg-5">
                            <div class="card p-4" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class="ps-4 pt-6 pb-2">
                                    <a class="header-brand d-flex justify-content-center" href="{{ route('Main.Dashboard') }}">
                                        <img src="{{ asset('assets/images/brand/logo-white.png') }}" class="header-brand-img custom-logo" alt="1CLick Logo" style="max-width: 120px;">
                                    </a>
                                </div>
                                <div class="p-4 pt-6 text-center">
                                    <h1 class="mb-2">One Click Portal</h1>
                                    <p class="text-muted">Sign In to your account</p>
                                </div>
                                <form action="{{ route('Auth.User') }}" method="POST" class="card-body pt-3" id="login" name="login">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Registration ID</label>
                                        <div class="input-group mb-4">
                                            <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fe fe-mail" aria-hidden="true"></i>
                                                    </span>
                                                <input class="form-control" placeholder="User ID" name="Log_ID">
                                            </div>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-4">
                                            <div class="input-group" id="Password-toggle">
                                                <a href="#" class="input-group-text" onclick="togglePasswordVisibility()">
                                                    <i id="eye-icon" class="fe fe-eye-off" aria-hidden="true"></i>
                                                </a>
                                                <input class="form-control" type="password" name="Log_Password" id="password-input" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="example-checkbox1" value="option1">
                                            <span class="custom-control-label">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="submit">
                                        <button class="btn btn-primary btn-block" type="submit">Login Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password-input");
        var eyeIcon = document.getElementById("eye-icon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fe-eye-off");
            eyeIcon.classList.add("fe-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fe-eye");
            eyeIcon.classList.add("fe-eye-off");
        }
    }
</script>
