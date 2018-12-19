<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table    = "projects";

    protected $fillable = [
        "id",
        "project_name",
        "status",
        "created_at",
        "updated_at"
    ];
}
