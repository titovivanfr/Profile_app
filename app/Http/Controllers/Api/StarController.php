<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stars;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StarController extends Controller
{
    /**
     * Display all stars.
     *
     * @return Response
     */
    public function index() : JsonResponse
    {
       return response()->json(Stars::all());
    }

    /**
     * Store a new created Star.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'bio' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ]);

        $stars = new Stars([
        'first_name' => $request->input('firstName'),
        'last_name' => $request->input('lastName'),
        'bio' => $request->input('bio'),
        ]);
        $this->uploadImage($stars, $request);
        $stars->save();
        return response()->json('Stars is created!');
    }

    /**
     * Get only one star
     * @param int $id
     * @return JsonResponse
     */
    public function getStar(int $id): JsonResponse
    {
        $star = Stars::find($id);
        return response()->json($star);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Stars $stars
     * @param Request $request
     * @return Response
     */
    private function uploadImage(Stars $stars, Request $request): void
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $stars->avatar = 'images/'. $imageName;
            $stars->save();
        }
    }
    /**
     * Update the star.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'bio' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif',
        ]);

        $star = Stars::find($id);
        $star->first_name = $request->input('firstName');
        $star->last_name = $request->input('lastName');
        $star->bio = $request->input('bio');
        $this->uploadImage($star, $request);
        $star->save();

        return response()->json('Stars is updated !');
    }

    /**
     * Remove the specified star.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Stars::find($id)->delete();
        return response()->json("Stars was deleted!");
    }
}
