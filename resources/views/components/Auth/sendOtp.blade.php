@extends('layout.app')
<div class="container-fluid position-relative bg-white d-flex p-0">

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <h3>Email Address</h3>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="user email">
                        <label for="email">Email address</label>
                    </div>

                    <button onclick="sendOtp()" type="button" class="btn btn-primary py-3 w-100 mb-4">Send Otp</button>
                    <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</div>

<script>
    async function sendOtp() {
        try {
            let email = document.getElementById("email").value;
            if (email.length == 0) {
                return alert("Email is required");
            } else {
                let res = await axios.post("/send_otp1", {
                    email: email
                })
                console.log(res);
                if (res.status == 200 && res.data["status"] === "success") {
                    alert("Otp send Successfully");
                    localStorage.setItem("email", email);
                    setTimeout(function() {
                        window.location.href = "/verify_otp2"
                    }, 200);
                } else {
                    return alert("Otp send Failed");
                }
            }
        } catch (error) {
            return alert(error.message);
        }
    }
</script>
