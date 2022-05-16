<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advert\AdvertStoreRequest;
use App\Http\Requests\Advert\AdvertUpdateRequest;
use App\Http\Resources\Advert\AdvertIndexResource;
use App\Http\Resources\Advert\AdvertSingleResource;
use App\Http\Resources\PaginationResource;
use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvertController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage ?? config('constants.DEFAULT_ITEMS_PER_PAGE');
        $sortType = $request->sortType ?? config('constants.DEFAULT_SORT_TYPE');
        $sortBy = $request->sortBy ?? 'created_at';

        $adverts = Advert::query()
            ->when($sortBy, function($query) use($sortBy, $sortType){
                $query->orderBy($sortBy, $sortType);
            })
            ->with('author:id,name')
            ->paginate($itemsPerPage);

        return $this->success([
            'pagination' => new PaginationResource($adverts),
            'items' => AdvertIndexResource::collection($adverts)
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Advert\AdvertStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdvertStoreRequest $request)
    {

        $authUserID = Auth::id();

        $newAdvert = Advert::create([
            'author_id' => $authUserID,
            'title' => $request->title,
            'description' => $request->description
        ]);
        $newAdvertID = $newAdvert->id;

        $images = $request->images;
        $imagesForAdvert = [];
        foreach($images as $image){
            $path = $image->store("adverts");

            $imagesForAdvert[] = [
                'advert_id' => $newAdvertID,
                'path' => $path
            ];
        }
        AdvertImage::insert($imagesForAdvert);


        return $this->success(new AdvertSingleResource($newAdvert));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Advert $advert)
    {
        $advert->load('author', 'images');

        return $this->success(new AdvertSingleResource($advert));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Advert\AdvertUpdateRequest  $request
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function update(AdvertUpdateRequest $request, Advert $advert)
    {
        $this->authorize('isAuthor', $advert);

        /*
            IT's also possible update like this: $advert->update($request->validated()), but i think,
            it's not clearly defining columns for updating, so it's kinda **magic**
        */
        $advert->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function destroy(Advert $advert)
    {
        $this->authorize('isAuthor', $advert);

        $advert->delete();
    }
}
