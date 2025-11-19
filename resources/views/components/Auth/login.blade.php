@extends('layout.app')
<div class="container-fluid position-relative bg-white d-flex p-0">

    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Parvez</h3>
                        </a>
                        <h3>Sign In</h3>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="user email">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <a href="">Forgot Password</a>
                    </div>
                    <button onclick="submitLog()" type="button" class="btn btn-primary py-3 w-100 mb-4">Sign
                        In</button>
                    <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</div>


<script>
    async function submitLog() {

        try {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            if (email.length == 0) {
                return alert("Email is required")
            } else if (password.length == 0) {
                return alert("Password is required")
            } else {
                let res = await axios.post("/login1", {
                    email: email,
                    password: password
                })
                if (res.status == 200 && res.data['status'] === "success") {
                    alert("User Login Successfully");
                    setTimeout(function() {
                        window.location.href = "/dashboard";
                    }, 200)
                } else {
                    return alert("User Login Failed");
                }
            }
        } catch (error) {
            console.log(error);
            if (error.response.status == 401) {
                alert(error.response.data["message"]);
            } else {
                return alert(error.response.data["message"]);
            }
        }

    }
</script>
