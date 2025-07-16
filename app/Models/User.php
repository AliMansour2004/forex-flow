<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens, HasRoles;

    protected $fillable = [
        'parent_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'user_name',
        'date_of_birth',
        'email',
        'password',
        'balance',
        'is_active',
        'is_our_tbroker_account_open',
        'our_tbroker_server_name',
        'our_tbroker_account_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }

// Replace the old members() function with this:
    public function members()
    {
        return $this->hasMany(User::class, 'parent_id');
    }


    public function memberRecords()
    {
        return $this->hasMany(Member::class, 'added_by_user_id');
    }


    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function userFeedback()
    {
        return $this->belongsToMany(Video::class, 'user_video_feedback')
            ->withPivot('rating', 'feedback', 'last_progress')
            ->withTimestamps();
    }

    public function UserChapterProgress()
    {
        return $this->belongsToMany(Chapter::class, 'user_chapter_progress')
            ->using(UserChapterProgress::class)
            ->withPivot('last_video_id', 'last_video_show_at', 'remaining_duration')
            ->withTimestamps();
    }


    public function cardsPayment()
    {
        return $this->hasMany(CardPayment::class, 'added_by_user_id');
    }

    public function cardsPayments()
    {
        return $this->hasMany(CardPayment::class, 'user_id');
    }

    public function brokersReceipts()
    {
        return $this->hasMany(BrokerReceipt::class, 'added_by_user_id');
    }

    public function companyBalanceTransactions()
    {
        return $this->hasMany(CompanyBalanceTransaction::class, 'added_by_user_id');
    }

    public function commissions()
    {
        return $this->hasMany(MemberCommission::class, 'user_id');
    }

    public function latestCardPayment()
    {
        return $this->hasOne(CardPayment::class, 'user_id')->latestOfMany('finished_at');
    }



//    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(Role::class);
//    }

}
