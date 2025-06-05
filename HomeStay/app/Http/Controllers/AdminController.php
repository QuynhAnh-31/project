<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function create_homestay()
    {
        return view('admin.create_homestay');
    }

    public function add_homestay(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $homestay = new Homestay();
        $homestay->name = $request->name;
        $homestay->description = $request->description;
        $homestay->price = $request->price;
        $homestay->wifi = $request->wifi;
        $homestay->type = $request->type;
        $homestay->location = $request->location;

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('homestay_images', $imagename);
            $homestay->image = $imagename;
        }

        $homestay->save();

        return redirect()->back()->with('success', 'Homestay added successfully!');
    }

    public function view_homestays()
    {
        $homestays = Homestay::all();
        return view('admin.view_homestays', compact('homestays'));
    }

    public function homestay_update($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('admin.update_homestay', compact('homestay'));
    }

    public function edit_homestay(Request $request, $id)
    {
        $homestay = Homestay::findOrFail($id);
        $homestay->name = $request->name;
        $homestay->description = $request->description;
        $homestay->price = $request->price;
        $homestay->wifi = $request->wifi;
        $homestay->type = $request->type;
        $homestay->location = $request->location;

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('homestay_images', $imagename);
            $homestay->image = $imagename;
        }

        $homestay->save();

        return redirect()->back()->with('success', 'Homestay updated successfully!');
    }

    public function homestay_delete($id)
    {
        $homestay = Homestay::findOrFail($id);
        $homestay->delete();
        return redirect()->back()->with('success', 'Homestay deleted successfully!');
    }

    public function bookings()
    {
        $bookings = Booking::all();
        return view('admin.bookings', compact('bookings'));
    }

    public function approve_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();
        return redirect()->back();
    }

    public function reject_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();
        return redirect()->back();
    }

    public function delete_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back();
    }

    public function view_gallery()
    {
        $galleries = Gallery::all();
        return view('admin.gallery', compact('galleries'));
    }

    public function upload_gallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gallery = new Gallery();
        $imagename = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move('gallery', $imagename);
        $gallery->image = $imagename;
        $gallery->save();

        return redirect()->back()->with('success', 'Image uploaded to gallery!');
    }

    public function delete_gallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back();
    }

    public function all_messages()
    {
        $contacts = Contact::all();
        return view('admin.all_messages', compact('contacts'));
    }

    public function send_mail($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.send_mail', compact('contact'));
    }

    public function mail(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'endline' => $request->endline,
        ];

        Notification::send($contact, new SendEmailNotification($details));

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
