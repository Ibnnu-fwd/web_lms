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
