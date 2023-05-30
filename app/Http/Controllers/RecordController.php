<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
    $records = Record::orderBy("created_at", "desc")->get();
    return view("allRecords.index", [
        "users" => $users,
        "records" => $records
    ]);
}

public function newRecord() {
    $users = User::orderBy("name")->get();
    return view("newRecord.index", [
        "users" => $users
    ]);
}

public function test() {
    $users = User::get();
    return view("newRecord.test", [
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
        $base64Image = $request->input('image');
        $image = base64_decode($base64Image);

        $filename = uniqid().'.png';

        $imagePath = storage_path('app/public/' . $filename);

        File::put($imagePath, $image);
        $userId = auth()->user()->id;
        $debtorId = $request->input("select");

            Record::create([
                "image_path" => $filename,
                "user_id" => $userId,
                "debtor_id" => $debtorId
            ]);
    }

        return redirect()->back()->with('success', 'Image saved successfully!');
    }

}
