<?php

namespace App\Repositories;

use App\Interfaces\CourseInterface;
use App\Models\Course\Course;
use App\Models\Course\CourseBenefit;
use App\Models\Course\CourseCategory;
use App\Models\Course\CourseObjective;
use App\Models\Course\CourseTechSpec;
use App\Models\Course\UserCourseAccessLog;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseRepository implements CourseInterface
{
    private $course;
    private $courseTechSpec;
    private $courseBenefit;
    private $courseObjective;
    private $courseCategory;
    private $userCourseAccessLog;
    private $discount;

    public function __construct(
        Course $course,
        CourseCategory $courseCategory,
        CourseTechSpec $courseTechSpec,
        CourseBenefit $courseBenefit,
        CourseObjective $courseObjective,
        UserCourseAccessLog $userCourseAccessLog,
        Discount $discount
    ) {
        $this->course              = $course;
        $this->courseCategory      = $courseCategory;
        $this->courseTechSpec      = $courseTechSpec;
        $this->courseBenefit       = $courseBenefit;
        $this->courseObjective     = $courseObjective;
        $this->userCourseAccessLog = $userCourseAccessLog;
        $this->discount            = $discount;
     }

    public function getByUserId($userId)
    {
        return $this->course->where('created_by', $userId)->get();
    }

    public function getById($id)
    {
        return $this->course->with(['category', 'courseChapter', 'courseTechSpec', 'courseBenefit', 'courseObjective'])->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();

        $mainImageFilename = uniqid() . '.' . $data['main_image']->extension();
        $mainImagePath     = $mainImageFilename;

        $sneekPeekFilenames = [];
        $sneekPeekPaths     = [];

        try {
            // Store main image
            $data['main_image']->storeAs('public/courses', $mainImageFilename);

            // Store sneek peek images
            foreach (['sneek_peek_1', 'sneek_peek_2', 'sneek_peek_3', 'sneek_peek_4'] as $sneekPeekKey) {
                $filename = uniqid() . '.' . $data[$sneekPeekKey]->extension();
                $data[$sneekPeekKey]->storeAs('public/sneek_peeks', $filename);
                $sneekPeekFilenames[] = $filename;
                $sneekPeekPaths[]     = $filename;
            }

            // Create the course
            $course = $this->course->create([
                'title'             => $data['title'],
                'category_id'       => $data['category_id'],
                'short_description' => $data['short_description'],
                'description'       => $data['description'],
                'price'             => $data['price'],
                'main_image'        => $mainImagePath,
                'sneek_peek_1'      => $sneekPeekPaths[0],
                'sneek_peek_2'      => $sneekPeekPaths[1],
                'sneek_peek_3'      => $sneekPeekPaths[2],
                'sneek_peek_4'      => $sneekPeekPaths[3],
                'request_status'    => Course::REQUEST_STATUS_WAITING,
                'upload_status'     => Course::UPLOAD_STATUS_UNPUBLISHED,
                'activation_status' => Course::ACTIVATE_STATUS_ACTIVE,
                'created_by'        => auth()->user()->id,
            ]);

            foreach ($data['technologies'] as $tech_spec) {
                $this->courseTechSpec->create([
                    'course_id' => $course->id,
                    'name'      => $tech_spec,
                ]);
            }

            foreach ($data['benefits'] as $benefit => $value) {
                $value = json_decode($value, true);
                $this->courseBenefit->create([
                    'course_id'   => $course->id,
                    'title'       => $value['title'],
                    'description' => $value['description'],
                ]);
            }

            if (isset($data['objectives'])) {
                foreach ($data['objectives'] as $objective => $value) {
                    $value = json_decode($value, true);
                    $this->courseObjective->create([
                        'course_id'   => $course->id,
                        'title'       => $value['title'],
                        'description' => $value['description'],
                    ]);
                }
            }

            if(isset($data['discount'])) {
                $data['discount'] = json_decode($data['discount'], true);
                foreach($data['discount'] as $data => $value)
                {
                    $this->discount->create([
                        'role' => $value['role'],
                        'course_id' => $course->id,
                        'discount_price' => $value['discount_price'],
                        'start_date' => date('Y-m-d', strtotime($value['start_date'])),
                        'end_date' => date('Y-m-d', strtotime($value['end_date'])),
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Storage::delete($mainImagePath);
            foreach ($sneekPeekPaths as $path) {
                Storage::delete($path);
            }
            foreach ($course->courseTechSpec as $techSpec) {
                $techSpec->delete();
            }
            foreach ($course->courseBenefit as $benefit) {
                $benefit->delete();
            }
            foreach ($course->courseObjective as $objective) {
                $objective->delete();
            }

            dd($th->getMessage());
        }
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        $course = $this->course->find($id);

        $filename_main_image   = $course->main_image;
        $filename_sneek_peek_1 = $course->sneek_peek_1;
        $filename_sneek_peek_2 = $course->sneek_peek_2;
        $filename_sneek_peek_3 = $course->sneek_peek_3;
        $filename_sneek_peek_4 = $course->sneek_peek_4;

        if ($data['main_image'] != 'undefined') {
            $filename_main_image = uniqid() . '.' . $data['main_image']->extension();
            $data['main_image']->storeAs('public/courses', $filename_main_image);
            Storage::delete('public/courses/' . $course->main_image);
        }

        if ($data['sneek_peek_1'] != 'undefined') {
            $filename_sneek_peek_1 = uniqid() . '.' . $data['sneek_peek_1']->extension();
            $data['sneek_peek_1']->storeAs('public/sneek_peeks', $filename_sneek_peek_1);
            Storage::delete('public/sneek_peeks/' . $course->sneek_peek_1);
        }

        if ($data['sneek_peek_2'] != 'undefined') {
            $filename_sneek_peek_2 = uniqid() . '.' . $data['sneek_peek_2']->extension();
            $data['sneek_peek_2']->storeAs('public/sneek_peeks', $filename_sneek_peek_2);
            Storage::delete('public/sneek_peeks/' . $course->sneek_peek_2);
        }

        if ($data['sneek_peek_3'] != 'undefined') {
            $filename_sneek_peek_3 = uniqid() . '.' . $data['sneek_peek_3']->extension();
            $data['sneek_peek_3']->storeAs('public/sneek_peeks', $filename_sneek_peek_3);
            Storage::delete('public/sneek_peeks/' . $course->sneek_peek_3);
        }

        if ($data['sneek_peek_4'] != 'undefined') {
            $filename_sneek_peek_4 = uniqid() . '.' . $data['sneek_peek_4']->extension();
            $data['sneek_peek_4']->storeAs('public/sneek_peeks', $filename_sneek_peek_4);
            Storage::delete('public/sneek_peeks/' . $course->sneek_peek_4);
        }

        try {
            $course->update([
                'title'             => $data['title'],
                'category_id'       => $data['category_id'],
                'short_description' => $data['short_description'],
                'description'       => $data['description'],
                'price'             => $data['price'],
                'main_image'        => $filename_main_image,
                'sneek_peek_1'      => $filename_sneek_peek_1,
                'sneek_peek_2'      => $filename_sneek_peek_2,
                'sneek_peek_3'      => $filename_sneek_peek_3,
                'sneek_peek_4'      => $filename_sneek_peek_4,
                'request_status'    => Course::REQUEST_STATUS_WAITING,
                'upload_status'     => Course::UPLOAD_STATUS_UNPUBLISHED,
                'activation_status' => Course::ACTIVATE_STATUS_ACTIVE,
                'created_by'        => auth()->user()->id,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        try {
            $this->courseTechSpec->where('course_id', $course->id)->delete();
            foreach ($data['technologies'] as $tech_spec) {
                $this->courseTechSpec->create([
                    'course_id' => $course->id,
                    'name'      => $tech_spec,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        try {
            $this->courseBenefit->where('course_id', $course->id)->delete();
            foreach ($data['benefits'] as $benefit => $value) {
                $value = json_decode($value, true);
                $this->courseBenefit->create([
                    'course_id'   => $course->id,
                    'title'       => $value['title'],
                    'description' => $value['description'],
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        try {
            if (isset($data['objectives'])) {
                $this->courseObjective->where('course_id', $course->id)->delete();
                foreach ($data['objectives'] as $objective => $value) {
                    $value = json_decode($value, true);
                    $this->courseObjective->create([
                        'course_id'   => $course->id,
                        'title'       => $value['title'],
                        'description' => $value['description'],
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        try {
            if(isset($data['discount'])) {
                $data['discount'] = json_decode($data['discount'], true);
                $this->discount->where('course_id', $course->id)->delete();
                foreach($data['discount'] as $data => $value)
                {
                    $this->discount->create([
                        'role' => $value['role'],
                        'course_id' => $course->id,
                        'discount_price' => $value['discount_price'],
                        'start_date' => date('Y-m-d', strtotime($value['start_date'])),
                        'end_date' => date('Y-m-d', strtotime($value['end_date'])),
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        DB::commit();
    }

    public function destroy($id)
    {
        return $this->getById($id)->update([
            'activation_status' => Course::ACTIVATE_STATUS_INACTIVE,
        ]);
    }

    public function restore($id)
    {
        return $this->getById($id)->update([
            'activation_status' => Course::ACTIVATE_STATUS_ACTIVE,
        ]);
    }

    public function getAll()
    {
        return $this->course->with(['category', 'courseChapter', 'user'])->where('activation_status', Course::ACTIVATE_STATUS_ACTIVE)->get();
    }

    public function approve($id)
    {
        return $this->getById($id)->update([
            'request_status' => Course::REQUEST_STATUS_APPROVED,
        ]);
    }

    public function reject($id)
    {
        return $this->getById($id)->update([
            'request_status' => Course::REQUEST_STATUS_REJECTED,
        ]);
    }

    public function pending($id)
    {
        return $this->getById($id)->update([
            'request_status' => Course::REQUEST_STATUS_WAITING,
        ]);
    }

    public function publish($id)
    {
        return $this->getById($id)->update([
            'upload_status' => Course::UPLOAD_STATUS_PUBLISHED,
        ]);
    }

    public function unpublish($id)
    {
        return $this->getById($id)->update([
            'upload_status' => Course::UPLOAD_STATUS_UNPUBLISHED,
        ]);
    }

    public function getLearnProgress($courseId, $userId)
    {
        $course = $this->getById($courseId);
        $totalChapter = $course->courseChapter->count();
        $learnedChapter = $this->userCourseAccessLog->where('user_id', $userId)->where('course_id', $courseId)->count();
        $progress = ($learnedChapter / $totalChapter) * 100;
        return [
            'progress' => $progress,
            'learned'  => $learnedChapter,
            'total'    => $totalChapter,
        ];
    }

    public function isLearned($chapterId, $userId)
    {
        return $this->userCourseAccessLog->where('course_chapter_id', $chapterId)->where('user_id', $userId)->count() > 0;
    }

    public function discount($id)
    {
        return $this->discount->where('course_id', $id)->get();
    }
}
