<?php

namespace App\Actions\Fortify;

use App\Models\Agreements;
use App\Models\GeographicalDetails;
use App\Models\Team;
use App\Models\User;
use App\Models\VerificationDocuments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Ramsey\Uuid\Uuid;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Log::debug('User Data: ' . print_r($input, true));

        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => $this->passwordRules(),
            'terms_conditions' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'phone_number' => $input['phone_number'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

//    public function create(array $input): User
//    {
//        Log::debug('User Data: ' . print_r($input, true));
//
//        Request::validate([
//                              'popi' => ['required'],
//                              'terms_conditions' => ['required'],
//                              'newsletters_offers' => [],
//                          ]
//        );
//
////        Validator::make($input, [
////            'name' => ['required', 'string', 'max:255'],
////            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
////            'password' => $this->passwordRules(),
////            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
////        ])->validate();
//
//
//
//        return DB::transaction(function () use ($input) {
//
//            unset($input['personal_information']['password_confirmation']);
//
//            $input['personal_information']['password'] = Hash::make($input['personal_information']['password']);
//
//            Log::debug('$residentialInformation: ' . print_r($input['personal_information'], true));
//            $user = User::create($input['personal_information']);
//
//            $userId['user_id'] = $user->id;
//            $userId['id'] = Uuid::uuid4()->toString();
//            $residentialInformation = array_merge($input['residential_information'], $userId);
//
//            Log::debug('$residentialInformation: ' . print_r($residentialInformation, true));
//
//            $geographicalDetails = GeographicalDetails::create($residentialInformation);
//
//            foreach ($input['verification_documents'] as $key => $document)
//            {
//                $fileName = $this->writeToDisk($document, $user->id);
//
//                $document = VerificationDocuments::firstOrCreate(
//                    [
//                        'id' => Uuid::uuid4()->toString(),
//                        'user_id' => $user->id,
//                        'name' => $document->getClientOriginalName(),
//                        'filename' => $fileName,
//                        'size' => filesize($document->getPathname()),
//                        'doc_type' => $key,
//                        'file_ext' => $document->extension(),
//                    ]
//                );
//            }
//
//            $agreementsArray['popi'] = $input['popi'];
//            $agreementsArray['terms_conditions'] = $input['terms_conditions'];
//            $agreementsArray['newsletters_offers'] = $input['newsletters_offers'];
//            $agreementsArray['user_id'] = $user->id;
//            $agreementsArray['id'] = Uuid::uuid4()->toString();
//
//            $agreements = Agreements::create($agreementsArray);
//
//            return $user;
//
//            //Below is creating a team will need this functionality for the admin users
////            return tap(User::create([
////                'name' => $input['name'],
////                'email' => $input['email'],
////                'password' => Hash::make($input['password']),
////            ]), function (User $user) {
////                $this->createTeam($user);
////            });
//        });
//    }

    public function validateResidentialInformation(): \Inertia\Response
    {
        Log::debug(__METHOD__ . ' bof: ');

        $validationResult = Request::validate([
                                                  'street_address_1' => ['required', 'string', 'max:255'],
                                                  'street_address_2' => ['required', 'string', 'max:255'],
                                                  'city' => ['required', 'string', 'max:20'],
                                                  'state_province' => ['required', 'string', 'max:255'],
                                                  'country' => ['required', 'string', 'max:255'],
                                                  'zip_postal_code' => ['required', 'string', 'max:20'],
                                              ]);

        Log::debug(__METHOD__ . '$validationResult: ' . print_r($validationResult, true));

//        return Redirect::back()->with($validationResult);
        return Inertia::render('Auth/Documents');
    }

    public function routeToDocuments(): \Inertia\Response
    {
        return Inertia::render('Auth/Documents');
    }

    public function routeToResidential(): \Inertia\Response
    {
        return Inertia::render('Auth/Residential');
    }

    public function routeToAgreements(): \Inertia\Response
    {
        return Inertia::render('Auth/Agreements');
    }

    public function validateVerificationDocuments(): \Inertia\Response
    {
        Log::debug(__METHOD__ . ' bof: ');

        $validationResult = Request::validate([
                                                  'id_copy' => [
                                                      'required',
                                                      'file',
                                                      'mimes:pdf,jpg,jpeg,png,gif',
                                                      'max:11240'
                                                  ],
                                                  'proof_of_address' => [
                                                      'required',
                                                      'file',
                                                      'mimes:pdf,jpg,jpeg,png,gif',
                                                      'max:11240'
                                                  ],
                                                  'passport_photo' => [
                                                      'required',
                                                      'file',
                                                      'mimes:jpg,jpeg,png,gif',
                                                      'max:11240'
                                                  ],
                                              ]);

        Log::debug(__METHOD__ . '$validationResult: ' . print_r($validationResult, true));

//        return Redirect::back()->with($validationResult);
        return Inertia::render('Auth/Agreements');
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
