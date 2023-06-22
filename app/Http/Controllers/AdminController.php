<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function list(string $search = null) {
        if (!$search) {
            return new JsonResponse(Photo::all());
        }

        $searchSql = '%' . $search . '%';
        $photos = Photo::where('id', 'LIKE', $searchSql)
            ->orWhere('name', 'LIKE', $searchSql)
            ->orWhere('description', 'LIKE', $searchSql)
            ->get();

        return new JsonResponse($photos);
    }

    public function form(int $id = null) {
        if ($id) {
            $photo = Photo::find($id);
            return view('form', ['photo' => $photo]);
        }

        return view('form');
    }

    public function save(Request $request) {
        $id = $request->id;

        $rules = [
            'name' => ['required'],
            'year' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ];
        if (!$id) {
            $rules['image'] = ['required'];
        }
        $messages = [
            'required' => 'Šis lauks ir obligāts'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $photo = new Photo();

        if ($id) {
            $photo = Photo::find($id);
        }

        $photo->name = $request->name;
        $photo->year = $request->year;
        $photo->description = $request->description;
        $photo->latitude = $request->latitude;
        $photo->longitude = $request->longitude;

        $image = $request->image;
        if ($image) {
            $photo->image = Storage::putFile($photo->year, $image);
        }

        $photo->save();

        return redirect('dashboard');
    }

    public function delete(int $id) {
        Photo::where('id', $id)->delete();

        return redirect('dashboard');
    }
}
