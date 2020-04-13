<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;

class CharacterController extends Controller
{
    /**
     * @param Request $request
     * @return Character[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $characters = Character::where('name', 'LIKE', '%' . $request->search . '%');

        if ($request->has('gender') && $request->gender != '') {
            $characters->where('gender', $request->gender);
        }

        if ($request->has('died') && $request->died != '') {
            if ($request->died) {
                $characters->whereNotNull('died')
                    ->where('died', '<>', '');
            } else {
                $characters->whereNull('died')
                    ->orWhere('died', '');
            }
        }

        return $characters->paginate(10);
    }

    /**
     * @param Character $character
     * @return Character
     */
    public function show(Character $character)
    {
        return $character;
    }

    /**
     * @param Request $request
     * @param Character $character
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Character $character, Request $request)
    {
        try {
            if ($character->died != '') {
                $character->name = $request->name;
                $character->gender = $request->gender;
                $character->culture = $request->culture;
                $character->born = $request->born;
                $character->died = $request->died;

                $character->save();

                return response()->json([
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Data updated',
                    'data' => $character
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warn',
                    'title' => 'Warning',
                    'message' => 'Data can not be update. Character did not die.',
                    'data' => $character
                ], 200);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }
}
