# Psicoclin - Sistema de Gerenciamento de Clínica de Psicologia

## Introdução

Bem-vindo ao Psicoclin, um sistema desenvolvido para auxiliar uma clínica de psicologia a gerenciar suas operações e facilitar o acesso dos clientes aos serviços da clínica. Este sistema oferece funcionalidades tanto para clientes quanto para profissionais da clínica (psicólogos e secretárias), permitindo a consulta e o acréscimo de informações dos clientes com as devidas permissões de acesso.

## Ferramentas utilizadas
Este repositório contém um sistema Clínico desenvolvido utilizando:
- <img src="https://static-00.iconduck.com/assets.00/electron-icon-472x512-8swdbwbh.png" alt="ElectronJS" width="24" height="24"> **ElectronJS** : Framework para criar aplicativos de desktop multiplataforma usando tecnologias web (HTML, CSS e JavaScript).
- <img src="https://static-00.iconduck.com/assets.00/docker-icon-icon-2048x1479-cres2he9.png" alt="Docker" width="24" height="24"> **Docker** : Plataforma para desenvolver, enviar e executar aplicativos em contêineres.
- <img src="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png" alt="Laravel" width="24" height="24"> **Laravel** : Framework PHP para desenvolvimento de aplicativos web robustos e escaláveis.
- <img src="https://cdn-icons-png.flaticon.com/512/5968/5968332.png" alt="PHP" width="24" height="24"> **PHP** : Linguagem de programação amplamente usada para desenvolvimento web.
- <img src="https://www.svgrepo.com/show/303251/mysql-logo.svg" alt="MySQL" width="24" height="24"> **MySQL** : Sistema de gerenciamento de banco de dados relacional.
- <img src="https://raw.githubusercontent.com/tandpfun/skill-icons/65dea6c4eaca7da319e552c09f4cf5a9a8dab2c8/icons/VueJS-Dark.svg" alt="VueJS" width="24" height="24"> **VueJS** : Utilizado para o front-end do projeto.
- <img src="https://phpunit.de/img/phpunit.svg" alt="PHPUnit" width="38" height="24"> **PHPUnit** : Usamos o PHPUnit para executar testes.
- <img src="https://viacep.com.br/estatico/images/viacep.png.pagespeed.ce.I80LiA6qpr.png" alt="ViaCep" width="50" height="15"> **ViaCep**: E uma API para preenchimento automático de endereços a partir de um CEP fornecido pelo usuário.

## Funcionalidades

### Landpage para a Clínica
1. **Descrição dos serviços**
2. **Sobre a Clínica**
3. **Depoimentos de Pacientes**
4. **Formulário de Contato**
    - Este formulário pode ser enviado via e-mail, WhatsApp ou SMS.
5. **Informações de Contato**
    - Telefone, e-mail e endereço da clínica.
    - Dias e horários de funcionamento da clínica.

### Sistema de Login
- **Clientes**: Recebem acesso para visualizar funcionalidades específicas.
- **Profissionais da Clínica**: Psicólogos e secretárias.

### Funcionalidades para Clientes
1. **Histórico de agendamentos**
2. **Agendamento da próxima consulta**
3. **Listagem das próximas consultas agendadas**

### Funcionalidades para Profissionais da Clínica

#### Secretária
1. **Preenchimento das informações iniciais do paciente:**
    - Nome completo
    - Endereço residencial (API de CEP)
    - Criação de usuário e senha para novos clientes
2. **Anunciar a chegada do paciente ao psicólogo responsável**

#### Psicólogo
1. **Receber aviso da chegada do próximo paciente**
2. **Acessar e editar ficha de um paciente:**
    - Informações cadastrais
    - Inserção de informações da sessão
    - Área de documentos padrões para editar, como:
        - Encaminhamentos
        - Atestados de atendimento

## Requisitos Obrigatórios para o Desenvolvimento
- Uso do `ElectronJS` para criar um aplicativo para Windows/Linux/MacOS.
- Uso do `Laravel` como framework de desenvolvimento (preferencialmente com `VueJS` e `TailwindCSS` para o front-end).
- Implementação de `TDD` com no mínimo 10 testes automatizados.
- Documentação do `gitflow` utilizado.
- Documentação das atas de reunião de planejamento (Sprints).
- Uso de containers gerenciados por `Swarm` ou `Kubernetes`.
- Uso do `Trello` para controle das sprints e backlog.

## Pré-requisitos

1. **Node.js**: [Instalação](https://nodejs.org/en/download)
2. **Docker**: [Instalação](https://www.docker.com/products/docker-desktop)
3. **Git**: [Instalação](https://git-scm.com/downloads)

## Como Usar

1. Clone o repositório ou baixe o .zip através da release:
    ```sh
    git clone [link do repositório]
    ```

2. Siga os seguintes comandos na ordem:

### Configuração do Ambiente

1. Renomeie o arquivo `.env.example` para `.env` e altere o campo `DB_PASSWORD=` para `DB_PASSWORD=root`.

2. Instale as dependências do Node fora do container:
    ```sh
    npm install
    ```

3. Inicie o Swarm:
    ```sh
    docker swarm init
    ```

4. Crie os containers:
    ```sh
    docker stack deploy -c docker-compose.yml [nome-do-serviço]
    ```
5. Para achar o [nome do container]:
    ```sh
    docker container ls
    ```
   
6. Entre no bash do container:
    ```sh
    docker exec -it [nome do container] bash
    ```

7. Atualize o Composer e gere a key do projeto:
    ```sh
    composer update && php artisan key:generate
    ```

8. Realize as migrações e seeds do banco de dados:
    ```sh
    php artisan migrate --seed
    ```

9. Instale as dependências do Node e compile os arquivos Vue:
    ```sh
    npm install && npm run build
    ```

10. Saia do bash do container:
    ```sh
    exit
    ```

11. Rode o Electron fora do container:
    ```sh
    npm start
    ```

### Testes
- Para rodar os teste, basta utilizar o seguinte comando dentro do container:
   ```
   php artisan test
   ```

### Para Parar de Utilizar o Projeto
Para parar de utilizar o projeto, rode o seguinte comando no terminal:
```sh
docker swarm leave --force
```
## Observações

- Na primeira vez que você gerar as imagens e os containers, é provável que o processo demore um tempo considerável. Além disso, ao executar o comando 'docker container ls', pode não aparecer nenhum container imediatamente. Esse atraso é normal na primeira execução, especialmente devido ao tempo que a imagem do Laravel leva para ser criada e inicializada. Esse comportamento ocorre devido ao uso do Docker Swarm.
  
- é normal também demorar para que o aplicativo abra ao utilizar o electron, ou que as views demorem para atualizar completamente quando utilizadas no electron;
  
- os documentos gerados pelo psicologo estarão no caminho laravel-app->public e serão nomeados de "atestado.pdf" ou "encaminhamento.pdf";
  
- Em nosso projeto, as permissões de cada usuário são distinguidas através da coluna "role" da tabela users do banco de dados, podendo ter os possíveis valores de:
    - 0 significando que o usuario é um paciente;
	- 1 significando que o usuario faz parte da secretaria;
	- 2 significando que o usuario é um psicólogo;
	- 3 significando que o usuário é um admin->há apenas um login de admin em nosso projeto;
  
- Todos os perfis também, possuem a senha 'password' como padrão, mas pode ser alterada caso deseje, desde que a senha nova possua no mínimo 8 caracteres.
  
## Developers
   - Daniel Rossi
     - GitHub -> https://github.com/danirso
   - Leonardo Carbelim
     - GitHub ->  https://github.com/LevvonDev
   - Lucas Berti
     - GitHub -> https://github.com/Bertidev
   - Lucas Magaldi
     - GitHub -> https://github.com/MAgalDI02
   - Matheus Anitelli
     - GitHub -> https://github.com/mttue7
