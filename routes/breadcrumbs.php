<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Account > Index
Breadcrumbs::for('account', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Akun', route('admin.account.index'));
});
