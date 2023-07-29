<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/* HOME */

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
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
