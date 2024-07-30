<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[750px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Disability Information</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">

                <div class="block mt-5 col-span-full w-96">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Do you have a disability?</label>
                    <div class="mt-1">
                        <SelectDropdown
                            class="w-96"
                            :options="disability"
                            :name="'disability'"
                            @update:modelValue="(value) => appData.personal_information.disability = value"/>
                        <InputError class="mt-2" :message="form.errors.disability"/>
                    </div>
                </div>

                <!--Subjects Display -->
                <div class="col-span-full w-full" v-if="appData.personal_information.disability_count > 0">
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="  px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        <li v-for="(disability, disabilityIdx) in appData.personal_information.disabilities" class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6 space-x-64">
                                            <div class="w-0 flex-1 items-center">
                                                <div class="ml-4 min-w-0 flex-3 gap-2 justify-between">
                                                    <span class="font-semibold text-gray-800 mr-2" v-text="disabilityIdx + 1"></span>
                                                    <span class="truncate font-medium mr-3" v-text="disability.name"></span>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex flex-shrink-0 space-x-4">
                                                <span class="text-gray-200" aria-hidden="true">|</span>
                                                <SecondaryButton @click="removeDisability(disabilityIdx)">Remove</SecondaryButton>
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
                            <div class="mt-1">
                                <InputLabel value="Disability Name" />
                                <div class="mt-1">
                                    <TextInput
                                        v-model="form.disability_name"
                                        id="disability_name"
                                        name="disability_name"
                                        type="text"
                                        required=""
                                        autocomplete="disability_name"
                                        placeholder="disability name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                                    />
                                    <InputError class="mt-2" :message="form.errors.disability_name"/>
                                </div>
                            </div>

                            <div class="mt-3">
                                <DocumentUpload :label="'Attach proof of disability'"
                                                :name="'disability_proof'"
                                                @saveFile="(file) => form.disability_proof = file"/>
                                <InputError class="mt-2" :message="form.errors.disability_proof"/>
                            </div>

                        </template>
                        <template #footer>
                            <SecondaryButton @click="showModal = false">
                                Cancel
                            </SecondaryButton>

                            <PrimaryButton
                                class="ml-3 text-sm font-semibold"
                                @click="addDisability(form.disability_name, form.disability_proof)"
                            >
                                Add Disability
                            </PrimaryButton>
                        </template>
                    </DialogModal>
                </div>

<!--                <div v-if="appData.personal_information.disability === 'Yes' && appData.personal_information.disability_count < 3" class="mt-6 flex  space-x-16">-->
<!--                    <NavLink-->
<!--                        href="#" @click="appData.personal_information.disability_count++"-->

<!--                             class="text-center w-50 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">-->
<!--                        <div v-if="appData.personal_information.disability_count < 1">Add Disability</div>-->
<!--                        <div v-if="appData.personal_information.disability_count >= 1">Add Another Disability</div>-->
<!--                    </NavLink>-->
<!--                </div>-->

                <div v-if="appData.personal_information.disability === 'Yes' && appData.personal_information.disability_count < 3" class="mt-6 flex justify-center items-center">
                    <button
                        type="button"
                        v-text="appData.personal_information.disability_count < 1 ? 'Add Disability' : 'Add Another Disability'"
                        @click="showModal = true"
                        class="text-center w-50 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">
                    </button>
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

            <div class="mt-3 flex justify-center" role="list" v-for="error in form.errors">
                <div class="text-red-500 text-xs mt-1">{{error}}</div>
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
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

let appData = useDataStore();

const form = useForm({
    disability_name:'',
    disability_proof:'',
});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateDisability'), {});
};

let back = function()
{
    window.history.back();
}

let addDisability  = function (name, proof)
{
    appData.personal_information.disabilities.push({'name' : name, 'proof' : proof})
    appData.personal_information.disability_count++
    form.disability_name = ''
    form.disability_proof = ''
    showModal.value = false
}

let removeDisability  = function (disabilityIdx)
{
    console.log('disabilityIdx : ' + disabilityIdx)
    appData.personal_information.disabilities.splice(disabilityIdx, 1)
    appData.personal_information.disability_count--
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    {id: '03', name: 'Target Studies', href: '#', status: 'upcoming'},
    {id: '04', name: 'Agreements', href: '#', status: 'upcoming'},
]

const progressPercent = 'width: 20.9%';

const disability = [
    {name: 'Yes'},
    {name: 'No'},
]

const showModal = ref(null)
</script>
