# ERP Montink

Este é um sistema de ERP desenvolvido em Laravel, que inclui funcionalidades de gerenciamento de produtos, estoque, pedidos e cupons.

## Funcionalidades

- **Cadastro de Produtos**: Permite adicionar, editar e remover produtos do sistema.
- **Gerenciamento de Estoque**: Controla a quantidade de produtos disponíveis.
- **Carrinho de Compras**: Implementa um carrinho de compras com lógica de frete.
- **Consulta de CEP**: Integração com a API ViaCEP para preenchimento automático de endereços.
- **Cupons de Desconto**: Permite a criação e aplicação de cupons com regras de validade e valor mínimo.
- **Finalização de Pedidos**: Finaliza pedidos e envia e-mails de confirmação ao cliente.
- **Webhook de Atualização de Pedido**: Permite atualizar ou cancelar pedidos via webhook.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para desenvolvimento web.
- **Livewire**: Para construção de interfaces dinâmicas.
- **Bootstrap**: Para estilização e layout responsivo.
- **MySQL**: Banco de dados relacional.

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/dev-leonzera/erp-montink.git
   ```

2. Navegue até o diretório do projeto:
   ```bash
   cd erp-montink
   ```

3. Instale as dependências do Composer:
   ```bash
   composer install
   ```

4. Crie um arquivo `.env` a partir do arquivo `.env.example`:
   ```bash
   cp .env.example .env
   ```

5. Configure as variáveis de ambiente no arquivo `.env` (banco de dados, e-mail, etc.).

6. Gere a chave de aplicação:
   ```bash
   php artisan key:generate
   ```

7. Execute as migrations para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

8. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

## Uso

- Acesse a aplicação em `http://localhost:8000`.
- Navegue pelas funcionalidades disponíveis, como cadastro de produtos, gerenciamento de estoque e finalização de pedidos.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.

## Licença

Este projeto está licenciado sob a MIT License. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.