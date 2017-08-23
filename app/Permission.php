<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App
 * @property string $title
*/
class Permission extends Model
{
    protected $fillable = ['title'];
    
    
}
