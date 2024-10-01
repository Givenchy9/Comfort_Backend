<?php

namespace App\Http\Controllers;  // Ensure the correct namespace is declared

use App\Models\User;  // Import the User model
use Illuminate\Support\Facades\Hash;  // Import the Hash facade for password hashing
use Illuminate\Http\Request;  // Import the Request class
use App\Http\Controllers\Controller;  // Import the base Controller class


class UserController extends Controller
{
    public function register(Request $request)
    {
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
                'income_documents' => 'required|array', // Must be an array of files
                'income_documents.*' => 'mimes:pdf,jpeg,png|max:5120', // Each file must be a PDF, JPEG, or PNG and max 5MB
                'preferred_location' => 'required|string|max:255',
                'radius' => 'required|integer|min:0', // Radius in kilometers
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Calculate if the annual income is sufficient (assuming rent is 4x the monthly taxable income)
            $monthly_income = $request->annual_income / 12;
            $required_income = $monthly_income * 4;

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
                'password' => Hash::make($request->password), // Hash the password
            ]);

            // Handle file uploads (income documents)
            foreach ($request->income_documents as $document) {
                $document->store('income_documents', 'public');
            }

            // Return a success response
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            // Return a JSON error response if something goes wrong
            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

