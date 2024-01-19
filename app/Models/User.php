<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'gambar_user',
        'no_hp',
        'posisi',
        'role',
        'password',
    ];

    // app/User.php

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function scopeOfSelect($query)
    {
        return $query->select('user_id', 'name', 'email', 'username', 'avatar', 'birth_date', 'role_id', 'created_at', 'updated_at');
    }

    public function scopeFilter($query, $filter)
    {
        foreach ($filter as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'keyword':
                        $query->where(function ($query2) use ($value) {
                            $query2->where('name', 'like', '%' . $value . '%')
                                ->orWhere('email', 'like', '%' . $value . '%')
                                ->orWhere('username', 'like', '%' . $value . '%')
                                ->orWhere('birth_date', 'like', '%' . $value . '%');
                        });
                        break;
                    case 'user_id':
                        if (is_array($value)) {
                            $query->whereIn('user_id', $value);
                        } else {
                            $query->where('user_id', $value);
                        }
                        break;
                }
            }
        }

        return $query;
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];  
}
