<?php

namespace App\Http\Controllers\Admin;

use App\Models\Office\Office;
use App\Models\Office\OfficeType;
use App\Models\Office\Type;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Throwable;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function allTypes()
    {
        return Type::all();
    }

    public function types(Office $office)
    {
        return $office->getTypesFlatMap();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.offices.create', [
            'office_types' => Type::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $office = null;
        DB::transaction(function () use ($data, &$office) {
            $office = Office::findOrNew($data['id'] ?? null);
            $office->fill($data);
            $office->save();

            foreach ($data['types'] as $item) {
                $officeType = OfficeType::findOrNew($item['id'] ?? null);
                $officeType->fill($item);
                $officeType->office_type_id = $item['type_id'];
                $officeType->office_id = $office->id;
                $officeType->save();
            }
        });
        return Office::with('types')->find($office->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Office $office
     *
     * @return void
     * @throws Throwable
     */
    public function update(Request $request, Office $office)
    {
        $data = $request->all();

        DB::transaction(function () use ($data, $office) {
            $types = [];
            $office->update($data);

            foreach ($data['types'] as $item) {
                $officeType = OfficeType::where('id', $item['id'] ?? null)
                        ->orWhere(function (Builder $query) use ($office, $item) {
                            // ['office_id' => $office->id, 'office_type_id' => $item['type_id']]
                            $query->where('office_id', $office->id)->where('office_type_id', $item['type_id']);
                        })
                        ->first() ?? new OfficeType;

                $officeType->fill($item);
                $officeType->office_type_id = $item['type_id'];
                $officeType->office_id = $office->id;
                $officeType->save();

                $types[] = $item['type_id'];
            }

            $office->types()->sync($types);
        });
        return $office->with('types')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
