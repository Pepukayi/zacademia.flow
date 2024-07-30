<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

                    <h3 class="mt-10 ml-4 text-lg text-center font-medium ">Add your profile picture</h3>

        <form @submit.prevent="submit">
                        <div class="m-6 grid justify-center items-center">
<!--                            <h3 >Add your profile picture</h3>-->
<!--                                <button v-show="! photoPreview" class="mt-2">-->
<!--                                    <UserCircleIcon class="h-36 w-36 text-gray-300" aria-hidden="true" />-->
<!--                                    <input-->
<!--                                        ref="photoInput"-->
<!--                                        type="file"-->
<!--                                        class="hidden"-->
<!--                                        @change="updatePhotoPreview"-->
<!--                                    >-->
<!--                                </button>-->


                            <div class="grid justify-center items-center" v-show="! photoPreview">
                                    <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.first_name" class="rounded-full h-36 w-36 object-cover">
                                </div>
                                <input
                                    ref="photoInput"
                                    type="file"
                                    class="hidden"
                                    @change="updatePhotoPreview"
                                >

                                <!-- New Profile Photo Preview -->
                                <div class="grid justify-center items-center" v-show="photoPreview">
                                    <span
                                        class="block rounded-full w-36 h-36 bg-cover bg-no-repeat bg-center"
                                        :style="'background-image: url(\'' + photoPreview + '\');'"
                                    />
                                </div>

                            <div>
                                <SecondaryButton class="mt-2 mr-5" @click.prevent="selectNewPhoto">
                                    Select A New Photo
                                </SecondaryButton>

                                <SecondaryButton
                                    v-if="$page.props.auth.user.profile_photo_url"
                                    type="button"
                                    class="mt-2"
                                    @click.prevent="deletePhoto"
                                >
                                    Remove Photo
                                </SecondaryButton>

                                <InputError :message="form.errors.photo" class="mt-2" />
                            </div>
                            </div>

                        <div class="m-6 flex justify-center space-x-16">
                            <NavLink href="#" @click="back" class="text-center w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">Back</NavLink>
                            <button type="submit" class="w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Finish</button>
                        </div>
        </form>
    </ApplicationAppLayout>
</template>

<script setup>
import { ref } from 'vue'
import {Link, usePage, useForm, router} from '@inertiajs/vue3'
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

let appData = useDataStore();

const form = useForm({
});

let submit = () => {
    form.transform((data) => ({
        ...appData.getBackgroundInformation,
    })).post(route('validateProfilePicture'), {
        onSuccess: () => {
            form.reset()
            saveAndCompleteApplication()
        }
    });
};

let saveAndCompleteApplication  = () => {
    form.transform((data) => ({
        personal_information: appData.getPersonalInformation,
        school_information: appData.getSchoolInformation,
        target_studies: appData.getTargetInstitutionInformation,
        background_information: appData.getBackgroundInformation,
    })).post(route('saveAndCompleteApplication'), {
        onSuccess: () => appData.clearApplicationStore()
    });
};

let back = function()
{
    window.history.back();
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'complete'},
    {id: '02', name: 'School and Results', href: '#', status: 'complete'},
    { id: '03', name: 'Target Studies', href: '#', status: 'complete' },
    { id: '04', name: 'Agreements', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 10.9%';

const plans = [
    { name: 'High School Scholar' },
    { name: 'Undergraduate Student' },
    { name: 'Postgraduate Student' },
]

const formatter = ref({
    date: 'YYYY-MM-DD',
    month: 'MMM'
})

const mobileMenuOpen = ref(false)

const photoPreview = ref(null);
const photoInput = ref(null);
const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    appData.background_information.profile_picture = photo

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

</script>
