<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 'user') {
                $room = Room::all();
                $gallary = Gallary::all();

                return view('home.homestay_index', compact('room', 'gallary'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function home()
    {
        $room = Room::all();
        $gallary = Gallary::all();

        return view('home.homestay_index', compact('room', 'gallary'));
    }

    public function room_details($id)
    {
        $room = Room::find($id);
        return view('home.homestay_room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'date|after:startDate',
        ]);

        $data = new Booking;

        $data->room_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $isBooked = Booking::where('room_id', $id)
            ->where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date)
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('message', 'Phòng đã được đặt trong khoảng thời gian này, vui lòng chọn ngày khác.');
        } else {
            $data->start_date = $start_date;
            $data->end_date = $end_date;
            $data->save();

            return redirect()->back()->with('message', 'Đặt phòng thành công!');
        }
    }

    public function contact(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back()->with('message', 'Tin nhắn của bạn đã được gửi!');
    }

    public function our_rooms()
    {
        $room = Room::all();
        return view('home.homestay_rooms_list', compact('room'));
    }

    public function hotel_gallary()
    {
        $gallary = Gallary::all();
        return view('home.homestay_gallary', compact('gallary'));
    }

    public function contact_us()
    {
        return view('home.homestay_contact_us');
    }
}
