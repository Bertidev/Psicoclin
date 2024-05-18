<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({ user: Object });

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    cep: props.user.cep,
    password: props.user.password
});

function send(id) {
    router.put('/secretaria/' + id, form);
}
</script>

<template>
    <Head title="Editar Informacoes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Alterar Informações do Paciente</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="send(user.id)" class="mt-6 space-y-6">
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

                        <div v-if="mustVerifyEmail && user.email_verified_at === null">
                            <p class="text-sm mt-2 text-gray-800">
                                Your email address is unverified.
                                <Link
                                    :href="route('verification.send')"
                                    method="post"
                                    as="button"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Click here to re-send the verification email.
                                </Link>
                            </p>

                            <div
                                v-show="status === 'verification-link-sent'"
                                class="mt-2 font-medium text-sm text-green-600"
                            >
                                A new verification link has been sent to your email address.
                            </div>
                        </div>

                        <div>
                            <InputLabel for="password" value="Senha" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                autocomplete="new-password"
                            />
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
                            <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
