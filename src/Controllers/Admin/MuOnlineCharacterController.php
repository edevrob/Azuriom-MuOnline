<?php

namespace Azuriom\Plugin\MuOnline\Controllers\Admin;

use Illuminate\Http\Request;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\MuOnline\Models\MuOnlineCharacter;

class MuOnlineCharacterController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */

    public function charactersList(Request $request)
    {

        $search = $request->input('search');

        if($search) {
            $character = MuOnlineCharacter::select(['AccountID','Name', 'cLevel', 'Class', 'RESETS'])
                ->where('Name', 'LIKE', '%'.$search.'%')->paginate(10);
        }
        else {
            $character = MuOnlineCharacter::select(['AccountID','Name', 'cLevel', 'Class', 'RESETS'])->paginate(10);
        }

        return view('muonline::admin.characters', [
            'character' => $character,
            'search' => $search,
        ]);
    }

    public function charactersEdit($id)
    {
        $character = MuOnlineCharacter::all([
            'AccountID',
            'Name', 
            'cLevel', 
            'LevelUpPoint', 
            'Class', 
            'Strength', 
            'Dexterity', 
            'Vitality', 
            'Energy', 
            'Money', 
            'MapNumber', 
            'PkLevel', 
            'RESETS', 
            // 'mLevel', 
            // 'mlPoint'
        ])->where('Name', $id)->first();

        $character_classes = $character->character_class_list();

        abort_if(empty($character), 404);

        return view('muonline::admin.charactersEdit', [
            'character'         => $character,
            'character_classes' => $character_classes,
        ]);

    }

    public function charactersUpdate($id, Request $request)
    {
        MuOnlineCharacter::where('Name', $id)->update($request->except(['_token']));

        return redirect()->route('muonline.admin.charactersEdit', $id)->with('success', 'Character updated!');
    }

}
