<?php

namespace App\Http\Controllers;

use App\Helpar\JWTToken;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Backend Route
    function registration1(Request $request)
    {
        try {
            User::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "mobile" => $request->input('mobile'),
                "password" => $request->input('password'),
            ]);
            return response()->json([
                "status" => "success",
                "message" => "User registration successfully"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                // "message" => "User registration failed"
                "message" => $e->getMessage()
            ], 422);
        }
    }

    function login1(Request $request)
    {
        try {
            $count = User::where("email", "=", $request->input("email"))
                ->where("password", "=", $request->input("password"))->select("id")->first();
            if ($count !== null) {
                $token = JWTToken::createToken($request->input("email"), $count->id);
                return response()->json([
                    "status" => "success",
                    "message" => "User Login Successfully"
                ], 200)->cookie("token", $token, 60 * 24 * 30);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "Unauthenticated"
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ], 501);
        }
    }

    function send_otp1(Request $request)
    {
        // return $request->input("email");
        try {
            $email = $request->input("email");
            $otp = rand(100000, 999999);
            $count = User::where("email", "=", $email)->count();
            if ($count === 1) {
                User::where("email", "=", $email)->update(["otp" => $otp]);
                return response()->json([
                    "status" => "success",
                    "message" => "Otp send successfully, your otp is " . $otp
                ], 200);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "something went wrong"
                ], 422);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ], 422);
        }
    }

    function verify_otp1(Request $request)
    {
        try {
            $email = $request->input("email");
            $otp = $request->input("otp");
            $count = User::where("email", "=", $email)->where("otp", "=", $otp)->count();
            if ($count === 1) {
                User::where("email", "=", $email)->update(["otp" => 0]);
                $token = JWTToken::createTokenForSetPassword($request->input("email"));
                return response()->json([
                    "status" => "success",
                    "message" => "Otp Verification Successfully"
                ], 200)->cookie('token', $token, 60 * 24 * 30);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "Otp Verification Failed"
                ], 422);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ], 422);
        }
    }

    function reset_pass1(Request $request)
    {
        try {
            $email = $request->header("email");
            $password = $request->input('password');
            User::where("email", "=", $email)->update(["password" => $password]);
            return response()->json([
                "status" => "success",
                "message" => "Set new password successfully"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ], 422);
        }
    }

    function user_profile(Request $request)
    {
        $email = $request->header("email");
        $user = User::where("email", "=", $email)->first();
        return response()->json([
            "status" => "success",
            "message" => "Request Success",
            "data" => $user,
        ], 200);
    }

    function update_profile(Request $request)
    {
        try {
            $email = $request->header("email");
            $name = $request->input("name");
            $mobile = $request->input("mobile");
            $password = $request->input("password");
            User::where("email", "=", $email)->update([
                "name" => $name,
                "mobile" => $mobile,
                "password" => $password
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Request Success"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ], 422);
        }
    }







    // Pages Route
    function registration2()
    {
        return view("pages.registration");
    }

    function login2()
    {
        return view("pages.login");
    }

    function send_otp2()
    {
        return view("pages.sendOtp");
    }

    function verify_otp2()
    {
        return view("pages.verifyOtp");
    }

    function reset_pass2()
    {
        return view("pages.resetPass");
    }

    function dashboard()
    {
        return view("pages.dashboard");
    }

    function profilePage()
    {
        return view("pages.profile_form");
    }


    function logout()
    {
        return redirect("/login2")->cookie("token", "", -1);
    }
}
