<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers    = User::where('role', 'user')->count();
        $totalAdmins   = User::where('role', 'admin')->count();
        $recentUsers   = User::where('role', 'user')->latest()->take(6)->get();
        $totalPosts    = class_exists(\App\Models\Post::class) ? \App\Models\Post::count() : 0;

        $totalBookings    = Booking::count();
        $pendingBookings  = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalServices    = Service::count();

        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(6)
            ->get();

        $bookingsByStatus = [
            'pending'   => $pendingBookings,
            'confirmed' => $confirmedBookings,
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
        ];

        $todayBookings = Booking::whereDate('created_at', today())->count();
        $weeklyBookings = Booking::whereBetween('created_at', [now()->subWeek(), now()])->count();

        return view('dashboard.admin', compact(
            'totalUsers', 'totalAdmins', 'recentUsers', 'totalPosts',
            'totalBookings', 'pendingBookings', 'confirmedBookings',
            'totalServices', 'recentBookings', 'bookingsByStatus',
            'todayBookings', 'weeklyBookings'
        ));
    }

    public function userDashboard()
    {
        $user = auth()->user();

        $myBookings       = Booking::where('user_id', $user->id)->with('service')->latest()->take(5)->get();
        $totalMyBookings  = Booking::where('user_id', $user->id)->count();
        $pendingMyBookings = Booking::where('user_id', $user->id)->where('status', 'pending')->count();
        $confirmedMyBookings = Booking::where('user_id', $user->id)->where('status', 'confirmed')->count();
        $upcomingBooking  = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('booking_date', '>=', today())
            ->orderBy('booking_date')
            ->first();

        return view('dashboard.user', compact(
            'myBookings', 'totalMyBookings', 'pendingMyBookings',
            'confirmedMyBookings', 'upcomingBooking'
        ));
    }
}
