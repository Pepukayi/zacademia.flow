<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\ApplicationsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Start Personal Information
Route::inertia('/profile-current-level', 'BursaryApplication/CurrentLevel');
Route::inertia('/profile-funding-level', 'BursaryApplication/FundingLevel');
Route::inertia('/profile-identity-document', 'BursaryApplication/IdentityDocument');
Route::inertia('/profile-residence', 'BursaryApplication/ResidenceAndCitizenship');
Route::inertia('/profile-birth-day', 'BursaryApplication/BirthDay');
Route::inertia('/profile-demographics', 'BursaryApplication/Demographics');
Route::inertia('/profile-address', 'BursaryApplication/Address');
Route::inertia('/profile-spouse', 'BursaryApplication/Spouse');
Route::inertia('/profile-household-income', 'BursaryApplication/HouseholdIncome');
Route::inertia('/profile-single-income', 'BursaryApplication/SingleIncome');
Route::inertia('/profile-parent-guardian', 'BursaryApplication/ParentGuardian');
Route::inertia('/profile-other-parent-guardian', 'BursaryApplication/OtherParentGuardian');
Route::inertia('/profile-parent-guardian-income', 'BursaryApplication/ParentGuardianIncome');
Route::inertia('/profile-disability', 'BursaryApplication/Disability');
Route::inertia('/profile-nsfas', 'BursaryApplication/NSFAS');
//End Personal Information

//Start High School Information
Route::inertia('/profile-high-school', 'BursaryApplication/HighSchool');
Route::inertia('/profile-school-subjects', 'BursaryApplication/SchoolSubjects');
Route::inertia('/profile-high-school-graduation', 'BursaryApplication/HighSchoolGraduation');
//End High School Information

//Start Target-Institutions
Route::inertia('/profile-target-institutions', 'BursaryApplication/TargetInstitutions');
Route::inertia('/profile-target-career-path', 'BursaryApplication/TargetCareerPath');
//End Target-Institutions

//Start Background Information
Route::inertia('/profile-background', 'BursaryApplication/BackgroundInformation');
Route::inertia('/profile-talents', 'BursaryApplication/TalentsInformation');
Route::inertia('/profile-picture', 'BursaryApplication/ProfilePicture');
Route::inertia('/profile-creation-complete', 'BursaryApplication/ProfileCreationComplete');
//End Background Information

Route::post('/validate-current-level', [ApplicationsController::class, 'validateCurrentLevel'])->name('validateCurrentLevel');
Route::post('/validate-funding-level', [ApplicationsController::class, 'validateFundingLevel'])->name('validateFundingLevel');
Route::post('/validate-identity-document', [ApplicationsController::class, 'validateIdentityDocument'])->name('validateIdentityDocument');
Route::post('/validate-residence', [ApplicationsController::class, 'validateResidenceCitizenship'])->name('validateResidenceCitizenship');
Route::post('/validate-birth-day', [ApplicationsController::class, 'validateBirthDay'])->name('validateBirthDay');
Route::post('/validate-demography', [ApplicationsController::class, 'validateDemographics'])->name('validateDemographics');
Route::post('/validate-address', [ApplicationsController::class, 'validateAddress'])->name('validateAddress');
Route::post('/validate-parent-guardian', [ApplicationsController::class, 'validateParentGuardian'])->name('validateParentGuardian');
Route::post('/validate-other-parent-guardian', [ApplicationsController::class, 'validateOtherParentGuardian'])->name('validateOtherParentGuardian');
Route::post('/validate-spouse-guardian', [ApplicationsController::class, 'validateSpouseInformation'])->name('validateSpouseInformation');
Route::post('/validate-household-income', [ApplicationsController::class, 'validateHouseholdIncome'])->name('validateHouseholdIncome');
Route::post('/validate-single-income', [ApplicationsController::class, 'validateSingleIncome'])->name('validateSingleIncome');
Route::post('/validate-parent-guardian-income', [ApplicationsController::class, 'validateParentGuardianIncome'])->name('validateParentGuardianIncome');
Route::post('/validate-disability', [ApplicationsController::class, 'validateDisability'])->name('validateDisability');
Route::post('/validate-nsfas', [ApplicationsController::class, 'validateNSFAS'])->name('validateNSFAS');
Route::post('/validate-high-school', [ApplicationsController::class, 'validateHighSchool'])->name('validateHighSchool');
Route::post('/validate-school-subjects', [ApplicationsController::class, 'validateSchoolSubjects'])->name('validateSchoolSubjects');
Route::post('/validate-high-school-graduation', [ApplicationsController::class, 'validateHighSchoolGraduation'])->name('validateHighSchoolGraduation');
Route::post('/validate-target-institutions', [ApplicationsController::class, 'validateTargetInstitution'])->name('validateTargetInstitution');
Route::post('/validate-target-career-path', [ApplicationsController::class, 'validateTargetCareerPath'])->name('validateTargetCareerPath');
Route::post('/validate-background-information', [ApplicationsController::class, 'validateBackgroundInformation'])->name('validateBackgroundInformation');
Route::post('/validate-talents-information', [ApplicationsController::class, 'validateTalentsInformation'])->name('validateTalentsInformation');
Route::post('/validate-profile-picture', [ApplicationsController::class, 'validateProfilePicture'])->name('validateProfilePicture');

Route::middleware([
                      'add.testing.docs',
                  ])->group(function () {
    Route::post('/save-complete-application', [ApplicationsController::class, 'saveAndCompleteApplication'])->name('saveAndCompleteApplication');
});

//TODO to remove this after all testing
Route::get('/token', function () {
    return csrf_token();
});

//Route::post('/validate-verification-documents', [ApplicationsController::class, 'validateVerificationDocuments'])->name('validateVerificationDocuments');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
