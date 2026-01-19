<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user profile data
        $profileData = [
            'nama' => $user->nama,
            'email' => $user->email,
            'no_wa' => $user->no_wa,
            'alamat' => $user->alamat,
            'join_date' => $user->created_at->format('d F Y'),
            'masked_email' => $this->maskEmail($user->email),
            'profile_image' => $this->getProfileImage($user)
        ];
        
        return view('user.profile', compact('profileData'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        
        \Log::info('Profile update attempt', [
            'user_id' => $user->id_pelanggan,
            'request_data' => $request->except(['password', 'password_confirmation']),
            'has_file' => $request->hasFile('profile_photo')
        ]);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('pelanggan', 'email')->ignore($user->id_pelanggan, 'id_pelanggan')],
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $updateData = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_wa' => $validated['no_wa'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ];
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');
            $filename = 'profile_' . $user->id_pelanggan . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            // Create directory if not exists
            $directory = public_path('images/user/profiles');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            $photo->move($directory, $filename);
            $updateData['foto_profil'] = 'images/user/profiles/' . $filename;
            
            \Log::info('Profile photo uploaded', ['filename' => $filename]);
        }
        
        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        
        \Log::info('Updating user with data', ['update_data' => array_keys($updateData)]);
        
        $user->update($updateData);
        
        \Log::info('Profile updated successfully');
        
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
    
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        if (count($parts) != 2) return $email;
        
        $username = $parts[0];
        $domain = $parts[1];
        
        if (strlen($username) <= 3) {
            $maskedUsername = str_repeat('*', strlen($username));
        } else {
            $maskedUsername = substr($username, 0, 3) . str_repeat('*', strlen($username) - 3);
        }
        
        return $maskedUsername . '@' . $domain;
    }
    
    private function getProfileImage($user)
    {
        // Return user's uploaded photo if exists, otherwise use default
        if ($user->foto_profil && file_exists(public_path($user->foto_profil))) {
            return $user->foto_profil;
        }
        
        // Fallback to default images based on user ID
        $defaultImages = [
            'images/user/yui.jpg',
            'images/user/profile1.jpg',
            'images/user/profile2.jpg',
            'images/user/profile3.jpg'
        ];
        
        $imageIndex = $user->id_pelanggan % count($defaultImages);
        return $defaultImages[$imageIndex];
    }
}