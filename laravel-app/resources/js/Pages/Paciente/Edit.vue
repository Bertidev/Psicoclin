<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';


const props = defineProps({
    psicologos: Array,
    consulta: Object,
});

const generateTimeSlots = () => {
    const start = 8 * 60; // 8:00 in minutes
    const end = 17 * 60 + 45; // 18:30 in minutes
    const interval = 45; // 45 minutes

    let times = [];
    for (let minutes = start; minutes <= end; minutes += interval) {
        let hours = Math.floor(minutes / 60);
        let mins = minutes % 60;
        times.push(`${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}`);
    }
    return times;
};

const timeSlots = generateTimeSlots();

const form = useForm({
    psicologo_id: props.consulta.psicologo_id,
    date: props.consulta.data,
    time: props.consulta.hora,
});


const submit = () => {
    form.put(route('consulta.update', { id: props.consulta.id }));
};
</script>

<template>
    <Head title="Editar Consulta" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do paciente</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h1 class="text-lg font-medium text-gray-900">Profissionais disponíveis</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Profissionais da clínica disponíveis para agendamento
                        </p>
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
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="psicologo in psicologos" :key="psicologo.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{ psicologo.name }}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ psicologo.email }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h1 class="text-lg font-medium text-gray-900">Editar sua consulta</h1>
                </header>
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="psicologo_id" value="Nome do profissional desejado" />
                        <select id="psicologo_id" v-model="form.psicologo_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option v-for="psicologo in psicologos" :key="psicologo.id" :value="psicologo.id">
                                {{ psicologo.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.psicologo_id" />
                    </div>

                    <div>
                        <InputLabel for="date" value="Data da consulta" />

                        <TextInput
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date"
                            required
                            autocomplete="date"
                        />

                        <InputError class="mt-2" :message="form.errors.date" />
                    </div>

                    <div>
                        <InputLabel for="time" value="Horário da consulta" />

                        <select
                            id="time"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            v-model="form.time"
                            required
                            autocomplete="time"
                        >
                            <option v-for="time in timeSlots" :key="time" :value="time">
                                {{ time }}
                            </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.time" />
                    </div>

                    <PrimaryButton type="submit">Salvar Alterações</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
