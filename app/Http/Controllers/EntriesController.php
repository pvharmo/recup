<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Entry;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entryCollection = collect(Entry::all());
        $sortedEntryCollection = $entryCollection->sortByDesc('reception_date');

        return Inertia::render("Entries/List", [
            'entries' => $sortedEntryCollection->values()->take(100),
            'categories' => Category::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Entries/Create", [
            'categories' => Category::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required'],
            'reception_date' => ['required'],
        ]);

        Entry::create($request->all());

        return Redirect::route('entries.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render("Entries/Edit", [
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
            'entry' => Entry::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required'],
            'reception_date' => ['required'],
        ]);

        $entry = Entry::find($id);

        $entry->fill($request->all());

        $entry->save();

        return Redirect::route('entries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Entry::destroy($id);

        return Redirect::route('entries.index');
    }
}
