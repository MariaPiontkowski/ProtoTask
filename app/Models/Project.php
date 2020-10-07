<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'init_at', 'end_at'
    ];

    protected $dates = [
        'init_at', 'end_at'
    ];

    public $timestamps = true;

    /**
     * Get all of the tasks of the project.
     *
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Check if the project is finished.
     *
     * @return bool
     */
    public function isFinished()
    {
        return !$this->tasks()->where('finished', false)->count() > 0;
    }

    /**
     * Check if the project is late.
     *
     * @return bool
     */
    public function isLate()
    {
        return $this->hasExceedTask() || !$this->isFinished() && Carbon::today()->gt($this->end_at);
    }

    /**
     * Check if the project has a task that ends after.
     *
     * @return bool
     */
    public function hasExceedTask()
    {
        return $this->maxDateTask()->gt($this->end_at);
    }

    /**
     * Get the max end date os task
     *
     * @return bool
     */
    public function maxDateTask()
    {
        return Carbon::create($this->tasks()->max('end_at'));
    }


    /**
     * Get the finished tasks.
     *
     * @return HasMany
     */
    public function getFinishedTasks()
    {
       return $this->tasks()->where('finished', true);
    }


    /**
     * Get the percent of finished tasks.
     *
     * @return float|int
     */
    public function getPercentFinished()
    {
        $totalTasks = $this->tasks()->count();
        $finishedTasks = $this->tasks()->where('finished', true)->count();

        try {
            return $finishedTasks * 100 / $totalTasks;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
