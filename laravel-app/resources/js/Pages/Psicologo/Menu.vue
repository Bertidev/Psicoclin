<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    consultas: Array,
    consultas_hoje: Array,
    pacientes: Array,
});

const consultasData = ref(props.consultas);
const consultasHojeData = ref(props.consultas_hoje);
const pacientesData = ref(props.pacientes);

const form = ref({
    pacienteId: '',
    texto: ''
});

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

function editar(id) {
    router.get(route('edit.pacient', id));
}

function fetchConsultas() {
    axios.get(route('psicologo.dashboard'))
        .then(response => {
            consultasData.value = response.data.consultas;
            consultasHojeData.value = response.data.consultas_hoje.map(consulta => {
                consulta.notificado = consulta.notificado;
                return consulta;
            });
            pacientesData.value = response.data.pacientes;
        })
        .catch(error => {
            console.error('Error fetching consultas:', error);
        });
}

onMounted(() => {
    fetchConsultas();
    const interval = setInterval(fetchConsultas, 5000);
    onUnmounted(() => {
        clearInterval(interval);
    });
});

function gerarEncaminhamento() {
    axios.post(route('psicologo.gerarEncaminhamento',form.value.pacienteId), form.value)
    .then(response => {
        alert('Encaminhamento gerado com sucesso!');
        window.open(response.data.url, '_blank');
        form.value.pacienteId = null
        form.value.texto = ''
    })
    .catch(error =>{
        console.log(error)
    })
}

 function gerarAtestado() {
    axios.post(route('psicologo.gerarAtestado', form.value.pacienteId), form.value)
        .then(response => {
            alert('Atestado gerado com sucesso!');
            window.open(response.data.url, '_blank');
            form.value.pacienteId = null
            form.value.texto = ''
        })
        .catch(error => {
            console.error(error);
        });
}

</script>

<template>
    <Head title="Home psicologo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Área do psicólogo</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p v-if="$page.props.flash.confirmation" class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded">
                        <a :href="$page.props.flash.downloadLink" class="underline">{{ $page.props.flash.confirmation }}</a>
                    </p>
                </Transition>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Próximas Consultas</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultar informações sobre suas próximas consultas
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
                                    <div class="font-semibold text-left">Status</div>
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
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium">
                                        <span v-if="consulta_hoje.notificado" class="text-red-600">Paciente chegou</span>
                                        <span v-else>--</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Pacientes</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Lista de pacientes com consultas agendadas.
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
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Opções</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="paciente in pacientesData" :key="paciente.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium">{{ paciente.name }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ paciente.email }}</div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-4">
                                        <PrimaryButton @click="editar(paciente.id)">Detalhes</PrimaryButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Documentos</h2>
                        <p class="mt-1 text-sm text-gray-600">Gere encaminhamentos ou atestados para seus pacientes.</p>
                    </header>
                    <div class="py-4">
                        <div>
                            <InputLabel for="paciente.id" value="Nome do paciente" />
                            <select
                                id="paciente.id"
                                v-model="form.pacienteId"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            >
                                <option v-for="paciente in pacientesData" :key="paciente.id" :value="paciente.id">
                                    {{ paciente.name }}
                                </option>
                            </select>

                            <div class="mt-4">
                                <InputLabel for="documento-texto" value="Texto do documento" />
                                <textarea
                                    id="documento-texto"
                                    v-model="form.texto"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="4"
                                ></textarea>
                            </div>

                            <div class="flex items-center gap-4 mt-4">
                                <PrimaryButton @click="gerarEncaminhamento">Encaminhamento</PrimaryButton>
                                <PrimaryButton @click="gerarAtestado">Atestado</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
