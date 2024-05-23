<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import OtherButton from '@/Components/OtherButton.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

defineProps({
    consultas: Array
})

function agendar() {
    router.get(route('consulta.agendar'))
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const day = date.getUTCDate().toString().padStart(2, '0');
    const month = (date.getUTCMonth() + 1).toString().padStart(2, '0'); // Months are zero-indexed
    const year = date.getUTCFullYear();
    return `${day}/${month}/${year}`;
}

function voltar(){
    router.get(route('dashboard'));
};

</script>

<template>
    <Head title="Home paciente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do paciente</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h1 class="text-lg font-medium text-gray-900">Consultas</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultar seu histórico de consultas
                        </p>
                    </header>
                    <div class="flex items-left px-5 py-4 gap-4">
                    <PrimaryButton @click="agendar">Agendar</PrimaryButton>
                    <OtherButton @click="voltar()">Voltar</OtherButton>
                    </div>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-200">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Profissional</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Data</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Horário</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="consulta in consultas" :key="consulta.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{ consulta.psicologo.name }}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ formatDate(consulta.data) }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ consulta.hora }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
