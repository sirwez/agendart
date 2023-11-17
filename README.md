# Projeto AgendaArt Timeline

## Descrição
O AgendaArt é uma plataforma de timeline interativa onde os usuários podem postar e visualizar imagens acompanhadas de comentários. Este projeto foi construído utilizando tecnologias como PHP 8, MySQL, jQuery e Bootstrap, seguindo as melhores práticas de desenvolvimento web moderno.

## Pré-Requisitos
Para rodar este projeto, você precisará ter instalado:
- PHP 8.0 ou superior.
- MySQL.
- Apache Server (recomendamos o uso de XAMPP, WAMP, MAMP ou similar para facilitar a configuração), para esse projeto utilizei o XAMPP.

## Instalação e Configuração

### Banco de Dados
1. Crie uma base de dados MySQL para o projeto.
2. Importe o script SQL fornecido (`agendart.sql`) para criar as tabelas necessárias.

### Configuração do Ambiente
1. Clone o repositório do projeto:
   ```
   git clone https://github.com/sirwez/agendart.git
   ```
2. Navegue até o diretório do projeto.
3. Configure o arquivo `config/config.php` com as credenciais do seu banco de dados.

### Execução Local
Para iniciar a aplicação:
1. Inicie o servidor Apache e o MySQL através do seu software de servidor web.
2. Acesse a aplicação através do navegador em `http://localhost/agendart`.

## Estrutura do Projeto

A estrutura do projeto AgendaArt Timeline está organizada da seguinte forma, proporcionando uma clara separação de funcionalidades e facilitando a manutenção:

```
Agendart/
├── config/
│   └── config.php           # Configurações do banco de dados.
├── public/
│   └── uploads/             # Diretório para armazenamento de imagens enviadas pelos usuários.
├── src/
│   ├── backend/
│   │   ├── auth/            # Scripts de autenticação (login, registro, logout).
│   │   └── posts/           # Scripts para manipulação de postagens (buscar e postar imagens).
│   └── frontend/
│       ├── auth/            # Páginas de autenticação (login e registro).
│       ├── posts/           # Páginas relacionadas às postagens (timeline e upload).
│       └── partials/        # Componentes reutilizáveis do frontend.
│
└── index.php                # Ponto de entrada principal da aplicação.
```

### Organização das Páginas

#### Autenticação
- **Frontend**:
  - **Login (`/auth/login-page`)**: Interface para os usuários inserirem suas credenciais e acessarem a plataforma.
  - **Registro (`/auth/register-page`)**: Formulário para novos usuários criarem uma conta, com validação de e-mail e senha.
- **Backend**:
  - **Login (`/auth/login`)**: Processamento das credenciais de login e verificação no banco de dados.
  - **Logout (`/auth/logout`)**: Gerencia o encerramento de sessões ativas.
  - **Registro (`/auth/register`)**: Criação de novos usuários com verificação de e-mail e armazenamento seguro de senha.

#### Postagens
- **Frontend**:
  - **Timeline (`/posts/timeline`)**: Exibe as postagens dos usuários e atualiza automaticamente para mostrar novas postagens.
  - **Upload de Imagem (`/posts/upload`)**: Permite aos usuários enviar novas imagens e comentários.
- **Backend**:
  - **Fetch Postagens (`/posts/fetch`)**: Recupera as postagens do banco de dados para exibição na timeline.
  - **Postagem de Imagem (`/posts/post-image`)**: Gerencia o upload de novas postagens (imagens e comentários) para o banco de dados.

### Partials
- **Reutilização de Componentes**: A pasta `partials` dentro do `frontend` contém elementos reutilizáveis, como cabeçalhos e rodapés, garantindo a consistência visual e funcional em toda a aplicação.

## Rotas

### Autenticação
- **Frontend**:
  - **/auth/login-page**: Página de login. Permite ao usuário inserir credenciais para acessar a plataforma.
  - **/auth/register-page**: Página de registro. Permite ao novo usuário criar uma conta. Realiza validação de e-mail e senha via regex.
    - **Validação de Senha**: Mínimo de 8 caracteres, pelo menos 1 caractere especial, uma letra maiúscula e pelo menos 1 número.
- **Backend**:
  - **/auth/login**:
    - **Função**: Processa a ação de login.
    - **Comportamento**: Se o e-mail não existir no sistema, exibe "Usuário não encontrado". Se a senha estiver incorreta, exibe "Senha incorreta".
  - **/auth/logout**:
    - **Função**: Processa a ação de logout, encerrando a sessão do usuário.
  - **/auth/register**:
    - **Função**: Processa a ação de registro.
    - **Comportamento**: Verifica duplicidade de e-mail e aplica hashing na senha antes do armazenamento.
### Postagens
- **Frontend**:
  - **/posts/timeline**: Página da timeline. Mostra as postagens e as atualiza a cada 5 segundos.
  - **/posts/upload**: Página de upload de imagem. Permite ao usuário enviar uma imagem e um comentário.

- **Backend**:
  - **/posts/fetch**:
    - **Função**: Busca as postagens para exibição na timeline.
  - **/posts/post-image**:
    - **Função**: Processa o envio de uma nova postagem (imagem e comentário).