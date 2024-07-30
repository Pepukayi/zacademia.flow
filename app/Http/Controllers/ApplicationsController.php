<?php

namespace App\Http\Controllers;

use App\Dispatchers\MailDispatcher;
use App\Http\Resources\AgreementsResource;
use App\Http\Resources\GeographicalDetailsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VerificationDocumentsResource;
use App\Mail\QueryCompleted;
use App\Models\Agreements;
use App\Models\AssetValues;
use App\Models\Coin;
use App\Models\GeographicalDetails;
use App\Models\Queries;
use App\Models\User;
use App\Models\VerificationDocuments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ApplicationsController extends Controller
{
    public function validateCurrentLevel()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'current_level' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-funding-level');
    }

    public function validateFundingLevel()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'funding_level' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-identity-document');
    }

    public function validateIdentityDocument()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'id_number' => ['required', 'string', 'max:255'],
                              'id_copy' => ['required',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'back_id_copy' => [],
                          ]);

        return redirect('/profile-residence');
    }

    public function validateResidenceCitizenship()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'country_residence' => ['required', 'string', 'max:255'],
                              'country_citizenship' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-birth-day');
    }

    public function validateBirthDay()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'date_of_birth' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-demographics');
    }

    public function validateDemographics()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'gender' => ['required', 'string', 'max:255'],
                              'ethnicity' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-address');
    }

    public function validateAddress()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'street_address' => ['required', 'string', 'max:255'],
                              'suburb' => ['required', 'string', 'max:255'],
                              'city' => ['required', 'string', 'max:20'],
                              'province_state' => ['required', 'string', 'max:255'],
                              'postal_zip_code' => ['required', 'string', 'max:20'],
                              'proof_of_address' => ['required',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

        return redirect('/profile-spouse');
    }

    public function validateSpouseInformation()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        $validated = Request::validate([
                                           'marital_status' => ['required', 'string', 'max:255'],
                                           'spouse_name' => [
                                               'required_if:marital_status,=,Yes',
                                               'nullable',
                                               'string',
                                               'max:255'
                                           ],
                                           'spouse_email' => [
                                               'required_if:marital_status,=,Yes',
                                               'nullable',
                                               'string',
                                               'max:20'
                                           ],
                                           'spouse_contact' => [
                                               'required_if:marital_status,=,Yes',
                                               'nullable',
                                               'string',
                                               'max:255'
                                           ],
                                           'dependents' => [
                                               'required_if:marital_status,=,Yes',
                                               'nullable',
                                               'string',
                                               'max:20'
                                           ],
                                           'parental_dependence' => [
                                               'required_if:marital_status,=,No',
                                               'required_if:marital_status,=,Divorced',
                                               'nullable',
                                               'string',
                                               'max:20'
                                           ],
                                           'spouse_id' => [
                                               'required_if:marital_status,=,Yes',
                                               'nullable',
                                               'file',
                                               'mimes:pdf,jpg,jpeg,png,gif',
                                               'max:11240'
                                           ],
                                       ]);

        Log::debug(__METHOD__ . ' $validated: ' . print_r($validated, true));

        if ($validated['marital_status'] === 'Yes') {
            return redirect('/profile-household-income');
        } elseif (in_array($validated['marital_status'], ['No', 'Divorced'])) {
            if ($validated['parental_dependence'] == 'Yes') {
                return redirect('/profile-parent-guardian');
            } elseif ($validated['parental_dependence'] == 'No') {
                return redirect('/profile-single-income');
            }
        }
    }

    public function validateHouseholdIncome()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'employment_details' => ['required', 'string', 'max:255'],
                              'annual_income' => [
                                  'required_if:employment_details,=,Yes we are both working',
                                  'required_if:employment_details,=,I am the only one who is working',
                                  'nullable',
                                  'string',
                                  'max:255'
                              ],
                              'spouse_annual_income' => [
                                  'required_if:employment_details,=,Yes we are both working',
                                  'required_if:employment_details,=,My spouse is the only one who is working',
                                  'nullable',
                                  'string',
                                  'max:20'
                              ],
                              'proof_of_income' => [
                                  'required_if:employment_details,=,Yes we are both working',
                                  'required_if:employment_details,=,I am the only one who is working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'spouse_proof_of_income' => [
                                  'required_if:employment_details,=,Yes we are both working',
                                  'required_if:employment_details,=,My spouse is the only one who is working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'affadavit_spouse_not_working' => [
                                  'required_if:employment_details,=,I am the only one who is working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'affadavit_not_working' => [
                                  'required_if:employment_details,=,My spouse is the only one who is working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'affadavit_both_not_working' => [
                                  'required_if:employment_details,=,We are both not working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

        return redirect('/profile-disability');
    }

    public function validateSingleIncome()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'employment_details' => ['required', 'string', 'max:255'],
                              'annual_income' => [
                                  'required_if:employment_details,=,Yes',
                                  'nullable',
                                  'string',
                                  'max:255'
                              ],
                              'proof_of_income' => [
                                  'required_if:employment_details,=,Yes',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'affadavit_not_working' => [
                                  'required_if:employment_details,=,No',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
            ]);

        return redirect('/profile-disability');
    }

    public function validateDisability()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'disability' => ['required', 'string', 'max:255'],
                              'disabilities' => ['required_if:disability,=,Yes', 'array', 'max:255'],
                              'disability_count' => ['numeric','nullable', 'max:255'],
                              'disabilities.0.name' => ['required_if:disability,=,Yes', 'nullable', 'string', 'max:255'],
                              'disabilities.1.name' => ['required_if:disability_count,=,2', 'nullable', 'string', 'max:255'],
                              'disabilities.2.name' => ['required_if:disability_count,=,3', 'nullable', 'string', 'max:255'],
                              'disabilities.0.proof' => [
                                  'required_if:disability,=,Yes',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'disabilities.1.proof' => [
                                  'required_if:disability_count,=,2',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'disabilities.2.proof' => [
                                  'required_if:disability_count,=,3',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

        return redirect('/profile-nsfas');
    }

    public function validateParentGuardian()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'stay_in' => ['required', 'string', 'max:255'],
                              'parent_guardian_email' => ['nullable', 'string', 'max:255'],
                              'parent_guardian_phone_number' => ['nullable', 'string', 'max:20'],
                              'dependents' => ['nullable', 'string', 'max:255'],
                          ]);

        return redirect('/profile-parent-guardian-income');
    }

    public function validateParentGuardianIncome()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'working_parents_guardians' => ['required', 'string', 'max:255'],
                              'parent_annual_income' => [
                                  'required_if:working_parents_guardians,=,One parent/guardian is working',
                                  'required_if:working_parents_guardians,=,Both parents/guardians are working',
                                  'nullable',
                                  'string',
                                  'max:255'
                              ],
                              'other_parent_annual_income' => [
                                  'required_if:working_parents_guardians,=,Both parents/guardians are working',
                                  'nullable',
                                  'string',
                                  'max:20'
                              ],
                              'affadavit_parents_dont_work' => [
                                  'required_if:working_parents_guardians,=,None',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'affadavit_orphan' => [
                                  'required_if:working_parents_guardians,=,I am an orphan',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'parent_proof_of_income' => [
                                  'required_if:working_parents_guardians,=,One parent/guardian is working',
                                  'required_if:working_parents_guardians,=,Both parents/guardians are working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                              'other_parent_proof_of_income' => [
                                  'required_if:working_parents_guardians,=,Both parents/guardians are working',
                                  'nullable',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

        return redirect('/profile-disability');
    }

    public function validateNSFAS()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'nsfas_history' => ['required', 'string', 'max:255'],
                              'nsfas_student' => ['nullable', 'string', 'max:255'],
                              'nsfas_registration_number' => ['nullable', 'string', 'max:50'],
                          ]);

        return redirect('/profile-high-school');
    }

    public function validateHighSchool()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'high_school' => ['required', 'string', 'max:255'],
                              'high_school_level' => ['required', 'max:255'],
                              'curriculum' => ['required', 'string', 'max:50'],
                          ]);

        return redirect('/profile-school-subjects');
    }

    public function validateSchoolSubjects()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'subject_count' => ['nullable', 'numeric', 'max:255'],
                              'subjects' => ['required', 'array'],
                              'latest_results' => [
                                  'required',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

        return redirect('/profile-high-school-graduation');
    }

    public function validateHighSchoolGraduation()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'high_school_graduate' => ['required', 'string', 'max:255'],
                              'high_school_graduation_year' => ['nullable', 'numeric', 'max:2100'],
                          ]);

        return redirect('/profile-target-institutions');
    }

    public function validateTargetInstitution()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'institution_type' => ['required', 'string', 'max:255'],
                              'other_institution_type' => ['nullable', 'string', 'max:255'],
                          ]);

        return redirect('/profile-target-career-path');
    }

    public function validateTargetCareerPath()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'preferred_institution' => ['required', 'string', 'max:255'],
                              'preferred_career_path' => ['required', 'string', 'max:255'],
                              'preferred_study_programme' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-background');
    }

    public function validateBackgroundInformation()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'background_circumstances' => ['required', 'string', 'max:255'],
                              'achievements' => ['required', 'string', 'max:255'],
                              'leadership_roles' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-talents');
    }

    public function validateTalentsInformation()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'strength_weaknesses' => ['required', 'string', 'max:255'],
                              'talent_study_relation' => ['required', 'string', 'max:255'],
                              'personal_statement' => ['required', 'string', 'max:255'],
                          ]);

        return redirect('/profile-picture');
    }
    public function validateProfilePicture()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        Request::validate([
                              'profile_picture' => [
                                  'required',
                                  'file',
                                  'mimes:pdf,jpg,jpeg,png,gif',
                                  'max:11240'],
                          ]);

//        $applicationData = Request::all();
//
//        $result = $this->saveAndCompleteApplication($applicationData);

        return redirect('/profile-creation-complete');
    }

    public function saveAndCompleteApplication()
    {
        Log::debug(__METHOD__ . ' bof: ');
        Log::debug(__METHOD__ . ' Request: ' . print_r(Request::all(), true));

        $applicationData = Request::all();

        return DB::transaction(function () use ($applicationData) {


        });
    }


    public function listApplications()
    {
        Log::debug('Request : ' . print_r(Request::all(), true));
        return Inertia::render('Applications', [
            'applications' => UserResource::collection(User::query()
                                                    ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at', 'users.verified', 'geographical_details.country', 'geographical_details.city', 'verification_documents.filename')
                                                    ->join('geographical_details', 'geographical_details.user_id','=','users.id')
                                                    ->join('verification_documents', 'verification_documents.user_id','=','users.id')
                                                    ->where('verification_documents.doc_type', '=', 'passport_photo')
                                                    ->when(Request::input('search'), function ($query, $search) {
                                                        Log::debug(__METHOD__ . ' Searching by search string : ' . $search);
                                                        $query->where('users.first_name', 'like', "%{$search}%");
//                                                            ->where('users.last_name', 'like', "%{$search}%");
                                                    })
                                                    ->when(Request::input('status'), function ($query, $status) {
                                                        switch($status)
                                                        {
                                                            case 1:
                                                                Log::debug(__METHOD__ . ' Fetching only verified.');
                                                                $query->where('users.verified', $status);
                                                                break;
                                                            case 2:
                                                                Log::debug(__METHOD__ . ' Fetching only rejected.');
                                                                $query->where('users.verified', $status);
                                                                break;
                                                            case 3:
                                                                Log::debug(__METHOD__ . ' Fetching only unverified.');
                                                                $query->whereNull('users.verified');
                                                                break;
                                                            default:
                                                                Log::debug(__METHOD__ . ' Fetching all applications.');
                                                                break;
                                                        }
                                                    })
                                                   ->when(Request::input('sortName'), function ($query, $sortName) {
                                                       Log::debug(__METHOD__ . ' Sorting by names : ' . $sortName);
                                                       $query->orderBY('users.first_name', $sortName);
                                                   })
                                                   ->when(Request::input('sortStatus'), function ($query, $sortStatus) {
                                                       Log::debug(__METHOD__ . ' Sorting by status : ' . $sortStatus);
                                                       $query->orderBY('users.verified', $sortStatus);
                                                   })
                                                   ->when(Request::input('sortRegistration'), function ($query, $sortRegistration) {
                                                       Log::debug(__METHOD__ . ' Sorting by status : ' . $sortRegistration);
                                                       $query->orderBY('users.created_at', $sortRegistration);
                                                   })
                                                    ->paginate(5)
                                                    ->withQueryString()),
            'filters' => Request::only(['search', 'status']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    }

    public function viewApplication($id)
    {
        Log::debug(__METHOD__ . ' : $id' . print_r($id, true));
        return Inertia::render('ViewApplication', [
            'application_data' => [
                'user_data' => UserResource::collection(User::query()
                    ->where('id', $id)
                    ->get()),
                'geographical_details' => GeographicalDetailsResource::collection(GeographicalDetails::query()
                                                                                      ->where('user_id', $id)
                                                                                      ->get()),
                'verification_documents' => [
                    'id_copy' => VerificationDocumentsResource::collection(VerificationDocuments::query()
                                                                                      ->where(['user_id' => $id, 'doc_type' => 'id_copy'])
                                                                                      ->get()),
                    'proof_of_address' => VerificationDocumentsResource::collection(VerificationDocuments::query()
                                                                               ->where(['user_id' => $id, 'doc_type' => 'proof_of_address'])
                                                                               ->get()),
                    'passport_photo' => VerificationDocumentsResource::collection(VerificationDocuments::query()
                                                                               ->where(['user_id' => $id, 'doc_type' => 'passport_photo'])
                                                                               ->get())
                ],
                'agreements' => AgreementsResource::collection(Agreements::class::query()
                                                                                      ->where('user_id', $id)
                                                                                      ->get()),
            ]
        ]);
    }

    public function verifyApplication($id, $status)
    {
        Log::debug(__METHOD__ . ' : bof');
        Log::debug(__METHOD__ . ' : $id : '. $id);
        Log::debug(__METHOD__ . ' : $status : '. $status);

        $user = User::query()->where('id', $id)
            ->first();


        //Verification status
        //verified = 1
        //rejected = 2
        if($status == 'verified')
        {
            $user->verified = 1;
            $user->verified_at = Carbon::now();
            $user->save();

            $sendMailResult = $this->sendVerifiedNotificationToApplicant($user);
        }elseif ($status == 'rejected')
        {
            $user->verified = 2;
            $user->verified_at = Carbon::now();
            $user->save();

            $sendMailResult = $this->sendRejectedNotificationToApplicant($user);
        }elseif ($status == 'unverified')
        {
            $user->verified = null;
            $user->verified_at = null;
            $user->save();

            $sendMailResult = $this->sendUnverifiedNotificationToApplicant($user);
        }


        return to_route('listApplications');
//        return to_route('viewApplication', ['user_id' => $id]);

//        return to_route('viewApplication', [
//            'application_data' => [
//                'user_data' => UserResource::collection(User::query()
//                                                            ->where('id', $id)
//                                                            ->get()),
//                'geographical_details' => GeographicalDetailsResource::collection(GeographicalDetails::query()
//                                                                                      ->where('user_id', $id)
//                                                                                      ->get()),
//                'verification_documents' => [
//                    'id_copy' => VerificationDocumentsResource::collection(VerificationDocuments::query()
//                                                                               ->where(['user_id' => $id, 'doc_type' => 'id_copy'])
//                                                                               ->get()),
//                    'proof_of_address' => VerificationDocumentsResource::collection(VerificationDocuments::query()
//                                                                                        ->where(['user_id' => $id, 'doc_type' => 'proof_of_address'])
//                                                                                        ->get()),
//                    'passport_photo' => VerificationDocumentsResource::collection(VerificationDocuments::query()
//                                                                                      ->where(['user_id' => $id, 'doc_type' => 'passport_photo'])
//                                                                                      ->get())
//                ],
//                'agreements' => AgreementsResource::collection(Agreements::class::query()
//                                                                   ->where('user_id', $id)
//                                                                   ->get()),
//            ]
//        ]);
    }

    public function sendVerifiedNotificationToApplicant(User $user)
    {
        Log::debug(__METHOD__ . ' : bof');

        $mailData = [
            'subject' => 'Colmin Group Application Status Change',
            'data' => [
                'mail_title' => 'Your Colmin Group Application Verified',
                'first_name' => $user->first_name,
            ],
            'tomail' => $user->email,
            'frommail' => env('MAIL_FROM_ADDRESS', 'admin@colmingroup.com'),
            'type' => 'template',
            'delay' => 0,
            'template_name' => 'emails.application_reviewed_notification',
        ];

        Log::debug('$mailData : ' .print_r($mailData, true));

        $mailDispatcher = new MailDispatcher();
        $sendMailResult =  $mailDispatcher->dispatchMail($mailData);
        Log::debug(__METHOD__ . ' : $sendMailResult : ' . print_r($sendMailResult, true));

        Log::debug(__METHOD__ . ' : eof');
        return $sendMailResult;
    }

    public function sendRejectedNotificationToApplicant(User $user)
    {
        Log::debug(__METHOD__ . ' : bof');

        $mailData = [
            'subject' => 'Colmin Group Application Status Change',
            'data' => [
                'mail_title' => 'Your Colmin Group Application Verified',
                'first_name' => $user->first_name,
            ],
            'tomail' => $user->email,
            'frommail' => env('MAIL_FROM_ADDRESS', 'admin@colmingroup.com'),
            'type' => 'template',
            'delay' => 0,
            'template_name' => 'emails.application_rejected_notification',
        ];

        Log::debug('$mailData : ' .print_r($mailData, true));

        $mailDispatcher = new MailDispatcher();
        $sendMailResult =  $mailDispatcher->dispatchMail($mailData);
        Log::debug(__METHOD__ . ' : $sendMailResult : ' . print_r($sendMailResult, true));

        Log::debug(__METHOD__ . ' : eof');
        return $sendMailResult;
    }

    public function sendUnverifiedNotificationToApplicant(User $user)
    {
        Log::debug(__METHOD__ . ' : bof');

        $mailData = [
            'subject' => 'Colmin Group Application Status Change',
            'data' => [
                'mail_title' => 'Your Colmin Group Application Unverified',
                'first_name' => $user->first_name,
            ],
            'tomail' => $user->email,
            'frommail' => env('MAIL_FROM_ADDRESS', 'admin@colmingroup.com'),
            'type' => 'template',
            'delay' => 0,
            'template_name' => 'emails.application_unverified_notification',
        ];

        Log::debug('$mailData : ' .print_r($mailData, true));

        $mailDispatcher = new MailDispatcher();
        $sendMailResult =  $mailDispatcher->dispatchMail($mailData);
        Log::debug(__METHOD__ . ' : $sendMailResult : ' . print_r($sendMailResult, true));

        Log::debug(__METHOD__ . ' : eof');
        return $sendMailResult;
    }

    public function applicationsOverview()
    {
        Log::debug(__METHOD__ . ' : bof' );

//        $users = User::query();
        $numOfUsers = User::query()->get()->count();
        $verifiedUsers = User::query()->where('verified' , 1)->get()->count();
        $rejectedUsers = User::query()->where('verified' , '=', 2)->get()->count();
        $unverifiedUsers = User::query()->where(['verified' => null])->get()->count();

        $coins = Coin::select('created_at')->whereNotNull('user_id')->get()->count();


        return Inertia::render('ApplicationOverview', [
            'overview_data' => [
                'num_of_users' => $numOfUsers,
                'verified_users' => $verifiedUsers,
                'rejected_users' => $rejectedUsers,
                'unverified_users' => $unverifiedUsers,
                'coins_purchased_value' => $coins * AssetValues::select('coin_price')->first()->coin_price,
            ]
        ]);
    }

    public function querySubmission(\Illuminate\Http\Request $request): \Inertia\Response
    {
        Log::debug('Request : ' . print_r($request->all(), true));

        $validated = $request->validate([
                                            'first_name' => ['string', 'max:100'],
                                            'last_name' => ['string', 'max:100'],
                                            'phone_number' => ['string', 'max:100'],
                                            'email' => ['string', 'max:100'],
//                                            'subject' => ['string', 'max:100'],
                                            'query' => ['string'],
                                        ]);

        Log::debug(__METHOD__ . '$validated data: ' . print_r($validated, true));

        $query = new QueryCompleted($validated);
        Mail::to('admin@colmingroup.com')->queue($query);
//        Mail::to('pesto.chitondo@gmail.com')->queue($query);

        $queriesRecord = Queries::create($validated);

        return Inertia::render('QuerySubmitted');
    }

    public function routeToQuerySubmitted(): \Inertia\Response
    {
        return Inertia::render('QuerySubmitted');
    }
}
