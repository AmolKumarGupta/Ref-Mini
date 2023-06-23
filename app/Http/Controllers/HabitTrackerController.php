<?php

namespace App\Http\Controllers;

use App\Models\HabitTrack;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class HabitTrackerController extends Controller
{
    public function index()
    {
        return view('habit-tracker.index');
    }

    public function ajax(Request $request)
    {
        $draw = $request->draw;
        $columns = $request->columns;
        $orderBy = $columns[$request->order[0]['column']]['data'] ?? 'id';
        $orderDir = $request->order[0]['dir'];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];

        $totalRecords = HabitTrack::count();
        $totalRecordsWithFilters = HabitTrack::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->count();

        $records = HabitTrack::with('category')->orderBy($orderBy, $orderDir)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

        if ($start != 0) {
            $records->skip($start);
        }
        $records = $records->take($length);
        $records = $records->get();
        $records = $records->toArray();

        // dd($records);
        $data = [];
        foreach ($records as $record) {
            $record['formattedDate'] = Carbon::parse($record['date'])->format('d M, Y');
            $record['formattedTime'] = CarbonInterval::seconds($record['time'])->cascade()->forHumans(['short' => true]);
            $data[] = $record;
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecordsWithFilters,
            'data' => $data,
        ]);
    }
}
