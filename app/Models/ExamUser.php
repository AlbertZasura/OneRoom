<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;

class ExamUser extends Pivot implements Auditable
{
    public $table = "exams_users";
    use \OwenIt\Auditing\Auditable;
    public $incrementing = true;
    protected $auditTimestamps = true;
}
