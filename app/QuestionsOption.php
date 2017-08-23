<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionsOption
 *
 * @package App
 * @property string $question
 * @property text $option_text
 * @property tinyInteger $correct
*/
class QuestionsOption extends Model
{
    use SoftDeletes;

    protected $fillable = ['option_text', 'correct', 'question_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
    
}
