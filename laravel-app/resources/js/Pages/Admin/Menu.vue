<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({psicologos:Object,secretarios:Object})
function excluir (id)
{
    router.delete(route('adm.delete',id))
}
function editar(id)
{
    router.get(route('adm.edit',id))
}
function criar()
{
    router.get(route('adm.create'))
}
</script>

<template>
    <Head title="Home admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do administrador</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Secretários</h2>
                        <primary-button @click="criar()"
                            >Cadastrar</primary-button> 
                    </header>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
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
                            <tr v-for="secretario in secretarios">
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                <div class="font-medium text-gray-800">{{secretario.name}}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{secretario.email}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{secretario.cep}}</div>
                            </td>
                            <td>
                                
                                <SecondaryButton @click="editar(secretario.id)"
                                            >Editar</SecondaryButton>
                                

                                <DangerButton @click="excluir(secretario.id)"
                                            >Excluir</DangerButton>
                                
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Psicólogos</h2>
                        <primary-button @click="criar()"
                            >Cadastrar</primary-button> 
                    </header>
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
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
                            <tr v-for="psicologo in psicologos">
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                <div class="font-medium text-gray-800">{{psicologo.name}}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{psicologo.email}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{psicologo.cep}}</div>
                            </td>
                            <td>
                                
                                <SecondaryButton @click="editar(psicologo.id)"
                                            >Editar</SecondaryButton>
                                

                                <DangerButton @click="excluir(psicologo.id)"
                                            >Excluir</DangerButton>
                                
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
