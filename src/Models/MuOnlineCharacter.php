<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class MuOnlineCharacter extends Model
{
    /** @var string */
    protected $primaryKey = 'Name';

    protected $connection = 'sqlsrv';

    protected $fillable = [
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
        'mLevel', 
        'mlPoint'
    ];

    /** @var bool */
    public $incrementing = false;


    /** @var string */
    protected $table = null;

    /** @var bool */
    public $timestamps = false;


    public function __construct()
    {
        return $this->table = ''.config('database.connections.sqlsrv.database').'.dbo.Character';
    }


    public function character_class($id)
    {

        $character_class_igcn = array(
            0 => array('Dark Wizard', 'DW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            1 => array('Soul Master', 'SM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            3 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            7 => array('Soul Wizard', 'SW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            16 => array('Dark Knight', 'DK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            17 => array('Blade Knight', 'BK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            19 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            23 => array('Dragon Knight', 'DGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            32 => array('Elf', 'ELF', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            33 => array('Muse Elf', 'ME', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            35 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            39 => array('Noble Elf', 'NE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            48 => array('Magic Gladiator', 'MG', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            50 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            54 => array('Magic Knight', 'MK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            64 => array('Dark Lord', 'DL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            66 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            70 => array('Empire Lord', 'EL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            80 => array('Summoner', 'SUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            81 => array('Bloody Summoner', 'BS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            83 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            87 => array('Dimension Summoner', 'DS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            96 => array('Rage Fighter', 'RF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            98 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            102 => array('First Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            112 => array('Grow Lancer', 'GL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            114 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            118 => array('Shining Lancer', 'SL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            128 => array('Rune Wizard', 'RW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            129 => array('Rune Spell Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            131 => array('Grand Rune Master', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            135 => array('Grand Rune Master', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            144 => array('Slayer', 'SLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            145 => array('Slayer Royal', 'SLRR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            147 => array('Master Slayer', 'MSLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            151 => array('Slaughterer', 'SLTR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            160 => array('Gun Crusher', 'GC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            161 => array('Gun Breaker', 'GB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            163 => array('Master Gun Breaker', 'MGB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            168 => array('Heist Gun Crusher', 'HGC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
        );

        $character_class_xteam = array(
            0 => array('Dark Wizard', 'DW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            1 => array('Soul Master', 'SM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            2 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            3 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            7 => array('Soul Wizard', 'SW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            16 => array('Dark Knight', 'DK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            17 => array('Blade Knight', 'BK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            18 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            19 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            23 => array('Dragon Knight', 'DGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            32 => array('Fairy Elf', 'ELF', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            33 => array('Muse Elf', 'ME', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            34 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            35 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            39 => array('Noble Elf', 'NE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            48 => array('Magic Gladiator', 'MG', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            49 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            50 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            54 => array('Magic Knight', 'MK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            64 => array('Dark Lord', 'DL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            65 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            66 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            67 => array('Empire Lord', 'EL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            80 => array('Summoner', 'SUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            81 => array('Bloody Summoner', 'BS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            82 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            83 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            87 => array('Dimension Summoner', 'DS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            96 => array('Rage Fighter', 'RF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            97 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            98 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            99 => array('Fist Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            102 => array('Fist Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            112 => array('Grow Lancer', 'GL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            114 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            115 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            118 => array('Shining Lancer', 'SL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            128 => array('Rune Mage', 'RW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            129 => array('Rune Spell Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            130 => array('Grand Rune Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            131 => array('Majestic Rune Wizard', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            135 => array('Majestic Rune Wizard', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            144 => array('Slayer', 'SLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            145 => array('Slayer Royal', 'SLRR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            146 => array('Master Slayer', 'MSLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            147 => array('Slaughterer', 'SLTR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
        );


        if(setting('muonline.sqlsrv_dbtype') == 'igcn')
        {
           $char_class = $character_class_igcn[$id] ?? null;
        }
        elseif(setting('muonline.sqlsrv_dbtype') == 'xteam')
        {
            $char_class = $character_class_xteam[$id] ?? null;
        }
        else
        {
            $char_class = null;
        }

        return $char_class;        
    }

    public function character_class_list()
    {
        $character_class_igcn = array(
            0 => array('Dark Wizard', 'DW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            1 => array('Soul Master', 'SM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            3 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            7 => array('Soul Wizard', 'SW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            16 => array('Dark Knight', 'DK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            17 => array('Blade Knight', 'BK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            19 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            23 => array('Dragon Knight', 'DGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            32 => array('Elf', 'ELF', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            33 => array('Muse Elf', 'ME', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            35 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            39 => array('Noble Elf', 'NE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            48 => array('Magic Gladiator', 'MG', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            50 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            54 => array('Magic Knight', 'MK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            64 => array('Dark Lord', 'DL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            66 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            70 => array('Empire Lord', 'EL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            80 => array('Summoner', 'SUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            81 => array('Bloody Summoner', 'BS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            83 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            87 => array('Dimension Summoner', 'DS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            96 => array('Rage Fighter', 'RF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            98 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            102 => array('First Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            112 => array('Grow Lancer', 'GL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            114 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            118 => array('Shining Lancer', 'SL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            128 => array('Rune Wizard', 'RW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            129 => array('Rune Spell Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            131 => array('Grand Rune Master', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            135 => array('Grand Rune Master', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            144 => array('Slayer', 'SLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            145 => array('Slayer Royal', 'SLRR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            147 => array('Master Slayer', 'MSLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            151 => array('Slaughterer', 'SLTR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            160 => array('Gun Crusher', 'GC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            161 => array('Gun Breaker', 'GB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            163 => array('Master Gun Breaker', 'MGB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
            168 => array('Heist Gun Crusher', 'HGC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
        );

        $character_class_xteam = array(
            0 => array('Dark Wizard', 'DW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            1 => array('Soul Master', 'SM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            2 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            3 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            7 => array('Soul Wizard', 'SW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
            16 => array('Dark Knight', 'DK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            17 => array('Blade Knight', 'BK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            18 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            19 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            23 => array('Dragon Knight', 'DGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
            32 => array('Fairy Elf', 'ELF', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            33 => array('Muse Elf', 'ME', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            34 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            35 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            39 => array('Noble Elf', 'NE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
            48 => array('Magic Gladiator', 'MG', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            49 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            50 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            54 => array('Magic Knight', 'MK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
            64 => array('Dark Lord', 'DL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            65 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            66 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            67 => array('Empire Lord', 'EL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
            80 => array('Summoner', 'SUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            81 => array('Bloody Summoner', 'BS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            82 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            83 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            87 => array('Dimension Summoner', 'DS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
            96 => array('Rage Fighter', 'RF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            97 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            98 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            99 => array('Fist Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            102 => array('Fist Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
            112 => array('Grow Lancer', 'GL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            114 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            115 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            118 => array('Shining Lancer', 'SL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
            128 => array('Rune Mage', 'RW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            129 => array('Rune Spell Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            130 => array('Grand Rune Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            131 => array('Majestic Rune Wizard', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            135 => array('Majestic Rune Wizard', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
            144 => array('Slayer', 'SLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            145 => array('Slayer Royal', 'SLRR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            146 => array('Master Slayer', 'MSLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
            147 => array('Slaughterer', 'SLTR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
        );

        if(setting('muonline.sqlsrv_dbtype') == 'igcn')
        {
           $character_class = $character_class_igcn;
        }
        elseif(setting('muonline.sqlsrv_dbtype') == 'xteam')
        {
            $character_class = $character_class_xteam;
        }
        else
        {
            $character_class = null;
        }

        return $character_class;        
    }


    /**
     * Return the account for this character.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function MuOnlineAccount()
    {
        return $this->belongsTo(MuOnlineAccount::class, 'AccountID', 'memb___id');
    }

    
}
