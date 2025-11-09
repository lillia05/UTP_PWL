<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BansusController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'rejected' => Booking::where('status', 'rejected')->count(),
        ];

        $recentBookings = Booking::with('user', 'lab')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $todayBookings = Booking::with('user', 'lab')
            ->whereDate('tanggal', today())
            ->where('status', 'approved')
            ->orderBy('waktu')
            ->get();

        return view('bansus.dashboard', compact('stats', 'recentBookings', 'todayBookings'));
    }

    public function index(Request $request)
    {
        $query = Booking::with('user', 'lab');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('lab_id')) {
            $query->where('lab_id', $request->lab_id);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $bookings = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $labs = Lab::all();

        return view('bansus.booking.index', compact('bookings', 'labs'));
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'lab');
        return view('bansus.booking.show', compact('booking'));
    }

    public function approve(Request $request, Booking $booking)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        $booking->update([
            'status' => 'approved',
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil disetujui!');
    }

    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'catatan' => 'required|string|max:500',
        ]);

        $booking->update([
            'status' => 'rejected',
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil ditolak!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bansus.bookings.index')->with('success', 'Booking berhasil dihapus permanen.');
    }

    // ==================== USER MANAGEMENT ====================

    public function users(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search by name, email, or NIM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        $stats = [
            'total' => User::count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'bansus' => User::where('role', 'bansus')->count(),
        ];

        return view('bansus.users.index', compact('users', 'stats'));
    }

    public function createUser()
    {
        return view('bansus.users.create');
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:mahasiswa,bansus',
        ];

        // Add NIM and Jurusan validation only for mahasiswa
        if ($request->role === 'mahasiswa') {
            $rules['nim'] = 'required|string|max:20|unique:users';
            $rules['jurusan'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('bansus.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function editUser(User $user)
    {
        return view('bansus.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:mahasiswa,bansus',
        ];

        // Add NIM validation only for mahasiswa
        if ($request->role === 'mahasiswa') {
            $rules['nim'] = ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)];
            $rules['jurusan'] = 'required|string|max:255';
        }

        // Password is optional on update
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('bansus.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroyUser(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri!']);
        }

        // Delete user and all their bookings (cascade)
        $user->delete();

        return redirect()->route('bansus.users.index')->with('success', 'User berhasil dihapus!');
    }
}