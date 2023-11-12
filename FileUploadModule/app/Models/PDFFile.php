<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDFFile extends Model
{
    use HasFactory;
    protected $table="pdffiles";

    protected $primaryTable="filecode";

    protected $fillable=["filecode","filename","filepath","created_at","updated_at"];
}
