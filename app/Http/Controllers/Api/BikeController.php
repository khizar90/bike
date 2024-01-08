<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddBikeRequest;
use App\Http\Requests\Api\EditBikeRequest;
use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function add(AddBikeRequest $request)
    {

        $image = '';
        $customer_id_front = '';
        $customer_id_back = '';
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/bike/', $filename)) {
                $image = '/uploads/bike/' . $filename;
            }
        }

        if ($request->file('customer_id_front')) {
            $file = $request->file('customer_id_front');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/customer/front/', $filename)) {
                $customer_id_front = '/uploads/customer/front/' . $filename;
            }
        }


        if ($request->file('customer_id_back')) {
            $file = $request->file('customer_id_back');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/customer/back/', $filename)) {
                $customer_id_back = '/uploads/customer/back/' . $filename;
            }
        }


        $create = new Bike();
        $create->type = $request->type;
        $create->email = $request->email;
        $create->serial_no = $request->serial_no;
        $create->date = $request->date;
        $create->person_name = $request->person_name ?: '';
        $create->bike_name = $request->bike_name;
        $create->bike_model = $request->bike_model;
        $create->engine_number = $request->engine_number;
        $create->chassis_number = $request->chassis_number;
        $create->registration = $request->registration ?: '';
        $create->registration_name = $request->registration_name ?: '';
        $create->registration_number = $request->registration_number ?: '';
        $create->claim_book = $request->claim_book ?: '';
        $create->key_number = $request->key_number ?: '';
        $create->agency_name = $request->agency_name ?: '';
        $create->image = $image;
        $create->customer_name = $request->customer_name;
        $create->customer_phone = $request->customer_phone ?: '';
        $create->customer_address = $request->customer_address ?: '';
        $create->customer_id_card = $request->customer_id_card ?: '';
        $create->customer_id_front = $customer_id_front;
        $create->customer_id_back = $customer_id_back;
        $create->save();

        return response()->json([
            'status' => true,
            'action' =>  "Bike Added",
        ]);
    }

    public function edit(EditBikeRequest $request)
    {
        $create = Bike::find($request->bike_id);


        $image = '';
        $customer_id_front = '';
        $customer_id_back = '';
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/bike/', $filename)) {
                $image = '/uploads/bike/' . $filename;
                $create->image = $image;
            }
        }

        if ($request->file('customer_id_front')) {
            $file = $request->file('customer_id_front');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/customer/front/', $filename)) {
                $customer_id_front = '/uploads/customer/front/' . $filename;
                $create->customer_id_front = $customer_id_front;
            }
        }


        if ($request->file('customer_id_back')) {
            $file = $request->file('customer_id_back');
            $extension = $file->getClientOriginalExtension();
            $mime = explode('/', $file->getClientMimeType());
            $filename = time() . '-' . uniqid() . '.' . $extension;
            if ($file->move('uploads/customer/back/', $filename)) {
                $customer_id_back = '/uploads/customer/back/' . $filename;
                $create->customer_id_back = $customer_id_back;
            }
        }





        if ($request->has('serial_no')) {
            if ($request->serial_no != null) {
                if (Bike::where('serial_no', $request->serial_no)->where('id', '!=', $request->bike_id)->exists()) {
                    return response()->json([
                        'status' => false,
                        'action' => 'Serial No already Exists'
                    ]);
                } else {
                    $create->serial_no = $request->serial_no;
                }
            }
        }

        if ($request->has('date')) {
            $create->date = $request->date;
        }

        if ($request->has('person_name')) {
            if ($request->person_name != null) {
                $create->person_name = $request->person_name;
            }
        }


        if ($request->has('bike_name')) {
            if ($request->bike_name != null) {
                $create->bike_name = $request->bike_name;
            }
        }


        if ($request->has('bike_model')) {
            if ($request->bike_model != null) {
                $create->bike_model = $request->bike_model;
            }
        }

        if ($request->has('engine_number')) {
            if ($request->engine_number != null) {
                $create->engine_number = $request->engine_number;
            }
        }

        if ($request->has('chassis_number')) {
            if ($request->chassis_number != null) {
                $create->chassis_number = $request->chassis_number;
            }
        }

        if ($request->has('registration')) {
            if ($request->registration != null) {
                $create->registration = $request->registration;

                if ($request->registration == 'No') {
                    $create->registration_number = '';
                    $create->registration_name = '';
                }
            }
        }

        if ($request->has('registration_name')) {
            if ($request->registration_name != null) {
                $create->registration_name = $request->registration_name;
            }
        }

        if ($request->has('registration_number')) {
            if ($request->registration_number != null) {
                $create->registration_number = $request->registration_number;
            }
        }

        if ($request->has('claim_book')) {
            if ($request->claim_book != null) {
                $create->claim_book = $request->claim_book;
            }
        }

        if ($request->has('key_number')) {
            if ($request->key_number != null) {
                $create->key_number = $request->key_number;
            }
        }


        if ($request->has('agency_name')) {
            if ($request->agency_name != null) {
                $create->agency_name = $request->agency_name;
            }
        }
        if ($request->has('customer_name')) {
            if ($request->customer_name != null) {
                $create->customer_name = $request->customer_name;
            }
        }
        if ($request->has('customer_phone')) {
            if ($request->customer_phone != null) {
                $create->customer_phone = $request->customer_phone;
            }
        }
        if ($request->has('customer_address')) {
            if ($request->customer_address != null) {
                $create->customer_address = $request->customer_address;
            }
        }
        if ($request->has('customer_id_card')) {
            if ($request->customer_id_card != null) {
                $create->customer_id_card = $request->customer_id_card;
            }
        }

        $create->save();


        return response()->json([
            'status' => true,
            'action' =>  "Bike Edit",
        ]);
    }

    public function delete($id)
    {
        $find = Bike::find($id);
        if ($find) {
            $find->delete();
            if ($find->image != '') {
                $file = public_path($find->image);
                if (file_exists($file)) {
                    unlink($file); // Delete the file
                }
            }

            if ($find->customer_id_front != '') {
                $file1 = public_path($find->customer_id_front);
                if (file_exists($file1)) {
                    unlink($file1); // Delete the file
                }
            }

            if ($find->customer_id_back != '') {
                $file2 = public_path($find->customer_id_back);
                if (file_exists($file2)) {
                    unlink($file2); // Delete the file
                }
            }
            return response()->json([
                'status' => true,
                'action' =>  "Bike Deleted",
            ]);
        }
        return response()->json([
            'status' => false,
            'action' =>  "No Bike Found",
        ]);
    }

    public function home()
    {
        $all = Bike::count();
        $sold = Bike::where('type', 'sold')->count();
        $purchase = Bike::where('type', 'purchase')->count();
        return response()->json([
            'status' => true,
            'action' =>  "Home",
            'data' => array(
                'all' => $all,
                'sold' => $sold,
                'purchase' => $purchase,
            )
        ]);
    }

    public function list(Request $request)
    {
        if ($request->type == 'all') {
            $count = Bike::count();
            $all = Bike::orderBy('serial_no', 'desc')->paginate(20);
        }
        if ($request->type == 'sold') {
            $count = Bike::where('type', 'sold')->count();
            $all = Bike::where('type', 'sold')->orderBy('serial_no', 'desc')->paginate(20);
        }
        if ($request->type == 'purchase') {
            $count = Bike::where('type', 'purchase')->count();
            $all = Bike::where('type', 'purchase')->orderBy('serial_no', 'desc')->paginate(20);
        }


        return response()->json([
            'status' => true,
            'action' =>  "Home",
            'data' => array(
                'count' => $count,
                'all' => $all,
            )
        ]);
    }

    public function search(Request $request)
    {
        if ($request->type == 'sold' || $request->type == 'purchase') {

            $bikes = Bike::where('type', $request->type); // Assuming $request->type contains 'sold'


            if ($request->has('serial_no')) {
                if ($request->serial_no != null) {
                    $bikes->where('serial_no', $request->serial_no);
                }
            }

            if ($request->has('engine_number')) {
                if ($request->engine_number != null) {
                    $bikes->where('engine_number', $request->engine_number);
                }
            }

            if ($request->has('chassis_number')) {
                if ($request->chassis_number != null) {
                    $bikes->where('chassis_number', $request->chassis_number);
                }
            }

            if ($request->has('registration_name')) {
                if ($request->registration_name != null) {
                    $bikes->where('registration_name', $request->registration_name);
                }
            }



            if ($request->has('registration_number')) {
                if ($request->registration_number != null) {
                    $bikes->where('registration_number', $request->registration_number);
                }
            }

            if ($request->has('customer_phone')) {
                if ($request->customer_phone != null) {
                    $bikes->where('customer_phone', $request->customer_phone);
                }
            }

            if ($request->has('customer_id_card')) {
                if ($request->customer_id_card != null) {
                    $bikes->where('customer_id_card', $request->customer_id_card);
                }
            }



            if ($request->has('start_date') && $request->has('end_date')) {
                if ($request->start_date != null && $request->end_date != null) {
                    $bikes->whereBetween('date', [$request->start_date, $request->end_date]);
                }
            }


            if ($request->has('start_date')) {
                if ($request->start_date != null) {
                    $bikes->where('date', '>=', $request->start_date);
                }
            }

            if ($request->has('end_date')) {

                if ($request->end_date != null) {
                    $bikes->where('date', '<=', $request->end_date);
                }
            }


            $bikes = $bikes->latest()->paginate(20);

            $count = $bikes->count();

            return response()->json([
                'status' => true,
                'action' =>  "List",
                'data' => array(
                    'count' => $count,
                    'all' => $bikes
                )
            ]);
        } else {

            $bikes = Bike::query(); // Assuming $request->type contains 'sold'


            if ($request->has('serial_no')) {
                if ($request->serial_no != null) {
                    $bikes->where('serial_no', $request->serial_no);
                }
            }

            if ($request->has('engine_number')) {
                if ($request->engine_number != null) {
                    $bikes->where('engine_number', $request->engine_number);
                }
            }

            if ($request->has('chassis_number')) {
                if ($request->chassis_number != null) {
                    $bikes->where('chassis_number', $request->chassis_number);
                }
            }

            if ($request->has('registration_name')) {
                if ($request->registration_name != null) {
                    $bikes->where('registration_name', $request->registration_name);
                }
            }



            if ($request->has('registration_number')) {
                if ($request->registration_number != null) {
                    $bikes->where('registration_number', $request->registration_number);
                }
            }

            if ($request->has('customer_phone')) {
                if ($request->customer_phone != null) {
                    $bikes->where('customer_phone', $request->customer_phone);
                }
            }

            if ($request->has('customer_id_card')) {
                if ($request->customer_id_card != null) {
                    $bikes->where('customer_id_card', $request->customer_id_card);
                }
            }



            if ($request->has('start_date') && $request->has('end_date')) {
                if ($request->start_date != null && $request->end_date != null) {
                    $bikes->whereBetween('date', [$request->start_date, $request->end_date]);
                }
            }


            if ($request->has('start_date')) {
                if ($request->start_date != null) {
                    $bikes->where('date', '>=', $request->start_date);
                }
            }

            if ($request->has('end_date')) {

                if ($request->end_date != null) {
                    $bikes->where('date', '<=', $request->end_date);
                }
            }


            $bikes = $bikes->latest()->paginate(20);

            $count = $bikes->count();

            return response()->json([
                'status' => true,
                'action' =>  "List",
                'data' => array(
                    'count' => $count,
                    'all' => $bikes
                )
            ]);
        }
    }
}
