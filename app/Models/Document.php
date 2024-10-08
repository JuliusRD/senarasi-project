<?php

namespace App\Models;

use App\Models\DocumentCategory;
use App\Models\SupportingDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function fileDocument()
    {
        return Storage::url($this->file_document);
    }

    public function documentCategory()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function supportingDocuments()
    {
        return $this->hasMany(SupportingDocument::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
