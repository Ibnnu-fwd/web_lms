<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/* HOME */

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

/* User Home */
Breadcrumbs::for('user-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('user.dashboard'));
});

Breadcrumbs::for('user-transaction', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('Transaksi', route('user.transaction'));
});


/* ACCOUNT */
Breadcrumbs::for('account', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Akun', route('admin.account.index'));
});

/* VERIFICATOR */
Breadcrumbs::for('verificator', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Verifikator', route('admin.verificator.index'));
});

Breadcrumbs::for('verificator.create', function (BreadcrumbTrail $trail) {
    $trail->parent('verificator');
    $trail->push('Tambah Verifikator', route('admin.verificator.create'));
});

Breadcrumbs::for('verificator.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('verificator');
    $trail->push($data->fullname);
    $trail->push('Edit', route('admin.verificator.edit', $data));
});

/* PROFILE */
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil', route('admin.profile.index'));
});

/* COURSE */
Breadcrumbs::for('course', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Kursus', route('admin.course.index'));
});

Breadcrumbs::for('course.create', function (BreadcrumbTrail $trail) {
    $trail->parent('course');
    $trail->push('Tambah Kursus', route('admin.course.create'));
});

Breadcrumbs::for('course.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course');
    $trail->push($data->title);
    $trail->push('Edit', route('admin.course.edit', $data));
});

/* COURSE CATEGORY */
Breadcrumbs::for('course_category', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Kategori Kursus', route('admin.course-category.index'));
});

Breadcrumbs::for('course_category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('course_category');
    $trail->push('Tambah Kategori Kursus', route('admin.course-category.create'));
});

Breadcrumbs::for('course_category.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_category');
    $trail->push($data->name);
    $trail->push('Edit', route('admin.course-category.edit', $data));
});

/* COURSE CHAPTER */
Breadcrumbs::for('course_chapter', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course');
    $trail->push($data->title);
    $trail->push('Materi', route('admin.course-chapter.index', $data));
});

Breadcrumbs::for('course_chapter.create', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_chapter', $data);
    $trail->push('Tambah Materi', route('admin.course-chapter.create', $data));
});

Breadcrumbs::for('course_chapter.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_chapter', $data->course);
    $trail->push($data->title);
    $trail->push('Edit', route('admin.course-chapter.edit', [$data->course_id, $data->id]));
});

/* COURSE SUB CHAPTER */
Breadcrumbs::for('course_sub_chapter', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_chapter', $data->course);
    $trail->push($data->title);
    $trail->push('Sub Materi', route('admin.course-sub-chapter.index', $data));
});

Breadcrumbs::for('course_sub_chapter.create', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_sub_chapter', $data);
    $trail->push('Tambah Sub Materi', route('admin.course-sub-chapter.create', $data));
});

Breadcrumbs::for('course_sub_chapter.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_sub_chapter', $data->courseChapter);
    $trail->push($data->title);
    // $trail->push('Edit', route('admin.course-sub-chapter.edit', [$data->course_chapter_id, $data->id]));
});

/* MINIMUM COURSE */
Breadcrumbs::for('mincourse', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Minimum Kursus', route('admin.mincourse.index'));
});

Breadcrumbs::for('mincourse.create', function (BreadcrumbTrail $trail) {
    $trail->parent('mincourse');
    $trail->push('Minimum Kursus', route('admin.mincourse.create'));
});

Breadcrumbs::for('mincourse.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('mincourse');
    $trail->push($data->name);
    $trail->push('Edit', route('admin.mincourse.edit', $data));
});

/* QUIZ */
Breadcrumbs::for('quiz', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('course_chapter', $data->course);
    $trail->push($data->title);
    $trail->push('Quiz', route('admin.quiz.index',  $data));
});

Breadcrumbs::for('quiz.create', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('quiz', $data);
    $trail->push('Tambah Quiz', route('admin.quiz.create', $data));
});

/* QUESTION */
Breadcrumbs::for('question', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('quiz', $data->courseChapter);
    $trail->push($data->title);
    $trail->push('Soal', route('admin.question.index',  $data));
});

Breadcrumbs::for('question.create', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('question', $data);
    $trail->push('Tambah Soal', route('admin.question.create', $data));
});

Breadcrumbs::for('question.edit', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('question', $data->quiz);
    $trail->push($data->question);
    $trail->push('Edit', route('admin.question.edit', [$data->quiz_id, $data->id]));
});


/* VERIFICATOR DASHBOARD */
Breadcrumbs::for('verificator-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('verificator.dashboard'));
});

/* COURSE REQUEST */
Breadcrumbs::for('course-request', function (BreadcrumbTrail $trail) {
    $trail->parent('verificator-dashboard');
    $trail->push('Permintaan Kursus', route('verificator.course-request.index'));
});


/* INSTITUTION */

Breadcrumbs::for('institution-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('institution.dashboard'));
});

Breadcrumbs::for('institution.management-account', function (BreadcrumbTrail $trail) {
    $trail->push('Manajemen Akun', route('institution.management-account'));
});
