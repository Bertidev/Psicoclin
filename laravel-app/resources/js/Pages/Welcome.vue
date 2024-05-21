<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import { ref } from 'vue';

const activePage = ref(0);

const pages = [
    {
        link: { text: 'Quem Somos', url: 'index.html' },
        pageTitle: 'A Psicoclin',
        content: ''
    },
    {
        link: { text: 'Relatos', url: 'about.html' },
        pageTitle: 'Relatos',
        content: 'This is the about content'
    },
    {
        link: { text: 'Contatos', url: 'contact.html' },
        pageTitle: 'Contact Page',
        content: 'This is the contact content'
    }
];

const relatos = [
    {
        nome: 'Maria',
        idade: '21 anos',
        conteudo: 'A Psicoclin superou todas as minhas expectativas! Desde o atendimento na recepção até as sessões com os psicólogos, tudo foi impecável. As instalações são modernas e confortáveis, e os profissionais são extremamente atenciosos e competentes. Recomendo a todos!'
    },
    {
        nome: 'Jonas',
        idade: '35 anos',
        conteudo: 'Fiquei muito impressionado com a eficiência e a qualidade do atendimento na Psicoclin. Os psicólogos são altamente especializados e demonstram um verdadeiro compromisso com o bem-estar dos pacientes. Além disso, o tempo de espera foi mínimo, o que é um grande diferencial.'
    },
    {
        nome: 'Tobias',
        idade: '58 anos',
        conteudo: 'A melhor clínica de psicologia em que já estive! Os profissionais são muito dedicados e atenciosos, e o ambiente é limpo e organizado. Fui muito bem tratado desde a chegada até o momento de ir embora. Agradeço a toda a equipe pelo excelente serviço prestado.'
    },
    {
        nome: 'Alberto',
        idade: '73 anos',
        conteudo: 'Tive uma experiência maravilhosa na Psicoclin. O ambiente é muito acolhedor e a equipe é extremamente qualificada. Fui muito bem atendido e me senti em boas mãos durante todo o processo terapêutico. Com certeza voltarei se precisar de mais apoio psicológico.'
    },
];

const contatos = [
    {
        Email: ' Email: Contato@psicoclin.com.br',
        Telefone: 'Telefone: (21)3030-2838 / Whatsapp: (21)97113-5102',
        Horario: 'Horario de funcionamento: 8:00 as 20:00'
    }
];

const info = [
    {
        titulo: 'A Psicoclin',
        conteudo: 'A Psicoclin é uma clínica de psicologia localizada na Barra da Tijuca, no Rio de Janeiro. Fundada em 2016, a clínica tem mais de 7 anos de experiência no mercado e é referência na área. Ela está situada no Cittá América, um centro comercial e empresarial.'
    },
    {
        titulo: 'A Equipe',
        conteudo: 'A clínica conta com uma equipe de 4 psicólogos especializados em diversas áreas da psicologia. Esses profissionais estão preparados para atender pacientes de todas as idades e necessidades.'
    },
    {
        titulo: 'Compromisso',
        conteudo: 'Os valores da Psicoclin incluem ética, compromisso, respeito e qualidade nos serviços. A equipe se esforça para garantir excelência no atendimento e empatia com os pacientes.'
    }
];

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">
        <title></title>
        <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    </head>
    <body>
        <div>
            <div class="d-flex justify-content-center" style="background-color: #728360; padding: 1rem 0;">
                <img src="images/marca.png" alt="Psicoclin" style="width: 25%;">
            </div>
<<<<<<< HEAD
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        Psicoclin
                    </a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li v-for="(page, index) in pages" class="nav-item" :key="index">
                            <a 
                                class="nav-link" 
                                aria-current="page" 
                                :href="page.link.url"
                                :title="`this link goes to the ${page.link.text} page`"
                                @click.prevent="activePage = index"
                            >{{page.link.text}}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-3">
                        <li class="nav-item">
                            <a href="/login">
                                <button class="inline-flex items-center px-4 py-2 bg-[#6F7C5E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#9EA68F] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Login
                                </button>
                            </a>
                        </li>
                    </ul>
=======
        </nav>   
        <div id="content" class="container-fluid" style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef); ">
            <div class="row" v-if="activePage === 0">
               
                <div class="col-md-4 offset-md-4 text-center">
                    <h2>{{ info[0].titulo }}</h2>
                    <p>{{ info[0].conteudo }}</p>
>>>>>>> main
                </div>
            </nav>   
            <div id="content" class="container-fluid" style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef); ">
                <div class="row" v-if="activePage === 0">
                    <div class="col-md-4 offset-md-4 text-center">
                        <h2>{{ info[0].titulo }}</h2>
                        <p>{{ info[0].conteudo }}</p>
                    </div>
                    <div class="col-md-12 text-center" v-if="activePage === 0">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <h2>{{ info[1].titulo }}</h2>
                                <p>{{ info[1].conteudo }}</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{ info[2].titulo }}</h2>
                                <p>{{ info[2].conteudo }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="activePage === 1">
                    <div class="col-md-3 text-center">
                        <h2>{{ relatos[0].nome }}
                        </h2>
                        <p>
                            {{ relatos[0].idade }}
                        </p>
                        <p>
                            {{ relatos[0].conteudo }}
                        </p>
                    </div>
                    <div class="col-md-3 text-center">
                        <h2>{{ relatos[1].nome }}
                        </h2>
                        <p>
                            {{ relatos[1].idade }}
                        </p>
                        <p>
                            {{ relatos[1].conteudo }}
                        </p>
                       
                    </div>
                    <div class="col-md-3 text-center">
                        <h2>{{ relatos[2].nome }}
                        </h2>
                        <p>
                            {{ relatos[2].idade }}
                        </p>
                        <p>
                            {{ relatos[2].conteudo }}
                        </p>
                    </div>
                    <div class="col-md-3 text-center">
                        <h2>{{ relatos[3].nome }}
                        </h2>
                        <p>
                            {{ relatos[3].idade }}
                        </p>
                        <p>
                            {{ relatos[3].conteudo }}
                        </p>
                    </div>
                </div>
                <div class="row" v-if="activePage === 2">
                    <div class="col-md-4">
                        <h2>Nossos Contatos</h2>
                        <p>
                            {{ contatos[0].Email }}
                        </p>
                        <p>
                            {{ contatos[0].Telefone }}
                        </p>
                        <p>
                            {{ contatos[0].Horario }}
                        </p>
                       
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-light text-center text-lg-start" style="padding: 2rem 0; color: #6c757d;">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Onde Estamos</h5>
                        <p>
                            A Psicoclin está localizada no Cittá Office Mall, na Av. das Américas, 700, Bloco 3, Sala 118, na Barra da Tijuca, Rio de Janeiro, RJ. O CEP é 22640-100.
                        </p>
                        <p>
                            Referências de localização:
                            Ao lado do Shopping Downtown.
                            Perto do supermercado ASSAÍ.
                            Em frente à estação BRT Bosque Marapendi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #6c757d;">
                &copy; {{ new Date().getFullYear() }} Psicoclin. All rights reserved.
            </div>
        </footer>
    </body>
</template>
