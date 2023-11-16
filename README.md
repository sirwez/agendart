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
A estrutura do projeto está organizada da seguinte forma:

```
Agendart-Test/
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
│       └── posts/           # Páginas relacionadas às postagens (timeline e upload).
│      
└── index.php                # Ponto de entrada principal da aplicação.
```

## Rotas

### Autenticação
- **/auth/login**: Rota para a página e ação de login.
- **/auth/logout**: Rota para a ação de logout.
- **/auth/register**: Rota para a página e ação de registro.

### Postagens
- **/posts/timeline**: Rota para visualizar a timeline.
- **/posts/upload**: Rota para a página de upload de imagens.
- **/posts/fetch**: Rota para buscar as postagens.