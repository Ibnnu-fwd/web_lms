<?php

namespace App\Repositories;

use App\Interfaces\CourseInterface;
use App\Models\Course\Course;
use App\Models\Course\CourseBenefit;
use App\Models\Course\CourseCategory;
use App\Models\Course\CourseObjective;
use App\Models\Course\CourseTechSpec;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseRepository implements CourseInterface
{
    private $course;
    private $courseCategory;
    private $courseTechSpec;
    private $courseBenefit;
    private $courseObjective;

    public function __construct(
        Course $course,
        CourseCategory $courseCategory,
        CourseTechSpec $courseTechSpec,
        CourseBenefit $courseBenefit,
        CourseObjective $courseObjective
    ) {
        $this->course          = $course;
        $this->courseCategory  = $courseCategory;
        $this->courseTechSpec  = $courseTechSpec;
        $this->courseBenefit   = $courseBenefit;
        $this->courseObjective = $courseObjective;
    }

    public function getByUserId($userId)
    {
        return $this->course->where('created_by', $userId)->get();
    }

    public function getById($id)
    {
        return $this->course->with(['category', 'courseTechSpec', 'courseBenefit', 'courseObjective'])->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();

        $filename_main_image   = uniqid() . '.' . $data['main_image']->extension();
        $filename_sneek_peek_1 = uniqid() . '.' . $data['sneek_peek_1']->extension();
        $filename_sneek_peek_2 = uniqid() . '.' . $data['sneek_peek_2']->extension();
        $filename_sneek_peek_3 = uniqid() . '.' . $data['sneek_peek_3']->extension();
        $filename_sneek_peek_4 = uniqid() . '.' . $data['sneek_peek_4']->extension();

        try {
            $data['main_image']->storeAs('public/courses', $filename_main_image);
            $data['sneek_peek_1']->storeAs('public/sneek_peeks', $filename_sneek_peek_1);
            $data['sneek_peek_2']->storeAs('public/sneek_peeks', $filename_sneek_peek_2);
            $data['sneek_peek_3']->storeAs('public/sneek_peeks', $filename_sneek_peek_3);
            $data['sneek_peek_4']->storeAs('public/sneek_peeks', $filename_sneek_peek_4);
        } catch (\Throwable $th) {
            throw $th;
        }


        try {
            $course = $this->course->create([
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

        DB::commit();
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
            $filename_main_image = uniqid() . '.' . $data['main_image']->getOriginalExtension();
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

        DB::commit();
    }
}
