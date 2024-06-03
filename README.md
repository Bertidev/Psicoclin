# Psicoclin - Sistema de Gerenciamento de Clínica de Psicologia

## Introdução

Bem-vindo ao Psicoclin, um sistema desenvolvido para auxiliar uma clínica de psicologia a gerenciar suas operações e facilitar o acesso dos clientes aos serviços da clínica. Este sistema oferece funcionalidades tanto para clientes quanto para profissionais da clínica (psicólogos e secretárias), permitindo a consulta e o acréscimo de informações dos clientes com as devidas permissões de acesso.

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
    - Número de celular (WhatsApp)
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

5. Entre no bash do container:
    ```sh
    docker exec -it [nome do container] bash
    ```

6. Atualize o Composer e gere a key do projeto:
    ```sh
    composer update && php artisan key:generate
    ```

7. Realize as migrações e seeds do banco de dados:
    ```sh
    php artisan migrate --seed
    ```

8. Instale as dependências do Node e compile os arquivos Vue:
    ```sh
    npm install && npm run build
    ```

9. Saia do bash do container:
    ```sh
    exit
    ```

10. Rode o Electron fora do container:
    ```sh
    npm start
    ```

### Para Parar de Utilizar o Projeto
Para parar de utilizar o projeto, rode o seguinte comando no terminal:
```sh
docker swarm leave --force
```
