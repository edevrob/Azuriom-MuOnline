@extends('admin.layouts.admin')

@section('title', ''.trans('muonline::character.edit').': '.$character->Name.'' )

@section('content')

<div class="card shadow mb-4">
    <div class="card-body">

        <form class="form mb-3" action="{{ route('muonline.admin.charactersUpdate', $character->Name) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cLevel">Level</label>
                <input id="cLevel" name="cLevel" type="text" class="form-control" value="{{ $character->cLevel }}">
            </div>
            <div class="form-group">
                <label for="LevelUpPoint">Free points</label>
                <input id="LevelUpPoint" name="LevelUpPoint" type="text" class="form-control" value="{{ $character->LevelUpPoint }}">
            </div>
            <div class="form-group">
                <label for="Class">Class</label>
                <div>
                    <select id="Class" name="Class" class="custom-select" value="{{ $character->Class }}">
                        @foreach ($character_classes as $key => $item)
                            <option value="{{ $key }}" {{ $key == $character->Class ? "selected" : "" }}>{{ $item[0] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="Strength">Strength</label>
                <input id="Strength" name="Strength" type="text" class="form-control" value="{{ $character->Strength }}">
            </div>
            <div class="form-group">
                <label for="Dexterity">Dexterity</label>
                <input id="Dexterity" name="Dexterity" type="text" class="form-control" value="{{ $character->Dexterity }}">
            </div>
            <div class="form-group">
                <label for="Vitality">Vitality</label>
                <input id="Vitality" name="Vitality" type="text" class="form-control" value="{{ $character->Vitality }}">
            </div>
            <div class="form-group">
                <label for="Energy">Energy</label>
                <input id="Energy" name="Energy" type="text" class="form-control" value="{{ $character->Energy }}">
            </div>
            <div class="form-group">
                <label for="Money">Money</label>
                <input id="Money" name="Money" type="text" class="form-control" value="{{ $character->Money }}">
            </div>
            <div class="form-group">
                <label for="RESETS">Resets</label>
                <input id="RESETS" name="RESETS" type="text" class="form-control" value="{{ $character->RESETS }}">
            </div>
            {{-- <div class="form-group">
                <label for="mLevel">Master level</label>
                <input id="mLevel" name="mLevel" type="text" class="form-control" value="{{ $character->mLevel }}">
            </div>
            <div class="form-group">
                <label for="mlPoint">mlPoint</label>
                <input id="mlPoint" name="mlPoint" type="text" class="form-control" value="{{ $character->mlPoint }}">
            </div> --}}

            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-arrow-up fa-sm"></i> {{ trans('messages.actions.update') }}
                </button>
            </div>

        </form>


    </div>
</div>
@endsection