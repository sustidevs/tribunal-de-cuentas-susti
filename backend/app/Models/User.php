<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function area()
    {
        return $this->morphTo();
    }

    public function persona() 
    {
        return $this->hasOne('App\Models\Persona','id','persona_id');
    }

    public function historial() 
    {
        return $this->hasMany('App\Models\Historial');
    }

    public function tipoUser() 
    {
        return $this->belongsTo('App\Models\TipoUser');
    }

    public function get_tipo_area() 
    {
        $tipo_area = Str::of($this->area_type)->basename()->lower()->ucfirst();
        return $tipo_area;
    }

    public function datos_user() 
    {
        $nombreArea = "";
        if (!is_null($this->area)){
            $nombreArea = $this->area->descripcion;
        }
        $datos = collect(['user_id' => $this->id,
                          'tipo_user_id' => $this->tipoUser->id,
                          'tipo_user' => $this->tipoUser->descripcion,
                          'area_id' => $this->area_id,
                          'area' => $nombreArea,
                          'tipo_area' => $this->get_tipo_area(),
                          'dni' => $this->persona->dni,
                          'cuil' => $this->cuil,
                          'nombre' => $this->persona->nombre,
                          'apellido' => $this->persona->apellido,
                          'email' => $this->persona->email,
                          'telefono' => $this->persona->telefono,
                          'direccion' => $this->persona->direccion]);
        
        return $datos;
    }

    public static function index()
    {
        $datos_users = collect([]);
		$users = User::all();
		foreach ($users as $user){
            $datos_users->push($user->datos_user());
		}
		return $datos_users;
    }

}