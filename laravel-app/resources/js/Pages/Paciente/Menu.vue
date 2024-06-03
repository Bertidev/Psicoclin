<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import OtherButton from '@/Components/OtherButton.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

defineProps({
    consultas: Array
})

function agendar() {
    router.get(route('consulta.agendar'))
}
function cancelar(id){
    router.delete(route('consulta.delete',id));
}
function remarcar(id){
    router.get(route('consulta.edit',id))
}
function formatDate(dateString) {
    const date = new Date(dateString);
    const day = date.getUTCDate().toString().padStart(2, '0');
    const month = (date.getUTCMonth() + 1).toString().padStart(2, '0');
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
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p v-if="$page.props.flash.confirmation" class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded">
                        {{ $page.props.flash.confirmation }}</p>
                </Transition>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h1 class="text-lg font-medium text-gray-900">Consultas</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultar informações sobre suas consultas
                        </p>
                        <p></p>
                    </header>
                    <div class="flex items-left px-5 py-4 gap-4">
                    <OtherButton @click="voltar()">Voltar</OtherButton>
                    <PrimaryButton @click="agendar">Agendar</PrimaryButton>
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
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Opções</div>
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
                                <div class="flex items-center gap-4">
                                <SecondaryButton @click="remarcar(consulta.id)"
                                            >Remarcar</SecondaryButton>
                                

                                <DangerButton @click="cancelar(consulta.id)"
                                            >Cancelar</DangerButton>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
