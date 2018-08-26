<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pname','sname','fname', 'email', 'company_id', 'password', 'remember_token', 'role_id', 'confirm', 'token'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getFullName(){
        return $this->sname.' '.$this->fname;
    }


    public function sendPasswordResetNotification($token)
    {
        $data['token'] = $token;
        $data['email'] = $this->email;


        Mail::send('email.reset', $data, function($message) use ($data)
        {
            $message->from('no-reply@sam.gpp.kz', "sam.gpp.kz");
            $message->subject("Восстановление пароля!");
            $message->to($data['email']);
        });
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
