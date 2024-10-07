<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|string|in:male,female,other',
                'birthdate' => 'required|date|before:-18 years',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'annual_income' => 'required|numeric|min:0',
                'preferred_location' => 'required|string|max:255',
                'radius' => 'required|integer|min:0',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'phone' => $request->phone,
                'annual_income' => $request->annual_income,
                'preferred_location' => $request->preferred_location,
                'radius' => $request->radius,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {

            Log::error('User registration failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'sometimes|required|string|max:255',
                'last_name' => 'sometimes|required|string|max:255',
                'gender' => 'sometimes|required|string|in:male,female,other',
                'birthdate' => 'sometimes|required|date|before:-18 years',
                'address' => 'sometimes|required|string|max:255',
                'phone' => 'sometimes|required|string|max:15',
                'annual_income' => 'sometimes|required|numeric|min:0',
                'preferred_location' => 'sometimes|required|string|max:255',
                'radius' => 'sometimes|required|integer|min:0',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'sometimes|required|string|min:8',
            ]);

            $user = User::findOrFail($id);

            $user->first_name = $request->input('first_name', $user->first_name);
            $user->last_name = $request->input('last_name', $user->last_name);
            $user->gender = $request->input('gender', $user->gender);
            $user->birthdate = $request->input('birthdate', $user->birthdate);
            $user->address = $request->input('address', $user->address);
            $user->phone = $request->input('phone', $user->phone);
            $user->annual_income = $request->input('annual_income', $user->annual_income);
            $user->preferred_location = $request->input('preferred_location', $user->preferred_location);
            $user->radius = $request->input('radius', $user->radius);
            $user->email = $request->input('email', $user->email);

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Update failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}