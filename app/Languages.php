<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table    = "languages";

    protected $fillable = [
        "id",
        "project_id",
        "language_code",
        "version",
        "key",
        "value",
        "status",
        "created_at",
        "updated_at"
    ];
}
