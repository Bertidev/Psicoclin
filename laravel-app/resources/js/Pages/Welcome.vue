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

const form = useForm({
    nome: '',
    email: '',
    assunto: '',
    mensagem: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        onSuccess: () => {
            form.reset();
        }
    });
};

const pages = [
    {
        link: { text: 'Psicoclin', url: 'index.html' },
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

const relatos = ref([
    {
        nome: 'Maria',
        idade: '21 anos',
        conteudo: 'A Psicoclin superou todas as minhas expectativas! Desde o atendimento na recepção até as sessões com os psicólogos, tudo foi impecável. As instalações são modernas e confortáveis, e os profissionais são extremamente atenciosos e competentes. Recomendo a todos!',
        imagem: 'images/paciente3.0.jpg',
        estrelas: 5
    },
    {
        nome: 'Jonas',
        idade: '35 anos',
        conteudo: 'Fiquei muito impressionado com a eficiência e a qualidade do atendimento na Psicoclin. Os psicólogos são altamente especializados e demonstram um verdadeiro compromisso com o bem-estar dos pacientes. Além disso, o tempo de espera foi mínimo, o que é um grande diferencial.',
        imagem: 'images/paciente4.jpg',
        estrelas: 4
    },
    {
        nome: 'Tobias',
        idade: '58 anos',
        conteudo: 'A melhor clínica de psicologia em que já estive! Os profissionais são muito dedicados e atenciosos, e o ambiente é limpo e organizado. Fui muito bem tratado desde a chegada até o momento de ir embora. Agradeço a toda a equipe pelo excelente serviço prestado.',
        imagem: 'images/paciente2.jpg',
        estrelas: 4
    },
    {
        nome: 'Alberto',
        idade: '73 anos',
        conteudo: 'Tive uma experiência maravilhosa na Psicoclin. O ambiente é muito acolhedor e a equipe é extremamente qualificada. Fui muito bem atendido e me senti em boas mãos durante todo o processo terapêutico. Com certeza voltarei se precisar de mais apoio psicológico.',
        imagem: 'images/paciente1.jpg',
        estrelas: 5
    },
    {
        nome: 'Maria Silva',
        idade: '28 anos',
        conteudo: 'Minha experiência na Psicoclin foi transformadora. Desde o primeiro atendimento, fui acolhida com muita empatia e profissionalismo. Minha psicóloga me ajudou a lidar com questões pessoais e profissionais que estavam me afetando profundamente. A equipe é extremamente dedicada e o ambiente da clínica é acolhedor e confortável. Recomendo a Psicoclin para todos que buscam um acompanhamento psicológico de qualidade.',
        imagem: 'images/paciente6.jpg',
        estrelas: 5
    },
    {
        nome: 'João Pereira',
        idade: '31 anos',
        conteudo: 'Frequento a Psicoclin há alguns meses e tenho notado uma grande melhora em minha saúde mental. Os psicólogos são muito capacitados e atenciosos. Eles realmente se preocupam com o bem-estar dos pacientes. A única coisa que eu sugeriria é uma maior flexibilidade nos horários de atendimento, pois às vezes é difícil conseguir um horário compatível com minha agenda de trabalho. No geral, estou muito satisfeito com os serviços prestados.',
        imagem: 'images/paciente7.jpg',
        estrelas: 4
    },
    {
        nome: 'Ana Garcia',
        idade: '20 anos',
        conteudo: 'Minha experiência na Psicoclin foi boa, mas não extraordinária. A clínica é bem organizada e os profissionais são competentes, mas senti que o atendimento poderia ser mais personalizado. Houve momentos em que parecia que meu terapeuta estava seguindo um roteiro padrão, sem considerar tanto minhas necessidades individuais. Ainda assim, consegui obter algum progresso em meus problemas pessoais.',
        imagem: 'images/paciente5.jpg',
        estrelas: 3
    },
    {
        nome: 'Pedro Lima',
        idade: '59 anos',
        conteudo: 'Infelizmente, minha experiência na Psicoclin não foi positiva. Tive dificuldades em me conectar com meu terapeuta e senti que minhas preocupações não eram totalmente compreendidas. Além disso, houve um problema de comunicação que resultou em um cancelamento de sessão sem aviso prévio, o que foi bastante frustrante. Embora a clínica tenha boa infraestrutura, minha experiência pessoal deixou a desejar. Não pretendo continuar com o tratamento lá.',
        imagem: 'images/paciente8.jpg',
        estrelas: 1
    },
]);

const contatos = [
    {
        Email: ' Email: Contato@psicoclin.com.br',
        Telefone: 'Telefone: (21)4002-8922' ,
        Horario: 'Horario de funcionamento: 8:00 as 18:30'
    }
];

const info = [
    {
        titulo: 'A Psicoclin',
        conteudo: `A Psicoclin é uma renomada clínica de psicologia localizada no coração da Barra da Tijuca, no Rio de Janeiro. Fundada em 2016, a clínica acumula mais de 7 anos de experiência, tornando-se uma referência no campo da saúde mental. Situada no prestigiado Cittá América, um centro comercial e empresarial de fácil acesso, a Psicoclin oferece um ambiente acolhedor e profissional para todos os seus pacientes.

Instalações Modernas: Nossas instalações são modernas, confortáveis e cuidadosamente projetadas para proporcionar um ambiente tranquilo e seguro. Cada detalhe foi pensado para garantir que nossos pacientes se sintam à vontade e possam focar em seu bem-estar emocional e mental.

Tecnologia de Ponta: Utilizamos tecnologia de ponta para apoiar nossos tratamentos. Desde a gestão de prontuários eletrônicos até a realização de sessões por telemedicina, estamos equipados para oferecer o melhor atendimento, seja presencial ou à distância.

Localização Privilegiada: A Psicoclin está estrategicamente localizada ao lado do Shopping Downtown e próxima ao supermercado ASSAÍ, com fácil acesso pela estação BRT Bosque Marapendi. Nossos pacientes encontram conveniência e facilidade para chegar até nós, independentemente do meio de transporte utilizado.`
    },
    {
        titulo: 'A Equipe',
        conteudo: `Equipe Multidisciplinar: Nossa equipe é composta por seis psicólogos altamente especializados em diversas áreas da psicologia, incluindo psicoterapia, psicologia infantil, terapia de casal, e mais. Esses profissionais estão preparados para atender pacientes de todas as idades e necessidades, oferecendo um atendimento personalizado e de qualidade.

Qualificações e Experiência: Todos os nossos psicólogos possuem vasta experiência e são constantemente atualizados com as melhores práticas e técnicas terapêuticas. Participam regularmente de cursos, workshops e conferências para garantir que nossos pacientes recebam um atendimento baseado nas mais recentes descobertas e métodos da psicologia.

Empatia e Dedicação: Na Psicoclin, acreditamos que a empatia é fundamental para o sucesso do tratamento. Nossa equipe é dedicada, atenciosa e comprometida com o bem-estar de cada paciente, proporcionando um espaço seguro e acolhedor para que possam expressar suas emoções e enfrentar seus desafios.`
    },
    {
        titulo: 'Compromisso',
        conteudo: `Valores: Os valores da Psicoclin incluem ética, compromisso, respeito e qualidade nos serviços prestados. Acreditamos na importância de tratar cada paciente com dignidade e respeito, oferecendo um atendimento humanizado e centrado no paciente.

Ética e Sigilo: Garantimos que todas as informações dos nossos pacientes sejam tratadas com o mais alto nível de confidencialidade e respeito. Seguimos rigorosamente os códigos de ética da profissão para assegurar que nossos pacientes se sintam seguros e confiantes em compartilhar suas experiências.

Qualidade no Atendimento: Nos esforçamos continuamente para garantir excelência no atendimento. Isso inclui desde a pontualidade nas consultas até a personalização do tratamento, sempre buscando a melhor abordagem para cada caso. Nosso compromisso é com a saúde mental e emocional de nossos pacientes, ajudando-os a alcançar uma vida mais equilibrada e satisfatória.

Apoio Contínuo: Sabemos que a jornada para o bem-estar mental não termina após uma sessão. Por isso, oferecemos suporte contínuo para nossos pacientes, incluindo follow-ups, recursos educativos e acesso facilitado aos nossos profissionais sempre que necessário.`
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

<style>
.bold-text {
    font-weight: bold;
    font-size: 18px;
}

img {
    max-width: 100%;
    height: auto;
}

.navbar-brand img {
    max-width: 100px;
}

.card-img-top {
    max-height: 200px;
    object-fit: cover;
}

.circular-image {
    width: 85px;
    height: 85px;
    border-radius: 90%;
    object-fit: cover;
}

.stars {
    margin-bottom: 10px;
}

.star {
    font-size: 20px;
    color: lightgray;
}

.star.filled {
    color: gold;
}

.psicoclin-image {
    max-width: 75%; 
    margin-right: 20px; 
}

.text-center {
    text-align: center;
}

.text-justify {
    text-align: justify;
}

@media (min-width: 768px) {
    .col-md-6 img {
        max-width: 100%;
    }
    .d-flex {
        display: flex;
    }
    .justify-content-center {
        justify-content: center;
    }
    .flex-column {
        flex-direction: column;
    }
}
</style>

<template>
    <div>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width">
            <title>Psicoclin</title>
            <link rel="icon" href="./images/icone.ico" type="image/x-icon" />
            <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        </head>

        <div class="d-flex justify-content-center" style="background-color: #728360; padding: 1rem 0;">
            <img src="images/marca.png" alt="Psicoclin" style="width: 25%;">
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" alt="Psicoclin">
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li v-for="(page, index) in pages" class="nav-item" :key="index">
                        <a 
                            class="nav-link bold-text" 
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
            </div>
        </nav> 
        <div id="content" class="container-fluid" style="background: linear-gradient(to bottom, #f8f9fa, #e9ecef);">
            <div class="row mb-5" v-if="activePage === 0">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="images/clinica.jpeg" alt="Clínica Psicoclin" class="img-fluid mb-3 psicoclin-image">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center text-center">
                    <div class="mb-4 text-center">
                        <h2>{{ info[0].titulo }}</h2>
                        <p v-for="paragraph in info[0].conteudo.split('\n\n')" :key="paragraph" class="text-justify">{{ paragraph }}</p>
                    </div>
                </div>
            </div>
            <div class="row mb-5" v-if="activePage === 0">
                <div class="col-md-6 d-flex flex-column justify-content-center text-center order-md-1">
                    <div class="mb-4 text-center">
                        <h2>{{ info[1].titulo }}</h2>
                        <p v-for="paragraph in info[1].conteudo.split('\n\n')" :key="paragraph" class="text-justify">{{ paragraph }}</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center order-md-2">
                    <img src="images/equipe2.jpg" alt="Equipe Psicoclin" class="img-fluid mb-3 psicoclin-image">
                </div>
            </div>
            <div class="row mb-5" v-if="activePage === 0">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="images/compromisso3.jpg" alt="Compromisso Psicoclin" class="img-fluid mb-3 psicoclin-image">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center text-center">
                    <div class="mb-4 text-center">
                        <h2>{{ info[2].titulo }}</h2>
                        <p v-for="paragraph in info[2].conteudo.split('\n\n')" :key="paragraph" class="text-justify">{{ paragraph }}</p>
                    </div>
                </div>
            </div>
            <div class="row" v-if="activePage === 1">
                <div v-for="(relato, index) in relatos" :key="index" class="col-md-3 text-center mb-4 mt-1">
                    <div class="card">
                        <div class="d-flex align-items-center justify-content-center">
                            <img :src="relato.imagem" alt="Paciente" class="circular-image mr-2">
                            <div class="name-age">
                                <h5 class="card-title mb-0" style="font-size: 1.6em;">{{ relato.nome }}</h5>
                                <p class="card-text mt-1" style="font-size: 1.2em;">{{ relato.idade }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="stars">
                                <span v-for="star in 5" :key="star" class="star" :class="{'filled': star <= relato.estrelas}">★</span>
                            </div>
                            <p class="card-text text-start">{{ relato.conteudo }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="activePage === 2">
                <div class="col-md-4">
                    <h2>Nossos Contatos</h2>
                    <p>{{ contatos[0].Email }}</p>
                    <p>{{ contatos[0].Telefone }}</p>
                    <p>{{ contatos[0].Horario }}</p>
                    <h2>Fale Conosco</h2>

                    <div v-if="$page.props.flash.confirmation" class="alert alert-success" role="alert">
                        {{ $page.props.flash.confirmation }}
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Seu Nome</label>
                            <input v-model="form.nome" type="text" class="form-control" id="nome" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Seu Email</label>
                            <input v-model="form.email" type="email" class="form-control" id="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="assunto" class="form-label">Assunto</label>
                            <input v-model="form.assunto" type="text" class="form-control" id="assunto" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Sua Mensagem</label>
                            <textarea v-model="form.mensagem" class="form-control" id="mensagem" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#6F7C5E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#9EA68F] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Enviar
                        </button>

                        <p></p>
                    </form>
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
    </div>
</template>
