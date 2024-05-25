<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({pacientes:Object})

function excluir(id)
{
    router.delete(route('secretaria.delete',id))
}
function editar(id)
{
    router.get(route('secretaria.edit',id))
}
function criar()
{
    router.get(route('secretaria.create'))
}
</script>

<template>
    <Head title="Home secretaria" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do secretário</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                        <h2 class="font-semibold text-gray-800">Pacientes</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultar informações de pacientes cadastrados na clinica
                        </p>
                        <div class="flex items-left pt-3">
                        <primary-button @click="criar()"
                            >Cadastrar</primary-button> 
                        </div>
                    </header>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-200">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nome</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Cep</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="paciente in pacientes">
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                <div class="font-medium text-gray-800">{{paciente.name}}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{paciente.email}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{paciente.cep}}</div>
                            </td>
                            <td>
                            <div class="flex items-center gap-4">
                                <SecondaryButton @click="editar(paciente.id)"
                                            >Editar</SecondaryButton>
                                

                                <DangerButton @click="excluir(paciente.id)"
                                            >Excluir</DangerButton>
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