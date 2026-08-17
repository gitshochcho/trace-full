<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A single (key, value) SEO attribute for a PageSetting — meta_title, robots, og_type, etc.
 * Adding a brand new SEO field to the system means inserting a row here, not a migration.
 * Always accessed through PageSetting's magic getters/setters — see PageSetting::getAttribute().
 */
class PageMeta extends Model
{
    use HasFactory;

    protected $table = 'page_meta';

    protected $fillable = [
        'page_setting_id',
        'key',
        'value',
    ];

    public function pageSetting()
    {
        return $this->belongsTo(PageSetting::class);
    }
}
