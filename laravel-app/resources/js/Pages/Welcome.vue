<template>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">
        <title></title>
        <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    </head>
    <div>
        <div style="background-color: #f8f9fa; padding: 1rem 0;">
            <img src="images/marca.jpg" alt="Psicoclin" style="width: 25%;">
        </div>

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
            
                <div class="col-md-4 offset-md-4 text-center">
                    <h1>{{ info[1].titulo }}</h1>
                    <p>{{ info[1].conteudo }}</p>
                </div>


            </div>

            <div class="row" v-if="activePage === 2">
            
            <h3>{{ pages[activePage].pageTitle}}</h3>
            <p>{{pages[activePage].content}}</p>
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
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Links</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Links</h5>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #6c757d;">
                &copy; {{ new Date().getFullYear() }} Psicoclin. All rights reserved.
            </div>
        </footer>

</template>

<script setup>
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

const info=[
    {
        titulo: 'A Psicoclin',
        conteudo:'A Psicoclin é uma clínica de psicologia localizada na Barra da Tijuca, no Rio de Janeiro. Fundada em 2016, a clínica tem mais de 7 anos de experiência no mercado e é referência na área. Ela está situada no Cittá América, um centro comercial e empresarial.'
    },

    {
        titulo: 'A Equipe',
        conteudo:'A clínica conta com uma equipe de 21 psicólogos especializados em diversas áreas da psicologia. Esses profissionais estão preparados para atender pacientes de todas as idades e necessidades.'
    },
    {
        titulo: 'Compromisso',
        conteudo:'Os valores da Psicoclin incluem ética, compromisso, respeito e qualidade nos serviços. A equipe se esforça para garantir excelência no atendimento e empatia com os pacientes.'
    }

];
</script>