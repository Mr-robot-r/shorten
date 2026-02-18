<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    //STATUS
    const STATUS_NOT_ACTIVE = 'nonactive';
    const STATUS_ACTIVE = 'active';

    protected $table = 'urls';
    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        "original_url",
        "short_code",
        "status",
        "click",
    ];

    /**
     * Returns user statuses list
     * @return array
     */
    public static function statuses()
    {
        return [
            self::STATUS_NOT_ACTIVE => ['title' => "فعال"],
            self::STATUS_ACTIVE => ['title' => "غیر فعال"],
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];



}
