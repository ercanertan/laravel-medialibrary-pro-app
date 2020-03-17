<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMultipleUploadsRequest;
use App\Models\FormSubmission;
use Spatie\MedialibraryPro\Tests\Http\Controllers\UploadControllerTest;

class FormSubmissionController
{
    public function showVue()
    {
        return view('uploads.vue');
    }

    public function showReact()
    {
        return view('uploads.react');
    }

    public function store(StoreMultipleUploadsRequest $request)
    {
        /** @var FormSubmission $formSubmission */
        $formSubmission = FormSubmission::create(['name' => $request->name ?? 'nothing'])
            ->addMultipleMediaFromTemporaryUploads($request->media)->each->toMediaCollection('images');

        return back();
    }
}
