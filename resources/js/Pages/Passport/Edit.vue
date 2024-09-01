<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import { Head } from '@inertiajs/vue3';
import { onMounted, ref} from 'vue';
import axios from 'axios';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage, router  } from "@inertiajs/vue3";

const props = defineProps({
    id: Number,
});

const form = useForm({
    // name: '',
    // redirect: '',
    
});

const name = ref('')
const redirect = ref('')


const submit = () => {

    // // J'ai utilisé la méthode post parcequ'avec les images, la méthode put ou patch ne fonctionne pas
    // form.post(route("passport.clients.index"), {

    //     // onFinish: () => {
    //     //     // On passe l'affichage du loader à false quand tout est fini
    //     //     show.value = false
    //     // },

    //     onSuccess: () => {
    //         // Permet l'actualisation des données dans le composant parent
    //         router.visit('clients')
    //     }

    // });

    const data = {
        name: name.value,
        redirect: redirect.value,
    };
    
    axios.post('/oauth/clients', data)
        .then(response => {
            console.log(response.data);
            router.visit('clients')
        })
        .catch (response => {
            // List errors on response...
    });
};



onMounted(()=> {

    console.log('eoeoeoeoeo', props.id)
    
    const data = {
        name: 'New Client Name',
        redirect: 'http://example.com/callback'
    };
    
    axios.put('/oauth/clients/' + clientId, data)
        .then(response => {
            console.log(response.data);
        })
        .catch (response => {
            // List errors on response...
        });
})






</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List des clients</h2>
        </template>

        <div class="py-12 row justify-content-md-center">
            <div class="col-8">
                <form @submit.prevent="submit" enctype="multipart/form-data">
    
                    <div>
                        <InputLabel
                            for="name"
                            value="name"
                        />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="name"
                            placeholder="Name"
                            autofocus
                            required
                            autocomplete="name"
                        />

                        <!-- <InputError class="mt-2" :message="errors.name" /> -->
                    </div>
                    <div>
                        <InputLabel
                            for="redirect"
                            value="redirect"
                        />

                        <TextInput
                            id="redirect"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="redirect"
                            placeholder="Redirect"
                            autofocus
                            required
                            autocomplete="redirect"
                        />

                        <!-- <InputError class="mt-2" :message="errors.redirect" /> -->
                    </div>


                    <div class="mt-6">
                        <PrimaryButton
                            class=""
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Envoyer
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
