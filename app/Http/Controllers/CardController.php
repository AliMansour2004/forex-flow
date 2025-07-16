<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\CardControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\Cards\CardIndexRequest;
use App\Http\Requests\Cards\CardStoreRequest;
use App\Http\Requests\Cards\CardUpdateRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;

class CardController extends Controller
{
    public function index(CardIndexRequest $request)
    {
        return (new CardControllerHelper)
            ->pagingSearchData($request, new Card(), CardResource::class);
    }

//    public function store(CardStoreRequest $request)
//    {
//        $card = Card::create($request->all());
//        return new CardResource($card);
//    }

    public function show(Card $card)
    {
        return new CardResource($card);
    }

//    public function update(CardUpdateRequest $request, Card $card)
//    {
//        $card->update($request->all());
//        return new CardResource($card);
//    }

//    public function destroy($id)
//    {
//        if (!Card::findOrFail($id)->delete())
//            abort(403);
//    }
}
