<?php

namespace App\Models\Course;

use App\Models\Transaction\DetailTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    const REQUEST_STATUS_WAITING  = 0;
    const REQUEST_STATUS_APPROVED = 1;
    const REQUEST_STATUS_REJECTED = 2;

    const REQUEST_STATUS_WAITING_TEXT  = 'Waiting';
    const REQUEST_STATUS_APPROVED_TEXT = 'Approved';
    const REQUEST_STATUS_REJECTED_TEXT = 'Rejected';

    const UPLOAD_STATUS_UNPUBLISHED = 0;
    const UPLOAD_STATUS_PUBLISHED   = 1;

    const UPLOAD_STATUS_UNPUBLISHED_TEXT = 'Unpublished';
    const UPLOAD_STATUS_PUBLISHED_TEXT   = 'Published';

    const ACTIVATE_STATUS_INACTIVE = 0;
    const ACTIVATE_STATUS_ACTIVE   = 1;

    const ACTIVATE_STATUS_INACTIVE_TEXT = 'Inactive';
    const ACTIVATE_STATUS_ACTIVE_TEXT   = 'Active';

    use HasFactory;

    public $table = 'courses';
    protected $fillable = [
        'category_id',
        'title',
        'short_description',
        'description',
        'file',
        'main_image',
        'sneek_peek_1',
        'sneek_peek_2',
        'sneek_peek_3',
        'sneek_peek_4',
        'price',
        'request_status',
        'upload_status',
        'activation_status',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function courseTechSpec()
    {
        return $this->hasMany(CourseTechSpec::class, 'course_id');
    }

    public function courseBenefit()
    {
        return $this->hasMany(CourseBenefit::class, 'course_id');
    }

    public function courseAuthor()
    {
        return $this->hasMany(CourseAuthor::class, 'course_id');
    }

    public function detailTransaction()
    {
        return $this->hasOne(DetailTransaction::class, 'course_id');
    }

    public function courseChapter()
    {
        return $this->hasMany(CourseChapter::class, 'course_id');
    }

    public function userCourseAccessLogs()
    {
        return $this->hasMany(UserCourseAccessLog::class, 'course_id');
    }

    // Custom function
    public function getRequestStatusText()
    {
        switch ($this->request_status) {
            case self::REQUEST_STATUS_WAITING:
                return self::REQUEST_STATUS_WAITING_TEXT;
                break;
            case self::REQUEST_STATUS_APPROVED:
                return self::REQUEST_STATUS_APPROVED_TEXT;
                break;
            case self::REQUEST_STATUS_REJECTED:
                return self::REQUEST_STATUS_REJECTED_TEXT;
                break;
            default:
                return 'Unknown';
                break;
        }
    }

    public function getUploadStatusText()
    {
        switch ($this->upload_status) {
            case self::UPLOAD_STATUS_UNPUBLISHED:
                return self::UPLOAD_STATUS_UNPUBLISHED_TEXT;
                break;
            case self::UPLOAD_STATUS_PUBLISHED:
                return self::UPLOAD_STATUS_PUBLISHED_TEXT;
                break;
            default:
                return 'Unknown';
                break;
        }
    }

    public function getActivationStatusText()
    {
        switch ($this->activation_status) {
            case self::ACTIVATE_STATUS_INACTIVE:
                return self::ACTIVATE_STATUS_INACTIVE_TEXT;
                break;
            case self::ACTIVATE_STATUS_ACTIVE:
                return self::ACTIVATE_STATUS_ACTIVE_TEXT;
                break;
            default:
                return 'Unknown';
                break;
        }
    }
}
