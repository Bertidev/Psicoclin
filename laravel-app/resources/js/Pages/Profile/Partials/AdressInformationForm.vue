<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
const form = useForm({
    cep: user.cep,
});   
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Informação de Endereço</h2>

            <p class="mt-1 text-sm text-gray-600">
                Consultar endereço a partir do seu CEP.
            </p>
        </header>

        <form method="get" action="." class="mt-6 space-y-6">
            <div>
                <InputLabel for="cep" value="Cep"/>

                <TextInput
                    v-model="form.cep"
                    id="cep-pesquisa"
                    type="text"
                    class="mt-1 block w-full"
                    onblur="pesquisacep(this.value);"
                />
            </div>
            
            <div>
                <InputLabel for="rua" value="Rua"/>

                <TextInput
                    id="rua"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="bairro" value="Bairro"/>

                <TextInput
                    id="bairro"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="cidade" value="Cidade"/>

                <TextInput
                    id="cidade"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

             <div>
                <InputLabel for="uf" value="Estado"/>

                <TextInput
                    id="uf"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>
        </form>
    </section>
</template>