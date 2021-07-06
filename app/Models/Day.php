<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course\Course;
use Carbon\Carbon;

class Day extends Model
{
    use HasFactory;

    const SENIN = 0;
    const SELASA = 1;
    const RABU = 2;
    const KAMIS = 3;
    const JUMAT = 4;
    const SABTU = 5;
    const MINGGU = 6;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public static function today()
    {
        $dayInEnglish = Carbon::now()->format('l');

        if($dayInEnglish == 'Monday') {
            return self::SENIN;
        } else if($dayInEnglish == 'Tuesday') {
            return self::SELASA;
        } else if($dayInEnglish == 'Wednesday') {
            return self::RABU;
        } else if($dayInEnglish == 'Thursday') {
            return self::KAMIS;
        } else if($dayInEnglish == 'Friday') {
            return self::JUMAT;
        } else if($dayInEnglish == 'Saturday') {
            return self::SABTU;
        } else if($dayInEnglish == 'Sunday') {
            return self::MINGGU;
        }

    }
}
