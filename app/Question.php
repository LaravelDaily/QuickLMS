<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 *
 * @package App
 * @property text $question
 * @property string $question_image
 * @property integer $score
*/
class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['question', 'question_image', 'score'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setScoreAttribute($input)
    {
        $this->attributes['score'] = $input ? $input : null;
    }

    public function options()
    {
        return $this->hasMany('App\QuestionsOption');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_test');
    }

    
}
