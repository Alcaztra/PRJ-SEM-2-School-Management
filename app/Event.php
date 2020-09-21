<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Identifier event
     * 
     * @var string 
     */
    protected $id = "";

    /**
     * Identifier a group event
     * 
     * @var string 
     */
    protected $groupId = "";

    /**
     * The title of event
     * 
     * @var string
     */
    protected $title = "";

    /**
     * Start day and time for continue event
     * Format: "yyy-mm-ddTHH:mm:ss"
     * @var string
     */
    protected $start = "";

    /**
     * End day end time for continue event
     * Format: "yyy-mm-ddTHH:mm:ss"
     * 
     * @var string
     */
    protected $end = "";

    /**
     * Array intergers respenting days of week for a recurring event
     * 0 => Sunday
     * 1 => Monday
     * 2 => Tuesday
     * 3 => Wednesday
     * 4 => Thurday
     * 5 => Friday
     * 6 => Saturday
     * 
     * @var array
     */
    protected $daysOfWeek = [];

    /**
     * Start day of a recurring event
     * Format: "yyyy-mm-dd"
     * 
     * @var string
     */
    protected $startRecur = "";

    /**
     * End day of a recurring event
     * Format: "yyyy-mm-dd"
     * 
     * @var string
     */
    protected $endRecur = "";

    /**
     * Start time of day in the recurring event
     * 
     * @var string
     */
    protected $startTime = "";

    /**
     * End time of day in the recurring event
     * 
     * @var string
     */
    protected $endTime = "";

    /**
     * Allows alternate rendering of the event, only in day-grid view
     * 
     * @var string
     * @property auto default
     * @property block
     * @property list-item
     * @property background
     * @property inverse-background
     * @property none
     */
    protected $display;

    /**
     * Array of HTML class-name, separate by comma
     * 
     * @var array 
     */
    protected $classNames = [];

    /* public function make(array $attributes = [])
    {
        
    } */
}
