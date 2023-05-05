<?php // routes/breadcrumbs.php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Dashboard
Breadcrumbs::for('Dashboard', function ($trail) {
$trail->push('Dashboard', route('home'));
});

// Dashboard / Documents / Document Scanner
Breadcrumbs::for('Document Scanner', function ($trail) {
    $trail->parent('Dashboard');
//    $trail->parent('Documents');
    $trail->push('Document Scanner', route('scanner'));
});

// Dashboard / Documents / My Documents
Breadcrumbs::for('My Documents', function ($trail) {
//    $trail->parent('Document Scanner');
    $trail->parent('Dashboard');
    $trail->push('My Documents', route('my_documents'));
});

// Dashboard / Documents / Incoming
Breadcrumbs::for('Incoming Documents', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Incoming Documents', route('incoming'));
});

// Dashboard / Documents / Received
Breadcrumbs::for('Received Documents', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Received Documents', route('received'));
});

// Dashboard / Documents / Outgoing
Breadcrumbs::for('Outgoing Documents', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Outgoing Documents', route('outgoing'));
});

// Dashboard / Documents / Hold
Breadcrumbs::for('Hold Documents', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Hold Documents', route('hold'));
});

// Dashboard / Documents / Returned
Breadcrumbs::for('Returned Documents', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Returned Documents', route('returned'));
});

// Dashboard / Documents / Trash Bin
Breadcrumbs::for('Trash Bin', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Trash Bin', route('trash'));
});


// Dashboard / Admin / Responsibility Center
Breadcrumbs::for('Responsibility Center', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Responsibility Center', route('rc'));
});

// Dashboard / Admin / Groups
Breadcrumbs::for('Groups', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Groups', route('group'));
});

// Dashboard / Admin / User Privileges
Breadcrumbs::for('User Privileges', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('User Privileges', route('user_privileges'));
});

// Dashboard / Admin / Document Settings
Breadcrumbs::for('Document Settings', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Document Settings', route('document_settings'));
});

// Dashboard / Admin / Link Lists
Breadcrumbs::for('Link List', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Link List', route('link_lists'));
});

// Dashboard / Application
Breadcrumbs::for('Application', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Application', route('application'));
});

// Dashboard / My Profile
Breadcrumbs::for('My Profile', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('My Profile', route('profile'));
});

// Dashboard / Schedule
Breadcrumbs::for('Schedule', function ($trail) {
    $trail->parent('Dashboard');
    $trail->push('Schedule', route('schedule'));
});
