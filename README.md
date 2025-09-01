# Ticto Ponto  

Aplicação de **registro de ponto eletrônico** desenvolvida como parte do processo seletivo para **Desenvolvedor Back-end Sênior**.  
O sistema permite que **funcionários registrem pontos** e que **administradores gerenciem usuários e consultem relatórios filtrados por período**.  

---

## 🚀 Configuração Rápida (Ambiente Local)

### Pré-requisitos
- PHP v8.2.29+  
- Composer  
- MySQL (InnoDB)
- Node.js v20.13.1+
- NPM v10.5.2+
- Vue.js 3

### Importante:
1. Antes de rodar as migrations, certifique-se de que o seu banco de dados já foi criado:

```sql
CREATE DATABASE ticto_ponto;
```

2. Após copiar o .env de .env.example, ajustar as credenciais de banco para os do seu respectivo SGBD.

### Passos
```bash
# Clonar repositório
git clone https://github.com/petrusnog/ticto-ponto
cd ticto-ponto

# Instalar dependências do backend
composer install
cp .env.example .env
php artisan key:generate

# Configurar banco no .env e rodar migrations + seeders
php artisan migrate --seed

# Instalar dependências do frontend
npm install
npm run dev

# Rodar servidor (Abrir uma nova aba de terminal)
php artisan serve
```

Acesse em: **http://localhost:8000**

---

## 🔑 Credenciais de Teste

**Admin 1**  
📧 gpetersen@ticto.com  
🔑 tictosenha  

**Admin 2**  
📧 tfinch@ticto.com  
🔑 tictosenha  

**Funcionário**  
📧 pnogueira@ticto.com  
🔑 funcionariosenha  

---

## 📌 Entidades Principais

### Usuário (`users`)
- Nome completo  
- CPF (único e válido)  
- E-mail (login)  
- Senha  
- Cargo  
- Data de nascimento  
- Endereço (CEP + consulta automática via API)  
- Relação **belongsTo** com `admin_id` (gestor responsável, se funcionário)  

### Ponto (`pontos`)
- ID  
- Usuário (funcionário)  
- Data e hora do registro (com segundos)  

---

## ⚙️ Funcionalidades

### Funcionário
- Login  
- Registrar ponto (1 clique)  
- Alterar senha  

### Administrador
- CRUD completo de funcionários  
- Listar pontos de qualquer funcionário  
- Filtrar pontos por período (entre duas datas)  
- Relatório de pontos usando **SQL puro**, contendo:  
  - ID do registro  
  - Nome do funcionário  
  - Cargo  
  - Idade  
  - Nome do gestor  
  - Data e hora completa  

---

## 📝 Observações
- Toda manipulação de dados (exceto relatório) foi feita com **Eloquent**.  
- O relatório foi implementado com **SQL puro** conforme exigido.  
- Estrutura organizada em migrations, models e controllers.
