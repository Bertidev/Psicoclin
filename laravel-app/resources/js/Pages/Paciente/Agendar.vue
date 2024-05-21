<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

function agendar()
{
    router.get(route('consulta.agendar'))
}
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
                            Consultar informações sobre consultas futuras
                        </p>
                    </header>
                    <primary-button @click="agendar()"
                            >Agendar</primary-button>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-200">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nome</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Profissional</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Data</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Funções</div>
                                </th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
