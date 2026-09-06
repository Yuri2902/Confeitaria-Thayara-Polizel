## 💻 Como Executar o Projeto com XAMPP

### 1. Clonar o Projeto
Clone ou cole a pasta do projeto dentro do diretório `htdocs` do seu XAMPP:
* Caminho padrão no Windows: `C:\xampp\htdocs\Confeitaria-Thayara-Polizel`

### 2. Iniciar os Serviços
Abra o **XAMPP Control Panel** e inicie os módulos **Apache** e **MySQL**.

### 3. Importar o Banco de Dados
1. Acesse o **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Crie um novo banco de dados chamado `confeitaria_artesanal`.
3. Selecione o banco de dados criado e clique na aba **Importar** (*Import*).
4. Escolha o arquivo SQL localizado no projeto em `dumps/confeitaria_artesanal.sql` e clique em **Executar**.

### 4. Verificar Credenciais de Conexão
Confira se as credenciais no arquivo `src/banco.php` e as rotas em `config.php` estão apontando para:
* **Host:** `localhost`
* **Usuário:** `root`
* **Senha:** `""` (vazia)
* **Banco:** `confeitaria_artesanal`

### 5. Acessar a Aplicação
* **Página Inicial:** `http://localhost/Confeitaria-Thayara-Polizel/index.php`
* **Painel Administrativo:** `http://localhost/Confeitaria-Thayara-Polizel/administradora/cardapio-adm.php`