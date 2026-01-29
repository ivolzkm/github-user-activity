GitHub User Activity CLI

Uma ferramenta de linha de comando (CLI) desenvolvida em PHP para buscar e exibir a atividade recente de um usuário no GitHub. Este projeto faz parte dos desafios do roadmap.sh.
🚀 Funcionalidades
Básicas

    Interface via linha de comando (CLI).

    Integração com a GitHub API (endpoint de eventos).

    Exibição de atividades recentes (commits, issues, estrelas).

Avançadas (Diferenciais)

    Sistema de Cache Local: Armazenamento em arquivos JSON para evitar limites de taxa (Rate Limit) da API.

    Filtros de Eventos: Opção para filtrar a saída por tipo de atividade (ex: apenas PushEvent).

    Saída Estruturada: Formatação legível e organizada no terminal.

📂 Estrutura do Projeto
.
├── src/
│   ├── Cache.php       # Gerenciamento de persistência local (Concluído)
│   ├── GitHubClient.php # Comunicação com a API do GitHub
│   └── EventParser.php  # Lógica de tradução e formatação de eventos
├── github-activity.php  # Ponto de entrada da aplicação
├── .cache/              # Armazenamento dos arquivos temporários de cache
└── README.md            # Guia do projeto

🛠️ Tecnologias e Conceitos Aplicados

    PHP 8.x: Uso de tipagem estrita e match expressions.

    POO (Programação Orientada a Objetos): Separação de responsabilidades.

    Streams de Contexto: Manipulação de requisições HTTP sem dependências externas.

    File System (I/O): Gerenciamento de arquivos e metadados (filemtime).

📋 Roadmap de Desenvolvimento

    [x] Fase 1: Planejamento e Arquitetura de Pastas.

    [x] Fase 2: Implementação da Classe de Cache (src/Cache.php).

    [x] Fase 3: Implementação do Cliente da API (src/GitHubClient.php).

    [x] Fase 4: Lógica Principal (Input de argumentos via $argv).

    [x] Fase 5: Parser de Eventos e Exibição (Formatting).

    [x] Fase 6: Implementação de Flags de Filtro (ex: --type).

⚙️ Como Executar (Futuro)

Após a conclusão, o uso básico será:

php github-activity.php <username>

Para usar filtros:

php github-activity.php <username> --type=PushEvent

📝 Notas de Estudo

    O cache está configurado com TTL de 300 segundos (5 minutos).

    Os nomes de arquivos de cache utilizam MD5 hash para garantir nomes de arquivos válidos e seguros no sistema operacional.