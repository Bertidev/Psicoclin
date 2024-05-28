<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

function agendar() {
    router.get(route('consulta.agendar'));
}
function proximas(){
    router.get(route('paciente.dashboard'));
}

function historico(){
    router.get(route('paciente.historico'))
}
</script>

<template>
    <Head title="Home paciente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do paciente</h2>
        </template>
        <div class="py-6">
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
                    <header>
                        <h1 class="text-lg font-medium text-gray-900">Agendar nova consulta</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Agende consultas com um profissional da nossa clínica de sua escolha.
                        </p>
                        <div class="flex items-left pt-4">
                        <PrimaryButton @click="agendar">Agendar</PrimaryButton>
                        </div>
                    </header>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                    <header>
                        <h1 class="text-lg font-medium text-gray-900">Consultas agendadas</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Consulte informações sobre suas próximas consultas.
                        </p>
                        <div class="flex items-left pt-4">
                        <PrimaryButton @click="proximas">Detalhes</PrimaryButton>
                        </div>
                    </header>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                    <header>
                        <h1 class="text-lg font-medium text-gray-900">Histórico de consultas</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Acesse seu histórico de consultas
                        </p>
                        <div class="flex items-left pt-4">
                        <PrimaryButton @click="historico">Acessar</PrimaryButton>
                        </div>
                    </header>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
