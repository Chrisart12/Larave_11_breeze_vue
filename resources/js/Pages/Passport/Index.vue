<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import { Head, Link } from '@inertiajs/vue3';
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3";
import { onMounted, ref} from 'vue';
import axios from 'axios';

const clients = ref([])

onMounted(()=> {

    axios
        .get('/oauth/clients')
        .then((response) => {

            clients.value = response.data

        })
        .catch( (error) => {
            // On passe l'affichage du loader à false
            console.log(error.toJSON());
        });

})

const handleDelete = (clientId) => {
    axios.delete('/oauth/clients/' + clientId)
    .then(response => {
        router.visit('clients')
    });
}


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List des clients</h2>
        </template>
        <div class="py-12 row justify-content-md-center">
            
            <ul class="list-group col-6">
                <div class="list-group-item container-header-clients" aria-disabled="true">
                    <span>OAuth Clients</span>

                    <Link class="" :href="route('create')">
                        Create New Client
                    </Link>
                    
                </div>
                <table class="table">
                    <thead >
                        <tr>
                            <th scope="col">Client ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Secret</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client of clients" :key="client.id">
                            <td>{{ client.id }}</td>
                            <td>{{ client.name }}</td>
                            <td>{{ client.secret }}</td>
                            <td>
                                <!-- <Link class="" :href="route('passport.clients.update', client.id)">
                                    Edit
                                </Link> -->
                                <Link class="" :href="route('edit', client.id)">
                                    Edit
                                </Link>
                            </td>
                            <td>
                                <button class="btn btn-primary" type="button" @click="handleDelete(client.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
