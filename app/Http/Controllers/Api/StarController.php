<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stars;
use Illuminate\Http\Request;

class StarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stars::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->input('firstName'), $request->all(), $request->file("image"), $_FILES);
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'bio' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ]);

        $stars = new Stars([
        'firstName' => $request->input('firstName'),
        'lastName' => $request->input('lastName'),
        'bio' => $request->input('bio'),
        'avatar' => $request->input('image')
        ]);

        $stars->save();
        return response()->json('Stars created!');
    }

    public function  edit($id) {
        // get star form id
        // return the star
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        dd($request->input('firstName'), $request->all(), $request->file("image"), $_FILES);

        $stars = Stars::find($id);

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'bio' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ]);

        if (!$stars) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $stars->avatar = $image;
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully']);
        }

        $stars->firstName = $request->input('firstName');
        $stars->lastName = $request->input('lastName');
        $stars->bio = $request->input('bio');
        $stars->save();

        return response()->json('Data updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stars::find($id)->delete();
        return response()->json("Stars was deleted!");
    }
}
