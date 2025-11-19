@extends('layout.app')
<div class="container-fluid position-relative bg-white d-flex p-0">

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <h3>Set new password</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nPass" placeholder="Otp">
                        <label for="nPass">New Password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cPass" placeholder="Otp">
                        <label for="cPass">Confirm Password</label>
                    </div>

                    <button onclick="setPass()" type="button" class="btn btn-primary py-3 w-100 mb-4">Sign
                        In</button>
                    <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function setPass() {
        try {
            let nPass = document.getElementById("nPass").value;
            let cPass = document.getElementById("cPass").value;

            if (nPass.length == 0) {
                alert("New Password is Required");
            } else if (cPass.length == 0) {
                alert("Confirm Password is Required");
            } else if (nPass !== cPass) {
                alert("New Password & Confirm Password should be the same");
            } else {
                let res = await axios.post("/reset_pass1", {
                    password: nPass
                });
                if (res.status == 200 && res.data["status"] === "success") {
                    alert("Password set successfully");
                    setTimeout(function() {
                        window.location.href = "/login2";
                    }, 200);
                } else {
                    alert("Password set failed");
                }

            }
        } catch (error) {
            return alert(error.message);
        }
    }
</script>
