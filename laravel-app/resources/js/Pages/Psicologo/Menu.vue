<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    consultas: Array,
    consultas_hoje: Array
});

const consultasData = ref(props.consultas);
const consultasHojeData = ref(props.consultas_hoje);

function formatDate(dateString) {
    const date = new Date(dateString);
    const day = date.getUTCDate().toString().padStart(2, '0');
    const month = (date.getUTCMonth() + 1).toString().padStart(2, '0'); // Months are zero-indexed
    const year = date.getUTCFullYear();
    return `${day}/${month}/${year}`;
}

function ler(id) {
    router.get(route('psicologo.read', id));
}

function fetchConsultas() {
    axios.get(route('psicologo.dashboard'))
        .then(response => {
            consultasData.value = response.data.consultas;
            consultasHojeData.value = response.data.consultas_hoje;
        })
        .catch(error => {
            console.error('Error fetching consultas:', error);
        });
}

onMounted(() => {
    // Fetch data initially
    fetchConsultas();

    // Set up polling interval
    const interval = setInterval(fetchConsultas, 5000); // Poll every 5 seconds

    onUnmounted(() => {
        clearInterval(interval);
    });
});
</script>

<template>
    <Head title="Home psicologo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do psicólogo</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Próximas Consultas</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultar informações de sobre suas próximas consultas
                        </p>
                    </header>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-200">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Data</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Horário</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Paciente</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="consulta in consultasData" :key="consulta.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{ formatDate(consulta.data) }}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ consulta.hora }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium">{{ consulta.paciente.name }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Consultas Hoje</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Listagem de suas consultas que acontecerão na data de hoje.
                        </p>
                    </header>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-200">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Horário</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Paciente</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Opções</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="consulta_hoje in consultasHojeData" :key="consulta_hoje.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ consulta_hoje.hora }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium">{{ consulta_hoje.paciente.name }}</div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-4">
                                        <PrimaryButton @click="ler(consulta_hoje.id)">Detalhes</PrimaryButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
