<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function updateStatus(Request $request)
{
    $recordId = $request->input('record_id');
    $record = Record::find($recordId);

    if ($record) {
        $record->is_paid = true;
        $record->save();
    }

    return redirect()->back();
}

public function index() {
    $users = User::get();
    $records = Record::orderBy('created_at', 'desc')->get();
    return view("allRecords.index", [
        "users" => $users,
        "records" => $records
    ]);
}

public function newRecord() {
    $users = User::get();
    return view("newRecord.index", [
        "users" => $users
    ]);
}

public function create(Request $request)
{
    if ($request->file("upload-image")) {
        $debtorId = $request->input("select");
        $name = $request->file("upload-image")->getClientOriginalName();
        $userId = auth()->user()->id;
        $request->file("upload-image")->storeAs("public/", $name);
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $recordCount = DB::table('records')
        ->where('debtor_id', $debtorId)
        ->whereRaw("EXTRACT(MONTH FROM created_at) = ?", [$currentMonth])
        ->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [$currentYear])
        ->count();

        if ($recordCount >= 2) {
            $hasSoda = true;
        } else {
            $hasSoda = false;
        }

        Record::create([
            "image_path" => $name,
            "user_id" => $userId,
            "debtor_id" => $debtorId,
            "hasSoda" => $hasSoda
        ]);
    } else {
        $this->validate($request, [
            "image" => "required",
        ]);

        $imageData = $request->input('image');

        // Generate a unique filename for the image
        $filename = uniqid('image_') . '.png';
        // Save the image in the storage directory

        Storage::disk('public')->put($filename, $imageData);
            // Save the image path in the database by creating a new record

        $directory = 'storage/app/public/';
        $path = $directory . $filename;
        $userId = auth()->user()->id;

            Record::create([
                "image_path" => $filename,
                "user_id" => $userId,
                "debtor_id" => 4
            ]);
    }

        // Perform any additional actions on successful image saving
        return redirect()->back()->with('success', 'Image saved successfully!');
    }

}
