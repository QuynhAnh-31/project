<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function create_room()
    {
        return view('admin.create_homestay_room');
    }

    public function add_room(Request $request)
    {
        $data = new Room();

        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;

        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back()->with('message', 'Thêm phòng homestay thành công!');
    }

    public function view_room()
    {
        $data = Room::all();
        return view('admin.view_homestay_rooms', compact('data'));
    }

    public function room_delete($id)
    {
        $data = Room::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Xóa phòng homestay thành công!');
    }

    public function room_update($id)
    {
        $data = Room::find($id);
        return view('admin.update_homestay_room', compact('data'));
    }

    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);

        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back()->with('message', 'Cập nhật thông tin phòng homestay thành công!');
    }

    public function bookings()
    {
        $data = Booking::all();
        return view('admin.homestay_bookings', compact('data'));
    }

    public function delete_booking($id)
    {
        $data = Booking::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Đã xóa đặt phòng!');
    }

    public function approve_book($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'approved';
        $booking->save();
        return redirect()->back()->with('message', 'Đã duyệt đặt phòng!');
    }

    public function reject_book($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'rejected';
        $booking->save();
        return redirect()->back()->with('message', 'Đã từ chối đặt phòng!');
    }

    public function view_gallary()
    {
        $gallary = Gallary::all();
        return view('admin.homestay_gallary', compact('gallary'));
    }

    public function upload_gallary(Request $request)
    {
        $data = new Gallary;

        $image = $request->image;

        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('gallary', $imagename);
            $data->image = $imagename;
            $data->save();
            return redirect()->back()->with('message', 'Thêm ảnh homestay thành công!');
        }
    }

    public function delete_gallary($id)
    {
        $data = Gallary::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Đã xóa ảnh!');
    }

    public function all_messages()
    {
        $data = Contact::all();
        return view('admin.homestay_messages', compact('data'));
    }

    public function send_mail($id)
    {
        $data = Contact::find($id);
        return view('admin.send_mail_to_guest', compact('data'));
    }

    public function mail(Request $request, $id)
    {
        $data = Contact::find($id);

        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'endline' => $request->endline,
        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email đã được gửi!');
    }
}
