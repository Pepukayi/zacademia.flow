<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class UpdateRequestsWithDocs
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('testing')) {
            $applicationData = $request->all();
            Log::debug(__METHOD__ . ' : testing true');
            $fileToUpload = new UploadedFile('/home/david/development/zacademia.flow/storage/docs/my_pic.png', true);

            $applicationData['personal_information']['id_copy'] = $fileToUpload;
            $applicationData['personal_information']['back_id_copy'] = $fileToUpload;
            $applicationData['personal_information']['proof_of_address'] = $fileToUpload;
            $applicationData['personal_information']['spouse_id'] = $fileToUpload;
            $applicationData['personal_information']['proof_of_income'] = $fileToUpload;
            $applicationData['personal_information']['spouse_proof_of_income'] = $fileToUpload;
            $applicationData['personal_information']['affadavit_spouse_not_working'] = $fileToUpload;
            $applicationData['personal_information']['affadavit_not_working'] = $fileToUpload;
            $applicationData['personal_information']['affadavit_both_not_working'] = $fileToUpload;
            $applicationData['personal_information']['disabilities'][0]['proof'] = $fileToUpload;
            $applicationData['personal_information']['disabilities'][1]['proof'] = $fileToUpload;
            $applicationData['personal_information']['disabilities'][2]['proof'] = $fileToUpload;
            $applicationData['personal_information']['parent_id'] = $fileToUpload;
            $applicationData['personal_information']['other_parent_id'] = $fileToUpload;
            $applicationData['personal_information']['affadavit_parents_dont_work'] = $fileToUpload;
            $applicationData['personal_information']['affadavit_orphan'] = $fileToUpload;
            $applicationData['personal_information']['parent_proof_of_income'] = $fileToUpload;
            $applicationData['personal_information']['other_parent_proof_of_income'] = $fileToUpload;
            $applicationData['school_information']['latest_results'] = $fileToUpload;
            $applicationData['background_information']['profile_picture'] = $fileToUpload;

            $request->merge(
                [
                    'personal_information' => $applicationData['personal_information'],
                    'school_information' => $applicationData['personal_information'],
                    'background_information' => $applicationData['personal_information']
                ]
            );
        }

        Log::debug(__METHOD__ . ' : after ', $request->all());

        return $next($request);
    }
}
