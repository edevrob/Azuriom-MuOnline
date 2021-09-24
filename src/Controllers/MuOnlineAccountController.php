<?php

namespace Azuriom\Plugin\MuOnline\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
use Azuriom\Plugin\MuOnline\Models\MuOnlineCharacter;
use Azuriom\Plugin\MuOnline\Models\MuOnlineStats;
use Azuriom\Plugin\MuOnline\Models\User;
use Azuriom\Plugin\MuOnline\Requests\MuOnlineAccountRequest;

class MuOnlineAccountController extends Controller
{
    public function store(MuOnlineAccountRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = e($validatedData['password']);
        
        // $last_memb_id = MuOnlineAccount::orderBy('memb___id', 'desc')->first()->memb___id;
        // $memb_id = $last_memb_id+1;
        

        $new = new MuOnlineAccount;

        $new->memb___id = $validatedData['account'];
        $new->memb__pwd = $validatedData["password"];
        $new->memb_name = $validatedData['account'];
        $new->sno__numb = 0;
        $new->bloc_code = 0;
        $new->ctl1_code = 0;
        $new->Azuriom_user_id = auth()->id();
        $new->Azuriom_user_access_token = Str::random(128);
        $new->save();

        // MuOnlineAccount::query()->create([
        //     'memb___id' => $validatedData['account'],
        //     'memb__pwd' => $validatedData["password"],
        //     'memb_name' => $validatedData['account'],
        //     'sno__numb' => 0,
        //     'bloc_code' => 0,
        //     'ctl1_code' => 0,
        //     'Azuriom_user_id' => auth()->id(),
        //     'Azuriom_user_access_token' => Str::random(128)
        // ]);

        return redirect()->route('muonline.accounts.index')->with('success', 'Account created');
    }

    public function link(Request $request)
    {
        $validated = $request->validate([
            'account' => 'required|string',
            'password' => 'required|string',
        ]);

        $account = MuOnlineAccount::firstWhere('memb___id', $validated['account']);

        $hash = $validated['password'];

        if ($account !== null && $account->memb__pwd === $hash) {
            $account->Azuriom_user_id = auth()->id();
            $account->Azuriom_user_access_token = Str::random(128);
            $account->save();

            return redirect()->route('muonline.accounts.index')->with('success', 'Account Linked');
        }

        return redirect()->route('muonline.accounts.index')->with('error', 'Wrong credentials');
    }

    public function characters()
    {

        $character = MuOnlineCharacter::get(['AccountID','Name', 'cLevel', 'Class', 'RESETS']);
        
        $ids = MuOnlineAccount::where('Azuriom_user_id', auth()->id())->pluck('memb___id');
        $character = MuOnlineCharacter::whereIn('AccountID', $ids)->get(['AccountID','Name', 'cLevel', 'Class', 'RESETS', 'Money']);

        return view('muonline::characters', [
            'character' => $character,
        ]);
    }

    public function charactersReset($name)
    {
        $character = MuOnlineCharacter::where('Name', $name)->get(['AccountID','Name', 'cLevel', 'RESETS', 'Money'])->first();
        
        //Check if character belongs to account
        if($character->MuOnlineAccount->Azuriom_user_id == auth()->id())
        {
            $money_for_reset = setting('muonline.game_resetzen');
            
            if($character->cLevel == 400 && $character->Money >= $money_for_reset)
            {
                
                if(!$character->MuOnlineAccount->stats['ConnectStat'])
                {
                    $character->RESETS = $character->RESETS+1;
                    $character->cLevel = 1;
                    $character->Money = $character->Money-$money_for_reset;
                    $character->save();
    
                    return redirect()->route('muonline.accounts.characters')->with('success', 'Character '.$character->Name.' reseted sucessfully');
                }
                else
                {
                    return redirect()->route('muonline.accounts.characters')->with('error', 'Account is online');
                }

            }
            else
            {
                return redirect()->route('muonline.accounts.characters')->with('error', 'Reset requires level 400 and '.$money_for_reset.' Zen');
            }
        }
        else
        {
            abort(404);
        }
    }

    public function edit(MuOnlineAccount $account)
    {
        abort_if($account->Azuriom_user_id != auth()->id(), 403);

        return view('muonline::change-password', ['account'=>$account]);
    }

    public function update(MuOnlineAccount $account)
    {
        abort_if($account->Azuriom_user_id != auth()->id(), 403);

        $validated = $this->validate(request(), [
            'password' => ['required', 'string', 'min:8','max:16', 'regex:/^[A-Za-z0-9]+$/u','confirmed']
        ]);

        $account->memb__pwd = $validated['password'];
        $account->save();

        return redirect()->route('muonline.accounts.index')->with('success', 'Password changed');
    }
}
