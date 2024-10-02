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
        // Check incoming request data
        //dd($request->all());

        try {
            // Validate the input
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|string|in:male,female,other',
                'birthdate' => 'required|date|before:-18 years', // Ensure user is at least 18
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'annual_income' => 'required|numeric|min:0',
                'income_documents' => 'sometimes|array', // Must be an array of files
                'income_documents.*' => 'mimes:pdf,jpeg,png|max:5120', // Each file must be a PDF, JPEG, or PNG and max 5MB
                'preferred_location' => 'required|string|max:255',
                'radius' => 'required|integer|min:0',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Create a new user
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

            // Handle file uploads (income documents)
            if ($request->hasFile('income_documents')) {
                // Ensure it can handle both single and multiple file uploads
                foreach ($request->file('income_documents') as $document) {
                    $document->store('income_documents', 'public');
                }
            }

            // Return a success response
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return a validation error response
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('User registration failed: ' . $e->getMessage());

            // Return a general error response
            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
