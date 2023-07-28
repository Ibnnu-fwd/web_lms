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
