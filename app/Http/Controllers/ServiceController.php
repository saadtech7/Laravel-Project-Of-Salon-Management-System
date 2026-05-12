<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Customer: view all services
    public function index()
    {
        $menServices    = Service::where('is_active', true)->where('category', 'men')->get();
        $womenServices  = Service::where('is_active', true)->where('category', 'women')->get();
        $services       = Service::where('is_active', true)->get(); // keep for backward compat
        return view('services.index', compact('services', 'menServices', 'womenServices'));
    }

    // Customer: show booking form
    public function book(Service $service)
    {
        return view('services.book', compact('service'));
    }

    // Customer: store booking
    public function storeBooking(Request $request, Service $service)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'address'      => 'required|string|max:500',
            'phone'        => 'required|digits:10',
            'notes'        => 'nullable|string|max:500',
        ]);

        Booking::create([
            'user_id'      => auth()->id(),
            'service_id'   => $service->id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'address'      => $request->address,
            'phone'        => $request->phone,
            'notes'        => $request->notes,
            'status'       => 'pending',
        ]);

        return redirect()->route('my.bookings')
            ->with('success', 'Booking confirmed! We will see you soon.');
    }

    // Customer: my bookings
    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('service')
            ->latest()
            ->get();
        return view('services.my-bookings', compact('bookings'));
    }

    // Customer: cancel booking
    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled successfully.');
    }

    // Admin: manage all services
    public function adminIndex()
    {
        $services = Service::withCount('bookings')->get();
        return view('admin.services.index', compact('services'));
    }

    // Admin: create service form
    public function create()
    {
        return view('admin.services.create');
    }

    // Admin: store service
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:5',
            'icon'        => 'nullable|string|max:100',
            'category'    => 'required|in:men,women',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service added successfully!');
    }

    // Admin: edit service form
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Admin: update service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:5',
            'icon'        => 'nullable|string|max:100',
            'category'    => 'required|in:men,women',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    // Admin: delete service
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }

    // Admin: all bookings
    public function adminBookings()
    {
        $bookings = Booking::with(['user', 'service'])->latest()->get();
        return view('admin.services.bookings', compact('bookings'));
    }

    // Admin: update booking status
    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,completed,cancelled']);
        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Booking status updated!');
    }
}
