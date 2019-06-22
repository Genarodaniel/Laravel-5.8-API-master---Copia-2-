<?php
   
   namespace App;
   use Illuminate\Database\Eloquent\Model;


     class User_app extends Model{
        
        protected $fillable = [
            'name', 'email', 'password','user_type'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

    }

    ?>