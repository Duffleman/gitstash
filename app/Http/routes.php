<?php

Route::bind('repositories', function ($id) {

    if (starts_with($id, 'gh:')) {
        $github_id = substr($id, 3);
        return \App\Repository::where('github_id', $github_id)->firstOrFail();

    }
    return \App\Repository::findOrFail($id);
});

Route::resource('repositories', 'RepositoryController');
