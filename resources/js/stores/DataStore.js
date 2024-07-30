
import { defineStore } from 'pinia'

export let useDataStore = defineStore('applicationData', {
    // data
    state() {
        return {
            sign_up: true,
            registration_information:{
                first_name: '',
                last_name: '',
                email: '',
                phone_number: '',
                password: '',
                password_confirmation: '',
                login_remember: '',
                terms_conditions: '',
            },
            personal_information: {
                id_number: '',
                current_level: '',
                funding_level: '',
                date_of_birth: '',
                country_residence: '',
                country_citizenship: '',
                id_type: '',
                gender: '',
                ethnicity: '',
                parent_guardian_email: '',
                parent_guardian_phone_number: '',
                marital_status: '',
                parental_dependence: '',
                spouse_name: '',
                spouse_surname: '',
                spouse_email: '',
                spouse_contact: '',
                spouse_id: '',
                employment_details: '',
                annual_income: '',
                proof_of_income: '',
                spouse_annual_income: '',
                spouse_proof_of_income: '',
                affadavit_both_not_working: '',
                working_parents_guardians: '',
                affadavit_parents_dont_work: '',
                affadavit_orphan: '',
                parent_annual_income: '',
                parent_proof_of_income: '',
                other_parent_annual_income: '',
                other_parent_proof_of_income: '',
                disability: '',
                disabilities: [],
                disability_count: '',
                nsfas_history: '',
                nsfas_student: '',
                nsfas_registration_number: '',
                id_copy: '',
                back_id_copy: '',
                proof_of_address: '',
                street_address: '',
                suburb: '',
                city: '',
                state_province: '',
                country: '',
                zip_postal_code: '',
            },
            school_information: {
                high_school: '',
                high_school_level: '',
                curriculum: '',
                subject_count: '',
                subjects: [],
                latest_results: '',
                high_school_graduate: '',
                high_school_graduation_year: '',
            },
            target_studies: {
                institution_type: '',
                other_institution_type: '',
                preferred_institution: '',
                preferred_career_path: '',
                preferred_study_programme: '',
            },
            background_information: {
                background_circumstances: '',
                achievements: '',
                leadership_roles: '',
                strength_weaknesses: '',
                talent_study_relation: '',
                personal_statement: '',
                profile_picture: '',
            },
        }
    },

    // //methods
    actions: {
        updatePersonalInformation(personal_information) {
            this.personal_information = personal_information;
        },
        updateResidentialInformation(registration_information) {
            this.registration_information = registration_information;
        },
        updateVerificationDocuments(verification_documents) {
            this.verification_documents = verification_documents;
        },
        updateAffadavit_both_not_working(affadavit_both_not_working) {
            this.affadavit_both_not_working = affadavit_both_not_working;
        },
        clearApplicationStore() {
            this.personal_information = {};
            this.school_information = {};
            this.target_studies = {};
            this.background_information = {};
        },
    },
    //
    // //computed
    getters: {
        // getFirstName() {
        //     return this.first_name
        // },
        // getLastName() {
        //     return this.service
        // },
        // getIDNumber() {
        //     return this.dateRange
        // },
        // getDateOfBirth() {
        //     return this.personal_information
        // },
        getPersonalInformation() {
            return this.personal_information
        },
        getSchoolInformation() {
            return this.school_information
        },
        getTargetInstitutionInformation() {
            return this.target_studies
        },
        getBackgroundInformation() {
            return this.background_information
        },
    }
});
