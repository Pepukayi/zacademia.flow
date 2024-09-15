<template xmlns="http://www.w3.org/1999/html">
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[950px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">What is your latest high school results?</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">
                <!--Subjects Display -->
                <div class="col-span-full w-full" v-if="appData.school_information.subject_count > 0">
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="  px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        <li v-for="(subject, subjectIdx) in appData.school_information.subjects" class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6 space-x-64">
                                            <div class="w-0 flex-1 items-center">
                                                <div class="ml-4 min-w-0 flex-3 gap-2 justify-between">
                                                    <span class="truncate font-medium mr-3" v-text="subject.name"></span>
                                                    <span class="font-semibold text-gray-800" v-text="subject.mark"></span>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex flex-shrink-0 space-x-4">
                                                <span class="text-gray-200" aria-hidden="true">|</span>
                                                <SecondaryButton @click="removeSubject(subjectIdx)">Remove</SecondaryButton>
                                            </div>
                                        </li>
                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="block mt-3 col-span-full">
                    <DialogModal :show="showModal" @close="showModal = false" :maxWidth="'md'">
                        <template #content>
                            <div v-if="appData.school_information.curriculum === 'NSC'" class="mt-1">
                                <InputLabel value="Subject" />
                                <SelectDropdown
                                    :options="nsc_subjects"
                                    :name="'subject_name'"
                                    required
                                    @update:modelValue="(value) => form.subject_name = value"/>
                                <InputError class="mt-2" :message="form.errors.subject_name"/>
                            </div>
                            <div v-if="appData.school_information.curriculum !== 'NSC'" class="mt-1">
                                <InputLabel value="Subject" />
                                <TextInput
                                    v-model="form.subject_name"
                                    id="subject_name"
                                    name="subject_name"
                                    type="text"
                                    required
                                    autocomplete="on"
                                    placeholder="subject name"
                                    class="w-3/4 block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                                />
                                <InputError class="mt-2" :message="form.errors.subject_name"/>
                            </div>

                            <div class="mt-3">
                                <InputLabel value="Mark Achieved" />
                                <TextInput
                                    v-model="form.subject_mark"
                                    id="subject_mark"
                                    name="subject_mark"
                                    type="number"
                                    required
                                    autocomplete="on"
                                    placeholder="subject mark"
                                    class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                                />
                                <InputError class="mt-2" :message="form.errors.subject_mark"/>
                            </div>

                        </template>
                        <template #footer>
                            <SecondaryButton @click="showModal = false">
                                Cancel
                            </SecondaryButton>

                            <PrimaryButton
                                class="ml-3 text-sm font-semibold"
                                @click="addSubject(form.subject_name, form.subject_mark)"
                            >
                                Add Subject
                            </PrimaryButton>
                        </template>
                    </DialogModal>
                </div>

                <div v-if="appData.school_information.subject_count < 10" class="mt-6 flex justify-center items-center">
                    <div class="col-span-full">
                        <button
                            type="button"
                            v-text="appData.school_information.subject_count < 1 ? 'Add Subject' : 'Add Another Subject'"
                            @click="showModal = true"
                            class="text-center w-50 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">
                        </button>
                        <InputError class="mt-2" :message="form.errors.subjects"/>
                    </div>
                </div>

                <div class="m-6 w-96">
                    <DocumentUpload :label="'Attach latest results'"
                                    :name="'latest_results'"
                                    @saveFile="(file) => appData.school_information.latest_results  = file"/>
                    <InputError class="mt-2" :message="form.errors.latest_results"/>
                </div>
            </div>

            <div class="m-6 flex justify-center space-x-16">
                <NavLink href="#" @click="back"
                         class="text-center w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">
                    Back
                </NavLink>
                <button type="submit"
                        class="w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Continue
                </button>
            </div>
        </form>
    </ApplicationAppLayout>
</template>

<script setup>
import {ref} from 'vue'
import {Link, usePage, useForm} from '@inertiajs/vue3'
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import AddDisability from "@/Components/AddDisability.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import DialogModal from "@/Components/DialogModal.vue";
import CustomModal from "@/Components/CustomModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let appData = useDataStore();

const form = useForm({
    subject_name:'',
    subject_mark:'',
});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getSchoolInformation,
    })).post(route('validateSchoolSubjects'), {});
};

let back = function()
{
    window.history.back();
}

let curriculumSubjects = function () {
    return appData.school_information.curriculum === 'NSC' ? nsc_subjects :
        appData.school_information.curriculum === 'Cambridge' ? cambridge_subjects :
            appData.school_information.curriculum === 'Zimsec' ? zimsec_subjects : nsc_subjects;
}

let addSubject  = function (name, mark)
{
    appData.school_information.subjects.push({'name' : name, 'mark' : mark})
    appData.school_information.subject_count++
    form.subject_name = ''
    form.subject_mark = ''
    showModal.value = false
}

let removeSubject  = function (subjectIdx)
{
    console.log('subjectIdx : ' + subjectIdx)
    appData.school_information.subjects.splice(subjectIdx, 1)
    appData.school_information.subject_count--
}

//
// let closeSubject  = function ()
// {
//     appData.school_information.subject_count--
//     showModal = false
// }

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'complete'},
    {id: '02', name: 'School and Results', href: '#', status: 'current'},
    {id: '03', name: 'Target Studies', href: '#', status: 'upcoming'},
    {id: '04', name: 'Agreements', href: '#', status: 'upcoming'},
]

const progressPercent = 'width: 20.9%';

const nsc_subjects = [
    {name: 'Afrikaans'},
    {name: 'English'},
    {name: 'Ndebele'},
    {name: 'Northern Sotho'},
    {name: 'Southern Sotho'},
    {name: 'Swazi'},
    {name: 'Tsonga'},
    {name: 'Tswana'},
    {name: 'Venda'},
    {name: 'Xhosa'},
    {name: 'Zulu'},
    {name: 'Mathematics'},
    {name: 'Mathematical Literacy'},
    {name: 'Technical Mathematics'},
    {name: 'Life Orientation'},
    {name: 'Accounting'},
    {name: 'Agricultural Management Practices'},
    {name: 'Agricultural Sciences'},
    {name: 'Agricultural Technology'},
    {name: 'Business Studies'},
    {name: 'Civil Technology'},
    {name: 'Computer Applications Technology'},
    {name: 'Consumer Studies'},
    {name: 'Dance Studies'},
    {name: 'Design'},
    {name: 'Dramatic Arts'},
    {name: 'Economics'},
    {name: 'Electrical Technology'},
    {name: 'Engineering Graphics & Design'},
    {name: 'Geography'},
    {name: 'History'},
    {name: 'Hospitality Studies'},
    {name: 'Information Technology '},
    {name: 'Life Sciences'},
    {name: 'Mechanical Technology'},
    {name: 'Music'},
    {name: 'Physical Science'},
    {name: 'Religion Studies'},
    {name: 'Second Additional Language'},
    {name: 'Third Additional Language'},
    {name: 'Tourism'},
    {name: 'Visual Arts'},
]

const cambridge_subjects = [
    {name: 'Afrikaans'},
    {name: 'English'},
    {name: 'Ndebele'},
    {name: 'Northern Sotho'},
    {name: 'Southern Sotho'},
    {name: 'Swazi'},
    {name: 'Tsonga'},
    {name: 'Tswana'},
    {name: 'Venda'},
    {name: 'Xhosa'},
    {name: 'Zulu'},
    {name: 'Mathematics'},
    {name: 'Mathematical Literacy'},
    {name: 'Technical Mathematics'},
    {name: 'Life Orientation'},
    {name: 'Accounting'},
    {name: 'Agricultural Management Practices'},
    {name: 'Agricultural Sciences'},
    {name: 'Agricultural Technology'},
    {name: 'Business Studies'},
    {name: 'Civil Technology'},
    {name: 'Computer Applications Technology'},
    {name: 'Consumer Studies'},
    {name: 'Dance Studies'},
    {name: 'Design'},
    {name: 'Dramatic Arts'},
    {name: 'Economics'},
    {name: 'Electrical Technology'},
    {name: 'Engineering Graphics & Design'},
    {name: 'Geography'},
    {name: 'History'},
    {name: 'Hospitality Studies'},
    {name: 'Information Technology '},
    {name: 'Life Sciences'},
    {name: 'Mechanical Technology'},
    {name: 'Music'},
    {name: 'Physical Science'},
    {name: 'Religion Studies'},
    {name: 'Second Additional Language'},
    {name: 'Third Additional Language'},
    {name: 'Tourism'},
    {name: 'Visual Arts'},
]

const zimsec_subjects = [
    {name: 'Afrikaans'},
    {name: 'English'},
    {name: 'Ndebele'},
    {name: 'Northern Sotho'},
    {name: 'Southern Sotho'},
    {name: 'Swazi'},
    {name: 'Tsonga'},
    {name: 'Tswana'},
    {name: 'Venda'},
    {name: 'Xhosa'},
    {name: 'Zulu'},
    {name: 'Mathematics'},
    {name: 'Mathematical Literacy'},
    {name: 'Technical Mathematics'},
    {name: 'Life Orientation'},
    {name: 'Accounting'},
    {name: 'Agricultural Management Practices'},
    {name: 'Agricultural Sciences'},
    {name: 'Agricultural Technology'},
    {name: 'Business Studies'},
    {name: 'Civil Technology'},
    {name: 'Computer Applications Technology'},
    {name: 'Consumer Studies'},
    {name: 'Dance Studies'},
    {name: 'Design'},
    {name: 'Dramatic Arts'},
    {name: 'Economics'},
    {name: 'Electrical Technology'},
    {name: 'Engineering Graphics & Design'},
    {name: 'Geography'},
    {name: 'History'},
    {name: 'Hospitality Studies'},
    {name: 'Information Technology '},
    {name: 'Life Sciences'},
    {name: 'Mechanical Technology'},
    {name: 'Music'},
    {name: 'Physical Science'},
    {name: 'Religion Studies'},
    {name: 'Second Additional Language'},
    {name: 'Third Additional Language'},
    {name: 'Tourism'},
    {name: 'Visual Arts'},
]

const showModal = ref(null)
</script>
