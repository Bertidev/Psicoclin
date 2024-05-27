<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import OtherButton from '@/Components/OtherButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    paciente: Object,
    notas: Array,
});

const form = useForm({
    name: props.paciente.name,
    email: props.paciente.email,
    cep: props.paciente.cep,
});

function voltar() {
    router.get(route('psicologo.dashboard'));
}

function updatePaciente() {
    form.put(route('psicologo.update', props.paciente.id));
}
</script>

<template>
    <Head title="Ler Informações" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalhes sobre seu paciente</h2>
        </template>
        <div class="py-6">
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
                        <h2 class="font-semibold text-gray-800">Informações do paciente</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Consulte ou altere informações a respeito do paciente
                        </p>
                    </header>
                    <form @submit.prevent="updatePaciente" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Nome" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="cep" value="Cep" />
                            <TextInput
                                id="cep"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.cep"
                                onblur="pesquisacep(this.value)"
                                required
                                autocomplete="postal-code"
                            />
                        </div>

                        <div>
                            <InputLabel for="rua" value="Rua" />
                            <TextInput
                                id="rua"
                                type="text"
                                class="mt-1 block w-full"
                            />
                        </div>

                        <div>
                            <InputLabel for="bairro" value="Bairro" />
                            <TextInput
                                id="bairro"
                                type="text"
                                class="mt-1 block w-full"
                            />
                        </div>

                        <div>
                            <InputLabel for="cidade" value="Cidade" />
                            <TextInput
                                id="cidade"
                                type="text"
                                class="mt-1 block w-full"
                            />
                        </div>

                        <div>
                            <InputLabel for="uf" value="Estado" />
                            <TextInput
                                id="uf"
                                type="text"
                                class="mt-1 block w-full"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <OtherButton type="button" @click="voltar">Voltar</OtherButton>
                            <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- Seção de Notas do Paciente -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Notas do Paciente</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Lista de notas registradas a respeito do paciente
                        </p>
                    </header>
                    <div>
                        <ul>
                            <li v-for="nota in props.notas" :key="nota.id" class="mb-4">
                                <div class="text-gray-600 text-sm">{{ nota.nota }}</div>
                                <div class="text-gray-500 text-xs">{{ new Date(nota.created_at).toLocaleDateString() }}</div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
