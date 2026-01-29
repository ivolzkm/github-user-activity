# 💻 GitHub User Activity CLI

Uma ferramenta de linha de comando robusta e performática, desenvolvida em **PHP**, que permite monitorar a atividade recente de qualquer usuário do GitHub diretamente pelo terminal. Este projeto foi construído seguindo os desafios de backend do [roadmap.sh](https://roadmap.sh/projects/github-user-activity).

---

## ✨ Funcionalidades

* **Busca em Tempo Real:** Integração direta com a [GitHub Events API](https://docs.github.com/en/rest/activity/events).
* **Sistema de Cache Inteligente:** Armazenamento local em arquivos JSON para respeitar o *Rate Limit* da API e garantir respostas instantâneas em consultas repetidas.
* **Filtros Avançados:** Opção de filtrar resultados por tipo de evento (ex: apenas Commits ou Stars).
* **Visualização Estruturada:** Saída formatada, colorida e amigável para leitura humana no terminal.

---

## 🛠️ Arquitetura e Tecnologias

O projeto foi desenvolvido focando em **Programação Orientada a Objetos (POO)** e separação de responsabilidades para facilitar a manutenção e escalabilidade:

| Componente | Responsabilidade |
| :--- | :--- |
| `github-activity.php` | Ponto de entrada (Entry point) e gestão de argumentos do terminal. |
| `src/Cache.php` | Persistência local, hashing de chaves e lógica de expiração (TTL). |
| `src/GitHubClient.php` | Comunicação com a API do GitHub através do cliente HTTP Guzzle. |
| `src/EventParser.php` | Tradução de JSON bruto para mensagens amigáveis em português/inglês. |

---

## 🚀 Como Instalar e Usar

### Pré-requisitos
* **PHP 8.1** ou superior instalado em seu sistema.
* Conexão com a internet (necessária para a primeira busca ou após a expiração do cache).

### Instalação
1.  Clone este repositório:
    ```bash
    git clone [https://github.com/seu-usuario/github-user-activity.git](https://github.com/seu-usuario/github-user-activity.git)
    ```
2.  Acesse a pasta do projeto:
    ```bash
    cd github-user-activity
    ```

### Exemplos de Uso

**Busca padrão (exibe todas as atividades recentes):**
```bash
php github-activity.php ivolzkm
```
**Filtrar por um tipo específico de evento:**

```bash
php github-activity.php octocat --type=PushEvent
```

---

## 🧠 Conceitos de Base Consolidados

Este projeto demonstra o domínio de fundamentos essenciais para o desenvolvimento backend:
* **I/O e File System:** Manipulação de metadados de arquivos (`filemtime`) para controle de cache.
* **Cliente HTTP Abstrato:** Uso da biblioteca Guzzle para uma comunicação robusta e simplificada com a API REST do GitHub.
* **PHP Moderno:** Implementação de tipagem estrita, `match expressions` e tratamento robusto de erros.
* **Segurança CLI:** Sanitização de inputs e proteção contra Directory Traversal via hashing de arquivos de cache.

---

## 📂 Estrutura de Pastas
```text
.
├── src/                # Lógica de negócio (Cache, API Client, Parser)
├── .cache/             # Armazenamento temporário (Ignorado no Git)
├── github-activity.php # Script principal executável
└── README.md           # Documentação do projeto
```

---

> **Projeto desenvolvido por um estudante de Informática Biomédica (UFCSPA) focado em engenharia de software e sistemas eficientes.**

