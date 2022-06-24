<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::all();
        return Response()->json($author, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Author.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidateData = $request->validate([
            'username' => 'required|max:255|min:5',
            'lastname' => 'required',
            'location'  => 'required',
        ]);

        Author::create([
            'username' => $ValidateData['username'],
            'lastname' => $ValidateData['lastname'],
            'location' => $ValidateData['location'],
        ]);

        return Response()->json(['mensaje' => 'Autor creado correctamente'],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return response()->json($author, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('Author.edit',compact('author')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Author $author)
    {
        $author ->username = $request->get('username');
        $author ->lastname = $request->get('lastname');
        $author ->location = $request->get('location');
        $author-> update();
        return response()->json(['mensaje' => 'Autor actualizado correctamente'],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return Response()->json(['mensaje' => 'Autor eliminado correctamente'],200);
    }
}
