<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::latest('id')->get();
        $this->data['notebooks'] = Notebook::latest('id')->get();
        return view('admin.notebook_index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_id' => ['required', 'integer', 
                                function ($attribute, $value, $fail) {
                                    if (! Category::find($value)) {
                                        $fail('The category is invalid.');
                                    }
                                }],
            'name'        => 'required|string|max:50',
            'userid'      => 'required|integer',
            'pin'         => 'required|integer',
        ]);

        Notebook::create([
            'category_id' => $request->input('category_id'),
            'name'        => $request->input('name'),
            'userid'      => $request->input('userid'),
            'pin'         => $request->input('pin'),
        ]);

        $request->session()->flash('message', 'Notebook Saved.');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.notebooks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show(Notebook $notebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Notebook $notebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notebook $notebook)
    {
        $request->validate([
            'category_id' => ['required', 'integer', 
                                function ($attribute, $value, $fail) {
                                    if (! Category::find($value)) {
                                        $fail('The category is invalid.');
                                    }
                                }],
            'name'        => 'required|string|max:50',
            'userid'      => 'required|integer',
            'pin'         => 'required|integer',
        ]);

        $notebook->update([
            'category_id' => $request->input('category_id'),
            'name'        => $request->input('name'),
            'userid'      => $request->input('userid'),
            'pin'         => $request->input('pin'),
        ]);

        $request->session()->flash('message', 'Notebook Saved.');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.notebooks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notebook $notebook)
    {
        //
    }
}
