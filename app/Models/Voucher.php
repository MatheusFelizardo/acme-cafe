<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory, HasUuids;

    // one voucher can be associated with many users
    public function users()
    {
        return $this->hasMany(UserVoucher::class, 'voucher_code', 'code');
    }
    

    protected $fillable = ['code', 'discount', 'expires_at', 'is_active'];
}
