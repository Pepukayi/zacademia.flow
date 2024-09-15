<?php

namespace App\Http\Domains\BursaryApplications;

use App\Models\UserDocuments;
use App\Models\UserPersonalInformation;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class BursaryApplications
{
    public function __construct()
    {
    }

    public function savePersonalInformation(int $userId, array $personalInformation)
    {
        Log::debug(__METHOD__ . ' : bof ' , func_get_args());

        $personalInformationColumns = Schema::getColumnListing('user_personal_information');

        Log::debug('$personalInformation : ' . print_r($personalInformation, true));
        Log::debug('$personalInformationColumns : ' . print_r($personalInformationColumns, true));

        $personalInformationData = array_filter($personalInformation,function ($personalInfo) use ($personalInformationColumns){
            Log::debug('$personalInfo : ' . print_r($personalInfo, true));
            return in_array($personalInfo, $personalInformationColumns);
        }, ARRAY_FILTER_USE_KEY);

        Log::debug('$personalInformationData Before: ' . print_r($personalInformationData, true));

        if(!empty($personalInformationData['proof_of_income']))
        {
            Log::debug('proof_of_income not empty');
            $proofOfIncome = $this->writeToDisk($personalInformationData['proof_of_income'], $userId);

            if($proofOfIncome)
            {
                $this->saveDocument($proofOfIncome, $userId, $personalInformationData['proof_of_income'], 'proof_of_income', 'bursary_application');
                $personalInformationData['proof_of_income'] = $proofOfIncome;
            }
        }

        if(!empty($personalInformationData['id_copy']))
        {
            Log::debug('id_copy not empty');
            $idCopy = $this->writeToDisk($personalInformationData['id_copy'], $userId);

            if($idCopy)
            {
                $this->saveDocument($idCopy, $userId, $personalInformationData['id_copy'], 'id_copy', 'bursary_application');
                $personalInformationData['id_copy'] = $idCopy;
            }
        }

        if(!empty($personalInformationData['back_id_copy']))
        {
            Log::debug('back_id_copy not empty');
            $backIdCopy = $this->writeToDisk($personalInformationData['back_id_copy'], $userId);

            if($backIdCopy)
            {
                $this->saveDocument($backIdCopy, $userId, $personalInformationData['back_id_copy'], 'back_id_copy', 'bursary_application');
                $personalInformationData['back_id_copy'] = $backIdCopy;
            }
        }

        if(!empty($personalInformationData['affadavit_orphan']))
        {
            Log::debug('affadavit_orphan not empty');
            $affadavitOrphan = $this->writeToDisk($personalInformationData['affadavit_orphan'], $userId);

            if($affadavitOrphan)
            {
                $this->saveDocument($affadavitOrphan, $userId, $personalInformationData['affadavit_orphan'], 'affadavit_orphan', 'bursary_application');
                $personalInformationData['affadavit_orphan'] = $affadavitOrphan;
            }
        }

        if(!empty($personalInformationData['disabilities']))
        {
            $newDisabilities = [];
            foreach ($personalInformationData['disabilities'] as $disability) {
                Log::debug('$disability not empty');
                $disabilityProof = $this->writeToDisk($disability['proof'], $userId);

                if($disabilityProof)
                {
                    $this->saveDocument($disabilityProof, $userId, $disability['proof'], 'disability_proof', 'bursary_application');
                    $disability['proof'] = $disabilityProof;
                    $newDisabilities[] = $disability;
                }
            }
            $personalInformationData['disabilities'] = $newDisabilities;
        }

        $personalInformationData['disabilities'] = json_encode($personalInformationData['disabilities']);
        Log::debug('$personalInformationData Updated: ' . print_r($personalInformationData, true));

        //TODO calculate this combinedIncome Value properly
//            $combinedIncome = $personalInformationData['annual_income'];


        $personalInformationData['user_id'] = $userId;
        $personalInformationResult = UserPersonalInformation::create($personalInformationData);

        Log::debug(__METHOD__ . ' : eof ');
    }

    public function saveDocument(string $filename, int $userId, UploadedFile|File $document, string $docType, string $submissionType = 'bursary_application')
    {
        Log::debug(__METHOD__ . ' : bof ');

        UserDocuments::firstOrCreate(
            [
                'user_id' => $userId,
                'name' => $document->getClientOriginalName(),
                'filename' => $filename,
                'size' => filesize($document->getPathname()),
                'submission_type' => $submissionType,
                'doc_type' => $docType,
                'file_ext' => $document->extension(),
            ]
        );

        Log::debug(__METHOD__ . ' : eof ');
    }

    public function writeToDisk(UploadedFile|File $upload, string $userId): string
    {
        Log::debug(__METHOD__ . ' bof: ');

        try {
            $fileName = Storage::disk('s3-private')->putFileAs(
                $userId,
                $upload,
                $upload->getClientOriginalName()
            );
        } catch (\Throwable $exception) {
            Log::error('message'. print_r($exception->getMessage(), true));
        }

        Log::debug(__METHOD__ . ' eof: ');
        return $fileName;
    }
}
