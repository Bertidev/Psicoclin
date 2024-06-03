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
    consulta: Object,
    notas: Array,
});

const form = useForm({
    name: props.paciente.name,
    email: props.paciente.email,
    cep: props.paciente.cep,
    notas: '',
    editingNote: null,
    editNoteContent: '',
});

function voltar() {
    router.get(route('psicologo.dashboard'));
}

const note = () => {
    form.post(route('note.add', props.consulta.id), {
        onSuccess: () => {
            form.reset('notas');
        }
    });
};

const deleteNote = (id) => {
    router.delete(route('note.delete', id));
};

const startEditing = (note) => {
    form.editingNote = note.id;
    form.editNoteContent = note.nota;
};

const cancelEditing = () => {
    form.editingNote = null;
    form.editNoteContent = '';
};

const saveNote = (id) => {
    router.put(route('note.update', id), { nota: form.editNoteContent }, {
        onSuccess: () => {
            form.editingNote = null;
            form.editNoteContent = '';
        }
    });
};
</script>

<template>
    <Head title="Ler Informações" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalhes sobre sua consulta</h2>
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
                            Consulte informações a respeito do paciente
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
                                autofocus
                                readonly
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
                                readonly
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
                                readonly
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
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Notas sobre a consulta</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Adicione comentários, notas, ou informações adicionais a respeito de seu atendimento
                        </p>
                    </header>

                    <div v-if="props.notas.length" class="space-y-4">
                        <p class="mt-1 text-sm text-gray-600">Notas sobre este atendimento</p>
                        <div v-for="nota in props.notas" :key="nota.id" class="border p-4 rounded-md">
                            <div v-if="form.editingNote === nota.id">
                                <textarea v-model="form.editNoteContent" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" rows="5"></textarea>
                                <div class="flex items-center gap-4 mt-2">
                                    <button @click="saveNote(nota.id)" :disabled="form.processing" class="text-sm text-[#6F7C5E]">Salvar</button>
                                    <button @click="cancelEditing" type="button" class="text-sm text-red-600">Cancelar</button>
                                </div>
                            </div>
                            <div v-else>
                                <textarea v-model="nota.nota" readonly class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" rows="5"></textarea>
                                <div class="flex items-center gap-4 mt-2">
                                    <button @click="startEditing(nota)" class="text-sm text-gray-600">Editar</button>
                                    <button @click="deleteNote(nota.id)" class="text-sm text-red-600">Apagar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="note" class="mt-6">
                        <p class="mt-1 text-sm text-gray-600">
                            Adicionar nota
                        </p>
                        <div class="mb-3">
                            <textarea v-model="form.notas" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="mensagem" rows="5" required></textarea>
                        </div>
                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
