<?php

namespace App\Http\Domains\BursaryApplications;

use App\Models\UserDocuments;
use App\Models\UserGeographicalInformation;
use App\Models\UserGuardianInformation;
use App\Models\UserPersonalInformation;
use App\Models\UserSpousalInformation;
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
        UserPersonalInformation::create($personalInformationData);

        Log::debug(__METHOD__ . ' : eof ');
    }

    public function saveGeographicalInformation(int $userId, array $personalInformation)
    {
        Log::debug(__METHOD__ . ' : bof ' , func_get_args());

        $geographicalInformationColumns = Schema::getColumnListing('user_geographical_information');

        Log::debug('$geographicalInformationColumns : ' . print_r($geographicalInformationColumns, true));

        $geographicalInformationData = array_filter($personalInformation,function ($personalInfo) use ($geographicalInformationColumns){
            Log::debug('$personalInfo : ' . print_r($personalInfo, true));
            return in_array($personalInfo, $geographicalInformationColumns);
        }, ARRAY_FILTER_USE_KEY);

        Log::debug('$geographicalInformationData Before: ' . print_r($geographicalInformationData, true));

        if(!empty($geographicalInformationData['proof_of_address']))
        {
            $proofOfAddress = $this->writeToDisk($geographicalInformationData['proof_of_address'], $userId);

            if($proofOfAddress)
            {
                $this->saveDocument($proofOfAddress, $userId, $geographicalInformationData['proof_of_address'], 'proof_of_address', 'bursary_application');
                $geographicalInformationData['proof_of_address'] = $proofOfAddress;
            }
        }

        Log::debug('$geographicalInformationData Updated: ' . print_r($geographicalInformationData, true));


        $geographicalInformationData['user_id'] = $userId;
        UserGeographicalInformation::create($geographicalInformationData);

        Log::debug(__METHOD__ . ' : eof ');
    }

    public function saveGuardianInformation(int $userId, array $personalInformation)
    {
        Log::debug(__METHOD__ . ' : bof ' , func_get_args());

        $guardianInformationColumns = Schema::getColumnListing('user_guardian_information');

        Log::debug('$guardianInformationColumns : ' . print_r($guardianInformationColumns, true));

        $guardianInformationData = array_filter($personalInformation,function ($personalInfo) use ($guardianInformationColumns){
            Log::debug('$personalInfo : ' . print_r($personalInfo, true));
            return in_array($personalInfo, $guardianInformationColumns);
        }, ARRAY_FILTER_USE_KEY);

        Log::debug('$guardianInformationData Before: ' . print_r($guardianInformationData, true));

        if(!empty($guardianInformationData['parent_id']))
        {
            $parentId = $this->writeToDisk($guardianInformationData['parent_id'], $userId);

            if($parentId)
            {
                $this->saveDocument($parentId, $userId, $guardianInformationData['parent_id'], 'parent_id', 'bursary_application');
                $guardianInformationData['parent_id'] = $parentId;
            }
        }

        if(!empty($guardianInformationData['other_parent_id']))
        {
            $otherParentId = $this->writeToDisk($guardianInformationData['other_parent_id'], $userId);

            if($otherParentId)
            {
                $this->saveDocument($otherParentId, $userId, $guardianInformationData['other_parent_id'], 'other_parent_id', 'bursary_application');
                $guardianInformationData['other_parent_id'] = $otherParentId;
            }
        }

        if(!empty($guardianInformationData['affadavit_parents_dont_work']))
        {
            $affadavitParentsDontWork = $this->writeToDisk($guardianInformationData['affadavit_parents_dont_work'], $userId);

            if($affadavitParentsDontWork)
            {
                $this->saveDocument($affadavitParentsDontWork, $userId, $guardianInformationData['affadavit_parents_dont_work'], 'affadavit_parents_dont_work', 'bursary_application');
                $guardianInformationData['affadavit_parents_dont_work'] = $affadavitParentsDontWork;
            }
        }

        if(!empty($guardianInformationData['parent_proof_of_income']))
        {
            $parentProofOfIncome = $this->writeToDisk($guardianInformationData['parent_proof_of_income'], $userId);

            if($parentProofOfIncome)
            {
                $this->saveDocument($parentProofOfIncome, $userId, $guardianInformationData['parent_proof_of_income'], 'parent_proof_of_income', 'bursary_application');
                $guardianInformationData['parent_proof_of_income'] = $parentProofOfIncome;
            }
        }

        if(!empty($guardianInformationData['other_parent_proof_of_income']))
        {
            $otherParentProofOfIncome = $this->writeToDisk($guardianInformationData['other_parent_proof_of_income'], $userId);

            if($otherParentProofOfIncome)
            {
                $this->saveDocument($otherParentProofOfIncome, $userId, $guardianInformationData['other_parent_proof_of_income'], 'other_parent_proof_of_income', 'bursary_application');
                $guardianInformationData['other_parent_proof_of_income'] = $otherParentProofOfIncome;
            }
        }

        Log::debug('$guardianInformationData Updated: ' . print_r($guardianInformationData, true));


        $guardianInformationData['user_id'] = $userId;
        UserGuardianInformation::create($guardianInformationData);

        Log::debug(__METHOD__ . ' : eof ');
    }

    public function saveSpousalInformation(int $userId, array $personalInformation)
    {
        Log::debug(__METHOD__ . ' : bof ' , func_get_args());

        $spousalInformationColumns = Schema::getColumnListing('user_spousal_information');

        Log::debug('$spousalInformationColumns : ' . print_r($spousalInformationColumns, true));

        $spousalInformationData = array_filter($personalInformation,function ($personalInfo) use ($spousalInformationColumns){
            Log::debug('$personalInfo : ' . print_r($personalInfo, true));
            return in_array($personalInfo, $spousalInformationColumns);
        }, ARRAY_FILTER_USE_KEY);

        Log::debug('$spousalInformationData Before: ' . print_r($spousalInformationData, true));

        if(!empty($spousalInformationData['spouse_id']))
        {
            $spouseId = $this->writeToDisk($spousalInformationData['spouse_id'], $userId);

            if($spouseId)
            {
                $this->saveDocument($spouseId, $userId, $spousalInformationData['spouse_id'], 'spouse_id', 'bursary_application');
                $spousalInformationData['spouse_id'] = $spouseId;
            }
        }

        if(!empty($spousalInformationData['spouse_proof_of_income']))
        {
            $spouseProofOfIncome = $this->writeToDisk($spousalInformationData['spouse_proof_of_income'], $userId);

            if($spouseProofOfIncome)
            {
                $this->saveDocument($spouseProofOfIncome, $userId, $spousalInformationData['spouse_proof_of_income'], 'spouse_proof_of_income', 'bursary_application');
                $spousalInformationData['spouse_proof_of_income'] = $spouseProofOfIncome;
            }
        }

        if(!empty($spousalInformationData['affadavit_spouse_not_working']))
        {
            $affadavitSpouseNotWorking = $this->writeToDisk($spousalInformationData['affadavit_spouse_not_working'], $userId);

            if($affadavitSpouseNotWorking)
            {
                $this->saveDocument($affadavitSpouseNotWorking, $userId, $spousalInformationData['affadavit_spouse_not_working'], 'affadavit_spouse_not_working', 'bursary_application');
                $spousalInformationData['affadavit_spouse_not_working'] = $affadavitSpouseNotWorking;
            }
        }

        if(!empty($spousalInformationData['affadavit_not_working']))
        {
            $affadavitNotWorking = $this->writeToDisk($spousalInformationData['affadavit_not_working'], $userId);

            if($affadavitNotWorking)
            {
                $this->saveDocument($affadavitNotWorking, $userId, $spousalInformationData['affadavit_not_working'], 'affadavit_not_working', 'bursary_application');
                $spousalInformationData['affadavit_not_working'] = $affadavitNotWorking;
            }
        }

        if(!empty($spousalInformationData['affadavit_both_not_working']))
        {
            $affadavitBothNotWorking = $this->writeToDisk($spousalInformationData['affadavit_both_not_working'], $userId);

            if($affadavitBothNotWorking)
            {
                $this->saveDocument($affadavitBothNotWorking, $userId, $spousalInformationData['affadavit_both_not_working'], 'affadavit_both_not_working', 'bursary_application');
                $spousalInformationData['affadavit_both_not_working'] = $affadavitBothNotWorking;
            }
        }

        Log::debug('$spousalInformationData Updated: ' . print_r($spousalInformationData, true));


        $spousalInformationData['user_id'] = $userId;
        UserSpousalInformation::create($spousalInformationData);

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
