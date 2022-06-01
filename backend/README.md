# Documentando a estrutura do Backend do Projeto

## Cada pasta Representa uma Entidade da Aplicação

Mesmo que uma entidade denpenda de outra, componha ou extenda de outra, cada uma deve ficar dentro de sua respectiva pasta.

## Fluxo da Aplicação dentro da pasta que representa a Entidade

### Controller
Responsável por receber a requisição bruta do cliente, formatar a entrada de dados e passar a mesma para o **UseCase** correspondente. Além disso também é reponsável por receber a resposta do **UseCase** e devolver ao cliente a responsa (saída) apropriada.

### UseCase
Responsável pela regra de negócio e relacionamentos entre classes do sistema.
Um **UseCase** recebe no construtor, em sua maioria, interfaces de repositório (abstrações da camada de Adapters).
Em seu método executar recebe um **InputData** e retorna um **OutputData**.

### Repository
Camada onde fica a abstração do mundo exterior para dentro do sistema. Não importa muito como a classe que implementa a interface de *Repository* faz determinada ação, o que me interessa é apenas o que preciso passar para ela e o que preciso receber.

### Adapters
Camada que geralmente implementa as interfaces/abstrações de *Repository* com bibliotecas/pacotes/modulos/serviços, de terceiros para o funcionamento do projeto.