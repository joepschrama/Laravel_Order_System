<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use Illuminate\Support\Facades\Hash;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::all();

        return view('table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.create');
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
            'table_nr' => ['required', 'string', 'max:3'],
            'table_seats' => ['required', 'string', 'max:3'],
        ]);
        $table = new Table([
            'table_nr' => $request->get('table_nr'),
            'amount_of_seats' => $request->get('table_seats'),
        ]);
        $table->save();

        return redirect('/table')->with('success', 'Table has been added');
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
    public function edit(Table $table)
    {
        return view('table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'table_nr' => ['required', 'string', 'max:3'],
            'table_seats' => ['required', 'string', 'max:3'],
        ]);
        
        $table->table_nr = $request->get('table_nr');
        $table->amount_of_seats = $request->get('table_seats');
        $table->save();

        return redirect('/table')->with('success', 'Table has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect('/table')->with('success', 'Table has been deleted');
    }
}
