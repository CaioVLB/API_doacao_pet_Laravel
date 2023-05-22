<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';
    protected $fillable = [
        'company_name', 'cnpj', 'description', 'location', 'institution_image', 'bank_name',
        'agency', 'current_account', 'pix_key', 'corporate_name', 'email', 'password'
    ];
}
