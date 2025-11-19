@extends('layout.app')
<div class="container-fluid position-relative bg-white d-flex p-0">
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>X-Bakery</h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="username">
                        <label for="name">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="user email">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="mobile" placeholder="mobile">
                        <label for="mobile">Mobile</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button onclick="submitReg()" type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign
                        Up</button>
                    <p class="text-center mb-0">Already have an Account? <a href="">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function submitReg() {
            try {
                let name = document.getElementById("name").value;
                let email = document.getElementById("email").value;
                let mobile = document.getElementById("mobile").value;
                let password = document.getElementById("password").value;

                if (name.length < 3) {
                    return alert("Name is required at least 3 character")
                } else if (email.length === 0) {
                    return alert("Email is required")
                } else if (mobile.length < 4) {
                    return alert("Mobile number is required at least 4 character")
                } else if (password.length < 4) {
                    return alert("Password is required at least 4 character")
                } else {
                    let res = await axios.post("/registration1", {
                        name: name,
                        email: email,
                        mobile: mobile,
                        password: password
                    })
                    // console.log(res);
                    if (res.status == 200 && res.data["status"] === 'success') {
                        alert("User Registration Successful");
                        setTimeout(function() {
                            window.location.href = "/login2";
                        })
                    } else {
                        return alert("User Registration Failed")
                    }
                }
            } catch (error) {
                return alert(error.message);
            }

        }
    </script>
