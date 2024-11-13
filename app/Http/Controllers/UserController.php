<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller

{
    public function basicRegister(Request $request)
    {
        try {
            // Custom validation messages
            $customMessages = [
                'first_name.required' => 'First name is required.',
                'first_name.string' => 'First name must be a string.',
                'first_name.max' => 'First name cannot exceed 255 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.string' => 'Last name must be a string.',
                'last_name.max' => 'Last name cannot exceed 255 characters.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email address is already registered.',
                'password.required' => 'Password is required.',
                'password.string' => 'Password must be a string.',
                'password.min' => 'Password must be at least 8 characters long.',
            ];

            // Validate the request
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ], $customMessages);

            // Create the user
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Return success response
            return response()->json([
                'message' => 'Registration successful.',
                'user' => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Return generic error response for other exceptions
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function completeRegister(Request $request)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                return response()->json([
                    'message' => 'Unauthorized. Please provide a valid Bearer token.'
                ], 401);
            }

            // Validate request data
            $validator = Validator::make($request->all(), [
                'gender' => 'required|in:male,female,other',
                'birthdate' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'preferred_location' => 'nullable|string|max:255',
            ]);

            // Return validation errors
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Retrieve authenticated user
            $user = auth()->user();

            // Update user profile
            $user->update([
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'phone' => $request->phone,
                'address' => $request->address,
                'preferred_location' => $request->preferred_location,
                'registration_status' => 'complete',
            ]);

            // Return success response
            return response()->json([
                'message' => 'Profile completed successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'message' => 'An error occurred during profile completion',
                'error' => $e->getMessage()
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

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found',
            ], 404);

        } catch (\Exception $e) {
            Log::error('User deletion failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Deletion failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function info()
    {
        try {
            $users = User::all();

            return response()->json([
                'message' => 'Users retrieved successfully',
                'users' => $users
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to retrieve users: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to retrieve users',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gebruiker niet gevonden',
                'message' => $e->getMessage(),
            ], 404);
        }
    }


}